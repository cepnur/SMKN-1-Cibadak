<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package csh
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function csh_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'csh_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function csh_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" title="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'csh_pingback_header');





/*
 * Add columns to featured post list
 */
function add_acf_columns($columns)
{
    return array_merge($columns, array(
        'featured' => __('Featured')
    ));
}
add_filter('manage_welcomers_posts_columns', 'add_acf_columns');
add_filter('manage_resource_posts_columns', 'add_acf_columns');

/*
 * Add columns to featured post list
 */
function featured_custom_column($column, $post_id)
{
    switch ($column) {
        case 'featured':
            echo get_field('featured', $post_id) ? 'Yes' : '';
            break;
    }
}
add_action('manage_welcomers_posts_custom_column', 'featured_custom_column', 10, 2);
add_action('manage_resource_posts_custom_column', 'featured_custom_column', 10, 2);


function csh_get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
} 
