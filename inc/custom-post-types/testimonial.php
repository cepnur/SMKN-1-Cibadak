<?php

function cptui_register_my_cpts_testimonial() {
  /**
   * Post Type: Stories of Welcome.
   */

  $labels = [
    "name" => __( "Stories of Welcome", "csh" ),
    "singular_name" => __( "Stories", "csh" ),
    "menu_name" => __( "Stories of Welcome", "csh" ),
    "all_items" => __( "All Stories Stories of Welcome", "csh" ),
    "add_new" => __( "Add Stories", "csh" ),
    "add_new_item" => __( "Add Stories", "csh" ),
    "edit_item" => __( "Edit Stories", "csh" ),
    "new_item" => __( "New Stories", "csh" ),
    "view_item" => __( "View Stories", "csh" ),
    "view_items" => __( "View Stories", "csh" ),
    "search_items" => __( "Search Stories", "csh" ),
    "not_found" => __( "No Stories found", "csh" ),
    "not_found_in_trash" => __( "No Stories found in trash", "csh" ),
    "parent" => __( "Parent Stories:", "csh" ),
    "featured_image" => __( "Featured image for this Stories", "csh" ),
    "set_featured_image" => __( "Set featured image for this Stories", "csh" ),
    "remove_featured_image" => __( "Remove featured image for this Stories", "csh" ),
    "use_featured_image" => __( "Use as featured image for this Stories", "csh" ),
    "archives" => __( "Stories archives", "csh" ),
    "insert_into_item" => __( "Insert into Stories", "csh" ),
    "uploaded_to_this_item" => __( "Upload to this Stories", "csh" ),
    "filter_items_list" => __( "Filter Stories list", "csh" ),
    "items_list_navigation" => __( "Stories list navigation", "csh" ),
    "items_list" => __( "Stories list", "csh" ),
    "attributes" => __( "Stories attributes", "csh" ),
    "name_admin_bar" => __( "Stories", "csh" ),
    "item_published" => __( "Stories published", "csh" ),
    "item_published_privately" => __( "Stories published privately.", "csh" ),
    "item_reverted_to_draft" => __( "Stories reverted to draft.", "csh" ),
    "item_scheduled" => __( "Stories scheduled", "csh" ),
    "item_updated" => __( "Stories updated.", "csh" ),
    "parent_item_colon" => __( "Parent Stories:", "csh" ),
  ];

  $args = [
    "label" => esc_html__("Story", "csh"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "stories", "with_front" => true],
    "query_var" => true,
    "menu_icon" => "dashicons-universal-access",
    "supports" => ["title", "editor","thumbnail", "excerpt"],
    "show_in_graphql" => true,
    "graphql_single_name" => "storyOfWelcome",
    "graphql_plural_name" => "storiesOfWelcome",
  ];
  register_post_type("testimonial", $args);
}

add_action( 'init', 'cptui_register_my_cpts_testimonial' );

