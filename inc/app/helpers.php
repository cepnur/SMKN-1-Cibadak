<?php

if (!function_exists('get_menu_items_by_registered_slug')) {
    function get_menu_items_by_registered_slug($menu_slug)
    {
        $menu_items = [];

        if (
            ($locations = get_nav_menu_locations()) &&
            isset($locations[$menu_slug])
        ) {
            $menu = get_term($locations[$menu_slug]);

            $menu_items = wp_get_nav_menu_items($menu->term_id);
        }

        return $menu_items;
    }
}
if (!function_exists('get_post_id_by_slug')) {
    function get_post_id_by_slug($slug)
    {
        $post = get_page_by_path($slug);

        if ($post) {
            return $page->ID;
        } else {
            return null;
        }
    }
}

function getTaxonomyList($post_id, $taxonomy)
{
    $tax = wp_get_post_terms($post_id, $taxonomy);
    return implode(", ", array_map(function ($item) {
        return $item->name;
    }, $tax));
}

function getTaxonomy($post_id, $taxonomy)
{
    $tax = wp_get_post_terms($post_id, $taxonomy);
    return array_map(function ($item) use ($taxonomy) {
        return [
            "title" => $item->name,
            'slug' => $item->slug,
            "permalink" => $taxonomy == "category" ? get_category_link($item->term_id) : get_permalink($item->term_id),
        ];
    }, $tax);
}

function getPostTerms($post_id, $taxonomy)
{
    $terms = wp_get_post_terms($post_id, "resource-category");
    return array_map(function ($item) {
        return [
            "name" => html_entity_decode($item->name),
            "taxonomy" => $item->taxonomy,
            "slug" => $item->slug
        ];
    }, $terms);
}


function get_custom_excerpt($post)
{

    if (get_field("custom_excerpt", $post->ID)) {
        return get_field("custom_excerpt", $post->ID);
    } else if ($post->post_excerpt != "") {
        return $post->post_excerpt;
    }

    $string = wpautop($post->post_content);
    $string = substr($string, 0, strpos($string, '</p>') + 4);
    $string = strip_tags($string, '<a><strong><em>');

    if (strlen($string) > 300) {

        // truncate string
        $stringCut = substr($string, 0, 300);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= ' [...]';
    }
    return $string;
}

function get_the_post($post)
{
    $str = str_replace(get_custom_excerpt($post), '', $post->post_content);
    return $str;
}

function mapping_articles($post)
{
    /*
    unused code, no image on article because no body content
    preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', get_the_content(null, $post->ID), $image);

    if (get_the_post_thumbnail_url($post->ID)) {
        $featured_image = get_the_post_thumbnail_url($post->ID);
    } elseif (is_array($image) && count($image) > 0 && isset($image['src'])) {
        // var_dump($image);
        $featured_image = $image['src'];
    } else {
        $featured_image = null;
    }
    */

    $data = [
        'id'      => $post->ID,
        'title'   => get_the_title($post->ID),
        'date'    => get_the_date(null, $post->ID),
        'publish_date' => get_field("date_of_publication", $post->ID) ?? get_the_date(null, $post->ID),
        'permalink' => get_the_permalink($post->ID),
        'link'    => get_field("custom_url", $post->ID) ? get_field("custom_url", $post->ID)["url"] : get_the_permalink($post->ID),
        'target'  => get_field("custom_url", $post->ID) ? get_field("custom_url", $post->ID)["target"] : "_self",
        'image'   => get_the_post_thumbnail_url($post->ID) ? get_the_post_thumbnail_url($post->ID, "original") : false,
        'image_sizes'   => [
            'thumbnail' => get_the_post_thumbnail_url($post->ID, "thumbnail"),
            'medium' => get_the_post_thumbnail_url($post->ID, "medium"),
            'medium_large' => get_the_post_thumbnail_url($post->ID, "medium_large"),
            'large' => get_the_post_thumbnail_url($post->ID, "large"),
        ],
        'excerpt' => get_custom_excerpt($post),
        'content' => get_the_content(null, false,  $post->ID)
    ];

    if (get_post_type($post->ID) == "news") {
        $data['category'] = getTaxonomy($post->ID, "news_category");
    }

    if (get_post_type($post->ID) == "resource") {
        $data['category'] = getTaxonomy($post->ID, "resource-category");
    }

    return $data;
}

function wp_get_menu_array($current_menu)
{
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = [];
    if (is_array($array_menu) || is_object($array_menu)) {
        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu['menu' . $m->ID] = [];
                $menu['menu' . $m->ID]['id'] = $m->ID;
                $menu['menu' . $m->ID]['title'] = $m->title;
                $menu['menu' . $m->ID]['url'] = str_replace(
                    get_site_url(),
                    '',
                    $m->url
                );
                $menu['menu' . $m->ID]['children'] = [];
                if (in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                    $menu['menu' . $m->ID]['isElementor'] = Elementor\Plugin::instance()->db->is_built_with_elementor(
                        $m->object_id
                    );
                }
            }
        }
        $submenu = [];
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu['menu' . $m->ID] = [];
                $submenu['menu' . $m->ID]['id'] = $m->ID;
                $submenu['menu' . $m->ID]['title'] = $m->title;
                $submenu['menu' . $m->ID]['url'] = str_replace(
                    get_site_url(),
                    '',
                    $m->url
                );
                if (in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                    $submenu['menu' . $m->ID]['isElementor'] = Elementor\Plugin::instance()->db->is_built_with_elementor(
                        $m->object_id
                    );
                }
                $menu['menu' . $m->menu_item_parent]['children']['menu' . $m->ID] = $submenu['menu' . $m->ID];
            }
        }
    }

    return $menu;
}

function parseToVue($data)
{
    return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
}
