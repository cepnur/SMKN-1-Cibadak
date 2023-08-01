<?php

function cptui_register_my_cpts_pengaduan()
{

    /**
     * Post Type: Magang.
     */

    $labels = [
        "name" => __("Pengaduan", "imigrasi"),
        "singular_name" => __("Pengaduan", "imigrasi"),
        "menu_name" => __("Pengaduan", "imigrasi"),
        "all_items" => __("All Pengaduan", "imigrasi"),
        "add_new" => __("Add new", "imigrasi"),
        "add_new_item" => __("Add new Pengaduan", "imigrasi"),
        "edit_item" => __("Edit Pengaduan", "imigrasi"),
        "new_item" => __("New Pengaduan", "imigrasi"),
        "view_item" => __("View Pengaduan", "imigrasi"),
        "view_items" => __("View Pengaduan", "imigrasi"),
        "search_items" => __("Search Pengaduan", "imigrasi"),
        "not_found" => __("No Pengaduan found", "imigrasi"),
        "not_found_in_trash" => __("No Pengaduan found in trash", "imigrasi"),
        "parent" => __("Parent Pengaduan:", "imigrasi"),
        "featured_image" => __("Featured image for this Pengaduan", "imigrasi"),
        "set_featured_image" => __("Set featured image for this Pengaduan", "imigrasi"),
        "remove_featured_image" => __("Remove featured image for this Pengaduan", "imigrasi"),
        "use_featured_image" => __("Use as featured image for this Pengaduan", "imigrasi"),
        "archives" => __("Pengaduan archives", "imigrasi"),
        "insert_into_item" => __("Insert into Pengaduan", "imigrasi"),
        "uploaded_to_this_item" => __("Upload to this Pengaduan", "imigrasi"),
        "filter_items_list" => __("Filter Pengaduan list", "imigrasi"),
        "items_list_navigation" => __("Pengaduan list navigation", "imigrasi"),
        "items_list" => __("Pengaduan list", "imigrasi"),
        "attributes" => __("Pengaduan attributes", "imigrasi"),
        "name_admin_bar" => __("Pengaduan", "imigrasi"),
        "item_published" => __("Pengaduan published", "imigrasi"),
        "item_published_privately" => __("Pengaduan published privately.", "imigrasi"),
        "item_reverted_to_draft" => __("Pengaduan reverted to draft.", "imigrasi"),
        "item_scheduled" => __("Pengaduan scheduled", "imigrasi"),
        "item_updated" => __("Pengaduan updated.", "imigrasi"),
        "parent_item_colon" => __("Parent Resource:", "imigrasi"),
    ];

    $args = [
        "label" => __("Pengaduan", "imigrasi"),
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
        "rewrite" => ["slug" => "pengaduan", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-post",
        "supports" => ["title", "author"],
        "show_in_graphql" => true,
        "graphql_single_name" => "Pengaduan",
        "graphql_plural_name" => "SemuaPengaduan",
    ];

    register_post_type("pengaduan", $args);
}


add_action('init', 'cptui_register_my_cpts_pengaduan');

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
        'rewrite'               => ['slug' => 'status-pengaduan', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'status-pengaduan',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => true,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'PengaduanStatus',
        'graphql_plural_name'   => 'PengaduanStatuses',
    ];

    register_taxonomy('status-pengaduan', ['pengaduan'], $args);
});

add_action('init', function () {
    $labels = [
        'name'                       => __('Kategori', 'imigrasi'),
        'singular_name'              => __('Kategori', 'imigrasi'),
        'menu_name'                  => __('Kategori', 'imigrasi'),
        'all_items'                  => __('All Kategori', 'imigrasi'),
        'edit_item'                  => __('Edit Kategori', 'imigrasi'),
        'view_item'                  => __('View Kategori', 'imigrasi'),
        'update_item'                => __('Update Kategori name', 'imigrasi'),
        'add_new_item'               => __('Add New Kategori', 'imigrasi'),
        'new_item_name'              => __('New Kategori name', 'imigrasi'),
        'parent_item'                => __('Parent Kategori', 'imigrasi'),
        'parent_item_colon'          => __('Parent Kategori:', 'imigrasi'),
        'search_items'               => __('Search Kategori', 'imigrasi'),
        'popular_items'              => __('Popular Kategori', 'imigrasi'),
        'separate_items_with_commas' => __('Separate Kategori with commas', 'imigrasi'),
        'add_or_remove_items'        => __('Add or remove Kategori', 'imigrasi'),
        'choose_from_most_used'      => __('Choose from the most used Kategori', 'imigrasi'),
        'not_found'                  => __('No Kategori found', 'imigrasi'),
        'no_terms'                   => __('No Kategori', 'imigrasi'),
        'items_list_navigation'      => __('Kategori list navigation', 'imigrasi'),
        'items_list'                 => __('Kategori list', 'imigrasi'),
    ];

    $args = [
        'label'                 => __('Kategori', 'imigrasi'),
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'kategori-pengaduan', 'with_front' => true],
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'kategori-pengaduan',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_in_quick_edit'    => true,
        'show_in_graphql'       => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'PengaduanKategori',
        'graphql_plural_name'   => 'SemuaPengaduanKategori',
    ];

    register_taxonomy('kategori-pengaduan', ['pengaduan'], $args);
});