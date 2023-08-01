<?php

function cptui_register_my_cpts_magang_request()
{

    /**
     * Post Type: Magang.
     */

    $labels = [
        "name" => __("Magang Requests", "imigrasi"),
        "singular_name" => __("Magang Request", "imigrasi"),
        "menu_name" => __("Magang Requests", "imigrasi"),
        "all_items" => __("All Magang Requests", "imigrasi"),
        "add_new" => __("Add new", "imigrasi"),
        "add_new_item" => __("Add new Magang Request", "imigrasi"),
        "edit_item" => __("Edit Magang Request", "imigrasi"),
        "new_item" => __("New Magang Request", "imigrasi"),
        "view_item" => __("View Magang Request", "imigrasi"),
        "view_items" => __("View Magang Requests", "imigrasi"),
        "search_items" => __("Search Magang Requests", "imigrasi"),
        "not_found" => __("No Magang Requests found", "imigrasi"),
        "not_found_in_trash" => __("No Magang Requests found in trash", "imigrasi"),
        "parent" => __("Parent Magang Request:", "imigrasi"),
        "featured_image" => __("Featured image for this Magang Request", "imigrasi"),
        "set_featured_image" => __("Set featured image for this Magang Request", "imigrasi"),
        "remove_featured_image" => __("Remove featured image for this Magang Request", "imigrasi"),
        "use_featured_image" => __("Use as featured image for this Magang Request", "imigrasi"),
        "archives" => __("Magang Request archives", "imigrasi"),
        "insert_into_item" => __("Insert into Magang Request", "imigrasi"),
        "uploaded_to_this_item" => __("Upload to this Magang Request", "imigrasi"),
        "filter_items_list" => __("Filter Magang Requests list", "imigrasi"),
        "items_list_navigation" => __("Magang Requests list navigation", "imigrasi"),
        "items_list" => __("Magang Requests list", "imigrasi"),
        "attributes" => __("Magang Requests attributes", "imigrasi"),
        "name_admin_bar" => __("Magang Request", "imigrasi"),
        "item_published" => __("Magang Request published", "imigrasi"),
        "item_published_privately" => __("Magang Request published privately.", "imigrasi"),
        "item_reverted_to_draft" => __("Magang Request reverted to draft.", "imigrasi"),
        "item_scheduled" => __("Magang Request scheduled", "imigrasi"),
        "item_updated" => __("Magang Request updated.", "imigrasi"),
        "parent_item_colon" => __("Parent Resource:", "imigrasi"),
    ];

    $args = [
        "label" => __("Magang Requests", "imigrasi"),
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "magang-requests", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-post",
        "supports" => ["title","author"],
        "show_in_graphql" => true,
        "graphql_single_name" => "MagangRequest",
        "graphql_plural_name" => "MagangRequests",
    ];

    register_post_type("magang-request", $args);
}


add_action('init', 'cptui_register_my_cpts_magang_request');

add_action('init', function () {
    $labels = [
        'name'                       => __('Statuses', 'imigrasi'),
        'singular_name'              => __('Status', 'imigrasi'),
        'menu_name'                  => __('Statuses', 'imigrasi'),
        'all_items'                  => __('All Statuses', 'imigrasi'),
        'edit_item'                  => __('Edit Status', 'imigrasi'),
        'view_item'                  => __('View Status', 'imigrasi'),
        'update_item'                => __('Update Status name', 'imigrasi'),
        'add_new_item'               => __('Add new Status', 'imigrasi'),
        'new_item_name'              => __('New Status name', 'imigrasi'),
        'parent_item'                => __('Parent Status', 'imigrasi'),
        'parent_item_colon'          => __('Parent Status:', 'imigrasi'),
        'search_items'               => __('Search Statuses', 'imigrasi'),
        'popular_items'              => __('Popular Statuses', 'imigrasi'),
        'separate_items_with_commas' => __('Separate Statuses with commas', 'imigrasi'),
        'add_or_remove_items'        => __('Add or remove Statuses', 'imigrasi'),
        'choose_from_most_used'      => __('Choose from the most used Statuses', 'imigrasi'),
        'not_found'                  => __('No Statuses found', 'imigrasi'),
        'no_terms'                   => __('No Statuses', 'imigrasi'),
        'items_list_navigation'      => __('Statuses list navigation', 'imigrasi'),
        'items_list'                 => __('Statuses list', 'imigrasi'),
    ];

    $args = [
        'label'                 => __('Status', 'imigrasi'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'magang-status', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'magang-status',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => true,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'Status',
        'graphql_plural_name'   => 'Statuses',
    ];

    register_taxonomy('magang-status', ['magang-request'], $args);
});
