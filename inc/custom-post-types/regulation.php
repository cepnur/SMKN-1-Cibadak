<?php

function cptui_register_my_cpts_regulation()
{

    /**
     * Post Type: Regulations.
     */

    $labels = [
        "name" => __("Regulations", "imigrasi"),
        "singular_name" => __("Regulation", "imigrasi"),
        "menu_name" => __("Regulations", "imigrasi"),
        "all_items" => __("All Regulations", "imigrasi"),
        "add_new" => __("Add new", "imigrasi"),
        "add_new_item" => __("Add new Regulation", "imigrasi"),
        "edit_item" => __("Edit Regulation", "imigrasi"),
        "new_item" => __("New Regulation", "imigrasi"),
        "view_item" => __("View Regulation", "imigrasi"),
        "view_items" => __("View Regulations", "imigrasi"),
        "search_items" => __("Search Regulations", "imigrasi"),
        "not_found" => __("No Regulations found", "imigrasi"),
        "not_found_in_trash" => __("No Regulations found in trash", "imigrasi"),
        "parent" => __("Parent Regulation:", "imigrasi"),
        "featured_image" => __("Featured image for this Regulation", "imigrasi"),
        "set_featured_image" => __("Set featured image for this Regulation", "imigrasi"),
        "remove_featured_image" => __("Remove featured image for this Regulation", "imigrasi"),
        "use_featured_image" => __("Use as featured image for this Regulation", "imigrasi"),
        "archives" => __("Regulation archives", "imigrasi"),
        "insert_into_item" => __("Insert into Regulation", "imigrasi"),
        "uploaded_to_this_item" => __("Upload to this Regulation", "imigrasi"),
        "filter_items_list" => __("Filter Regulations list", "imigrasi"),
        "items_list_navigation" => __("Regulations list navigation", "imigrasi"),
        "items_list" => __("Regulations list", "imigrasi"),
        "attributes" => __("Regulations attributes", "imigrasi"),
        "name_admin_bar" => __("Regulation", "imigrasi"),
        "item_published" => __("Regulation published", "imigrasi"),
        "item_published_privately" => __("Regulation published privately.", "imigrasi"),
        "item_reverted_to_draft" => __("Regulation reverted to draft.", "imigrasi"),
        "item_scheduled" => __("Regulation scheduled", "imigrasi"),
        "item_updated" => __("Regulation updated.", "imigrasi"),
        "parent_item_colon" => __("Parent Resource:", "imigrasi"),
    ];

    $args = [
        "label" => __("Regulations", "imigrasi"),
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "regulations", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-post",
        "supports" => ["title",  "excerpt", "editor", "thumbnail"],
        "show_in_graphql" => true,
        "graphql_single_name" => "Regulation",
        "graphql_plural_name" => "Regulations",
    ];

    register_post_type("regulation", $args);
}


add_action('init', 'cptui_register_my_cpts_regulation');

add_action('init', function () {
    $labels = [
        'name'                       => __('Regulation Types', 'imigrasi'),
        'singular_name'              => __('Regulation Type', 'imigrasi'),
        'menu_name'                  => __('Regulation Types', 'imigrasi'),
        'all_items'                  => __('All Regulation Types', 'imigrasi'),
        'edit_item'                  => __('Edit Regulation Type', 'imigrasi'),
        'view_item'                  => __('View Regulation Type', 'imigrasi'),
        'update_item'                => __('Update Regulation Type name', 'imigrasi'),
        'add_new_item'               => __('Add new Regulation Type', 'imigrasi'),
        'new_item_name'              => __('New Regulation Type name', 'imigrasi'),
        'parent_item'                => __('Parent Regulation Type', 'imigrasi'),
        'parent_item_colon'          => __('Parent Regulation Type:', 'imigrasi'),
        'search_items'               => __('Search Regulation Types', 'imigrasi'),
        'popular_items'              => __('Popular Regulation Types', 'imigrasi'),
        'separate_items_with_commas' => __('Separate Regulation Types with commas', 'imigrasi'),
        'add_or_remove_items'        => __('Add or remove Regulation Types', 'imigrasi'),
        'choose_from_most_used'      => __('Choose from the most used Regulation Types', 'imigrasi'),
        'not_found'                  => __('No Regulation Types found', 'imigrasi'),
        'no_terms'                   => __('No Regulation Types', 'imigrasi'),
        'items_list_navigation'      => __('Regulation Types list navigation', 'imigrasi'),
        'items_list'                 => __('Regulation Types list', 'imigrasi'),
    ];

    $args = [
        'label'                 => __('Regulation Type', 'csh'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'regulation-type', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'regulation-type',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => false,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'regulationType',
        'graphql_plural_name'   => 'regulationTypes',
    ];

    register_taxonomy('regulation-type', ['regulation'], $args);
});
