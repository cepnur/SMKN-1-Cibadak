<?php

function cptui_register_my_cpts_welcomers()
{

    /**
     * Post Type: Welcomers.
     */

    $labels = [
        "name" => esc_html__("Welcomers", "csh"),
        "singular_name" => esc_html__("Welcomer", "csh"),
    ];

    $args = [
        "label" => esc_html__("Welcomers", "csh"),
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
        "rewrite" => ["slug" => "welcomers", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-universal-access",
        "supports" => ["title", "thumbnail", "excerpt"],
        "show_in_graphql" => true,
        "graphql_single_name" => "welcomer",
        "graphql_plural_name" => "welcomers",
    ];

    register_post_type("welcomers", $args);
}

add_action('init', 'cptui_register_my_cpts_welcomers');
