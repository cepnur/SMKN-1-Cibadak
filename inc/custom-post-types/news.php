<?php

function cptui_register_my_cpts_news() {
  /**
   * Post Type: News.
   */

  $labels = [
    "name" => __( "News", "csh" ),
    "singular_name" => __( "News", "csh" ),
    "menu_name" => __( "News", "csh" ),
    "all_items" => __( "All News", "csh" ),
    "add_new" => __( "Add News", "csh" ),
    "add_new_item" => __( "Add News", "csh" ),
    "edit_item" => __( "Edit News", "csh" ),
    "new_item" => __( "New News", "csh" ),
    "view_item" => __( "View News", "csh" ),
    "view_items" => __( "View News", "csh" ),
    "search_items" => __( "Search News", "csh" ),
    "not_found" => __( "No News found", "csh" ),
    "not_found_in_trash" => __( "No News found in trash", "csh" ),
    "parent" => __( "Parent News:", "csh" ),
    "featured_image" => __( "Featured image for this News", "csh" ),
    "set_featured_image" => __( "Set featured image for this News", "csh" ),
    "remove_featured_image" => __( "Remove featured image for this News", "csh" ),
    "use_featured_image" => __( "Use as featured image for this News", "csh" ),
    "archives" => __( "News archives", "csh" ),
    "insert_into_item" => __( "Insert into News", "csh" ),
    "uploaded_to_this_item" => __( "Upload to this News", "csh" ),
    "filter_items_list" => __( "Filter News list", "csh" ),
    "items_list_navigation" => __( "News list navigation", "csh" ),
    "items_list" => __( "News list", "csh" ),
    "attributes" => __( "News attributes", "csh" ),
    "name_admin_bar" => __( "News", "csh" ),
    "item_published" => __( "News published", "csh" ),
    "item_published_privately" => __( "News published privately.", "csh" ),
    "item_reverted_to_draft" => __( "News reverted to draft.", "csh" ),
    "item_scheduled" => __( "News scheduled", "csh" ),
    "item_updated" => __( "News updated.", "csh" ),
    "parent_item_colon" => __( "Parent News:", "csh" ),
  ];

  $args = [
    "label" => __( "News", "csh" ),
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
    "rewrite" => [ "slug" => "news", "with_front" => true ],
    "query_var" => true,
    "menu_icon" => "dashicons-admin-post",
    "supports" => [ "title","thumbnail","excerpt"],
    "show_in_graphql" => true,
    "graphql_single_name" => "news",
    "graphql_plural_name" => "allNews",
  ];

  register_post_type( "news", $args );
}


add_action( 'init', 'cptui_register_my_cpts_news' );

add_action('init', function () {
  $labels = [
      'name'                       => __('News Categories', 'csh'),
      'singular_name'              => __('News Category', 'csh'),
      'menu_name'                  => __('News Categories', 'csh'),
      'all_items'                  => __('All News Categories', 'csh'),
      'edit_item'                  => __('Edit News Category', 'csh'),
      'view_item'                  => __('View News Category', 'csh'),
      'update_item'                => __('Update News Category name', 'csh'),
      'add_new_item'               => __('Add News Category', 'csh'),
      'new_item_name'              => __('New News Category name', 'csh'),
      'parent_item'                => __('Parent News Category', 'csh'),
      'parent_item_colon'          => __('Parent News Category:', 'csh'),
      'search_items'               => __('Search News Categories', 'csh'),
      'popular_items'              => __('Popular News Categories', 'csh'),
      'separate_items_with_commas' => __('Separate News Categories with commas', 'csh'),
      'add_or_remove_items'        => __('Add or remove News Categories', 'csh'),
      'choose_from_most_used'      => __('Choose from the most used News Categories', 'csh'),
      'not_found'                  => __('No News Categories found', 'csh'),
      'no_terms'                   => __('No News Categories', 'csh'),
      'items_list_navigation'      => __('News Categories list navigation', 'csh'),
      'items_list'                 => __('News Categories list', 'csh'),
  ];

  $args = [
      'label'                 => __('News Categories', 'csh'),
      'labels'                => $labels,
      'public'                => true,
      'publicly_queryable'    => true,
      'hierarchical'          => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'show_in_nav_menus'     => true,
      'query_var'             => true,
      'rewrite'               => ['slug' => 'news-category', 'with_front' => true],
      'show_admin_column'     => true,
      'show_in_rest'          => true,
      'rest_base'             => 'news-category',
      'rest_controller_class' => 'WP_REST_Terms_Controller',
      'show_in_quick_edit'    => false,
      'show_in_graphql'       => true,
      'show_in_graphql'       => true,
      'graphql_single_name'   => 'newsCategory',
      'graphql_plural_name'   => 'newsCategories',
  ];


  register_taxonomy('news_category', ['news'], $args);
  /* disable view single news */
  add_action( 'template_redirect', 'redirect_single_news' );

  function redirect_single_news() {
    $queried_post_type = get_query_var('post_type');
    if ( is_single() && 'news' ==  $queried_post_type ) {
      global $post;
      $url = get_field("custom_url", $post->ID);
      /* redirect URL */
      if ($url) {
        wp_redirect($url["url"], 301);
      }else{
        wp_redirect( home_url(), 301 );
      }
    }
  }
});

