<?php

function cptui_register_my_cpts_gallery()
{

    /**
     * Post Type: Gallery.
     */

    $labels = [
        "name" => __("Galleries", "imigrasi"),
        "singular_name" => __("Gallery", "imigrasi"),
        "menu_name" => __("Galleries", "imigrasi"),
        "all_items" => __("All Galleries", "imigrasi"),
        "add_new" => __("Add new", "imigrasi"),
        "add_new_item" => __("Add new Gallery", "imigrasi"),
        "edit_item" => __("Edit Gallery", "imigrasi"),
        "new_item" => __("New Gallery", "imigrasi"),
        "view_item" => __("View Gallery", "imigrasi"),
        "view_items" => __("View Galleries", "imigrasi"),
        "search_items" => __("Search Galleries", "imigrasi"),
        "not_found" => __("No Galleries found", "imigrasi"),
        "not_found_in_trash" => __("No Galleries found in trash", "imigrasi"),
        "parent" => __("Parent Gallery:", "imigrasi"),
        "featured_image" => __("Featured image for this Gallery", "imigrasi"),
        "set_featured_image" => __("Set featured image for this Gallery", "imigrasi"),
        "remove_featured_image" => __("Remove featured image for this Gallery", "imigrasi"),
        "use_featured_image" => __("Use as featured image for this Gallery", "imigrasi"),
        "archives" => __("Gallery archives", "imigrasi"),
        "insert_into_item" => __("Insert into Gallery", "imigrasi"),
        "uploaded_to_this_item" => __("Upload to this Gallery", "imigrasi"),
        "filter_items_list" => __("Filter Galleries list", "imigrasi"),
        "items_list_navigation" => __("Galleries list navigation", "imigrasi"),
        "items_list" => __("Galleries list", "imigrasi"),
        "attributes" => __("Galleries attributes", "imigrasi"),
        "name_admin_bar" => __("Gallery", "imigrasi"),
        "item_published" => __("Gallery published", "imigrasi"),
        "item_published_privately" => __("Gallery published privately.", "imigrasi"),
        "item_reverted_to_draft" => __("Gallery reverted to draft.", "imigrasi"),
        "item_scheduled" => __("Gallery scheduled", "imigrasi"),
        "item_updated" => __("Gallery updated.", "imigrasi"),
        "parent_item_colon" => __("Parent Resource:", "imigrasi"),
    ];

    $args = [
        "label" => __("Galleries", "imigrasi"),
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "gallery", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-post",
        "supports" => ["title",  "excerpt", "editor", "thumbnail"],
        "show_in_graphql" => true,
        "graphql_single_name" => "Gallery",
        "graphql_plural_name" => "Galleries",
    ];

    register_post_type("gallery", $args);
}


add_action('init', 'cptui_register_my_cpts_gallery');

add_action('init', function () {
    $labels = [
        'name'                       => __('Categories', 'imigrasi'),
        'singular_name'              => __('Category', 'imigrasi'),
        'menu_name'                  => __('Categories', 'imigrasi'),
        'all_items'                  => __('All Categories', 'imigrasi'),
        'edit_item'                  => __('Edit Category', 'imigrasi'),
        'view_item'                  => __('View Category', 'imigrasi'),
        'update_item'                => __('Update Category name', 'imigrasi'),
        'add_new_item'               => __('Add new Category', 'imigrasi'),
        'new_item_name'              => __('New Category name', 'imigrasi'),
        'parent_item'                => __('Parent Category', 'imigrasi'),
        'parent_item_colon'          => __('Parent Category:', 'imigrasi'),
        'search_items'               => __('Search Categories', 'imigrasi'),
        'popular_items'              => __('Popular Categories', 'imigrasi'),
        'separate_items_with_commas' => __('Separate Categories with commas', 'imigrasi'),
        'add_or_remove_items'        => __('Add or remove Categories', 'imigrasi'),
        'choose_from_most_used'      => __('Choose from the most used Categories', 'imigrasi'),
        'not_found'                  => __('No Categories found', 'imigrasi'),
        'no_terms'                   => __('No Categories', 'imigrasi'),
        'items_list_navigation'      => __('Categories list navigation', 'imigrasi'),
        'items_list'                 => __('Categories list', 'imigrasi'),
    ];

    $args = [
        'label'                 => __('Category', 'csh'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'gallery-category', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'gallery-category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => false,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'GalleryCategory',
        'graphql_plural_name'   => 'GalleryCategories',
    ];

    register_taxonomy('gallery-category', ['gallery'], $args);
});
