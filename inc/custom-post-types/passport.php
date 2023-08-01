<?php

function cptui_register_my_cpts_passport()
{

    /**
     * Post Type: Magang.
     */

    $labels = [
        "name" => __("Passports", "imigrasi"),
        "singular_name" => __("Passport", "imigrasi"),
        "menu_name" => __("Passports", "imigrasi"),
        "all_items" => __("All Passports", "imigrasi"),
        "add_new" => __("Add new", "imigrasi"),
        "add_new_item" => __("Add new Passport", "imigrasi"),
        "edit_item" => __("Edit Passport", "imigrasi"),
        "new_item" => __("New Passport", "imigrasi"),
        "view_item" => __("View Passport", "imigrasi"),
        "view_items" => __("View Passports", "imigrasi"),
        "search_items" => __("Search Passports", "imigrasi"),
        "not_found" => __("No Passports found", "imigrasi"),
        "not_found_in_trash" => __("No Passports found in trash", "imigrasi"),
        "parent" => __("Parent Passport:", "imigrasi"),
        "featured_image" => __("Featured image for this Passport", "imigrasi"),
        "set_featured_image" => __("Set featured image for this Passport", "imigrasi"),
        "remove_featured_image" => __("Remove featured image for this Passport", "imigrasi"),
        "use_featured_image" => __("Use as featured image for this Passport", "imigrasi"),
        "archives" => __("Passport archives", "imigrasi"),
        "insert_into_item" => __("Insert into Passport", "imigrasi"),
        "uploaded_to_this_item" => __("Upload to this Passport", "imigrasi"),
        "filter_items_list" => __("Filter Passports list", "imigrasi"),
        "items_list_navigation" => __("Passports list navigation", "imigrasi"),
        "items_list" => __("Passports list", "imigrasi"),
        "attributes" => __("Passports attributes", "imigrasi"),
        "name_admin_bar" => __("Passport", "imigrasi"),
        "item_published" => __("Passport published", "imigrasi"),
        "item_published_privately" => __("Passport published privately.", "imigrasi"),
        "item_reverted_to_draft" => __("Passport reverted to draft.", "imigrasi"),
        "item_scheduled" => __("Passport scheduled", "imigrasi"),
        "item_updated" => __("Passport updated.", "imigrasi"),
        "parent_item_colon" => __("Parent Resource:", "imigrasi"),
    ];

    $args = [
        "label" => __("Passports", "imigrasi"),
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
        "rewrite" => ["slug" => "imigrasi-passport", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-post",
        "supports" => ["title","author"],
        "show_in_graphql" => true,
        "graphql_single_name" => "Passport",
        "graphql_plural_name" => "Passports",
    ];

    register_post_type("imigrasi-passport", $args);
}


add_action('init', 'cptui_register_my_cpts_passport');

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
        'show_ui'               => false,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'passport-status', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'passport-status',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => true,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'Status',
        'graphql_plural_name'   => 'Statuses',
    ];

    register_taxonomy('passport-status', ['imigrasi-passport'], $args);
});
