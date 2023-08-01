<?php

function cptui_register_my_cpts_resource()
{

    /**
     * Post Type: Resources.
     */

    $labels = [
        "name" => __("Resources", "csh"),
        "singular_name" => __("Resource", "csh"),
        "menu_name" => __("Resources", "csh"),
        "all_items" => __("All Resources", "csh"),
        "add_new" => __("Add new", "csh"),
        "add_new_item" => __("Add new Resource", "csh"),
        "edit_item" => __("Edit Resource", "csh"),
        "new_item" => __("New Resource", "csh"),
        "view_item" => __("View Resource", "csh"),
        "view_items" => __("View Resources", "csh"),
        "search_items" => __("Search Resources", "csh"),
        "not_found" => __("No Resources found", "csh"),
        "not_found_in_trash" => __("No Resources found in trash", "csh"),
        "parent" => __("Parent Resource:", "csh"),
        "featured_image" => __("Featured image for this Resource", "csh"),
        "set_featured_image" => __("Set featured image for this Resource", "csh"),
        "remove_featured_image" => __("Remove featured image for this Resource", "csh"),
        "use_featured_image" => __("Use as featured image for this Resource", "csh"),
        "archives" => __("Resource archives", "csh"),
        "insert_into_item" => __("Insert into Resource", "csh"),
        "uploaded_to_this_item" => __("Upload to this Resource", "csh"),
        "filter_items_list" => __("Filter Resources list", "csh"),
        "items_list_navigation" => __("Resources list navigation", "csh"),
        "items_list" => __("Resources list", "csh"),
        "attributes" => __("Resources attributes", "csh"),
        "name_admin_bar" => __("Resource", "csh"),
        "item_published" => __("Resource published", "csh"),
        "item_published_privately" => __("Resource published privately.", "csh"),
        "item_reverted_to_draft" => __("Resource reverted to draft.", "csh"),
        "item_scheduled" => __("Resource scheduled", "csh"),
        "item_updated" => __("Resource updated.", "csh"),
        "parent_item_colon" => __("Parent Resource:", "csh"),
    ];

    $args = [
        "label" => __("Resources", "csh"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "resources", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-post",
        "supports" => ["title",  "excerpt", "editor", "thumbnail"],
        "show_in_graphql" => true,
        "graphql_single_name" => "resource",
        "graphql_plural_name" => "resources",
    ];

    register_post_type("resource", $args);
}


add_action('init', 'cptui_register_my_cpts_resource');

add_action('init', function () {
    $labels = [
        'name'                       => __('Resource Categories', 'csh'),
        'singular_name'              => __('Resource Category', 'csh'),
        'menu_name'                  => __('Resource Categories', 'csh'),
        'all_items'                  => __('All Resource Categories', 'csh'),
        'edit_item'                  => __('Edit Resource Category', 'csh'),
        'view_item'                  => __('View Resource Category', 'csh'),
        'update_item'                => __('Update Resource Category name', 'csh'),
        'add_new_item'               => __('Add new Resource Category', 'csh'),
        'new_item_name'              => __('New Resource Category name', 'csh'),
        'parent_item'                => __('Parent Resource Category', 'csh'),
        'parent_item_colon'          => __('Parent Resource Category:', 'csh'),
        'search_items'               => __('Search Resource Categories', 'csh'),
        'popular_items'              => __('Popular Resource Categories', 'csh'),
        'separate_items_with_commas' => __('Separate Resource Categories with commas', 'csh'),
        'add_or_remove_items'        => __('Add or remove Resource Categories', 'csh'),
        'choose_from_most_used'      => __('Choose from the most used Resource Categories', 'csh'),
        'not_found'                  => __('No Resource Categories found', 'csh'),
        'no_terms'                   => __('No Resource Categories', 'csh'),
        'items_list_navigation'      => __('Resource Categories list navigation', 'csh'),
        'items_list'                 => __('Resource Categories list', 'csh'),
    ];

    $args = [
        'label'                 => __('Resource Categories', 'csh'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'resource-category', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'resource-category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => false,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'resourcesCategory',
        'graphql_plural_name'   => 'resourcesCategories',
    ];

    register_taxonomy('resource-category', ['resource'], $args);
});
