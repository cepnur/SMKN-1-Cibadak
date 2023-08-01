<?php

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_theme_options',
        'redirect' => true,
    ]);
    acf_add_options_sub_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-settings',
        'parent_slug' => 'theme-general-settings',
    ]);

    acf_add_options_sub_page([
        'page_title' => 'Sosial Media Setting',
        'menu_title' => 'Sosial Media',
        'menu_slug' => 'theme-settings-sosmed',
        'parent_slug' => 'theme-general-settings',
    ]);

    acf_add_options_sub_page([
        'page_title' => 'Passport Messages',
        'menu_title' => 'Passport Message',
        'menu_slug' => 'theme-settings-passport-message',
        'parent_slug' => 'theme-general-settings',
    ]);
}

if (function_exists('acf_add_local_field_group')) :

    

endif;

function default_styles()
{

    // Add support for block styles.
    add_theme_support('wp-block-styles');

    // Enqueue editor styles.
    add_editor_style('style.css');
}

add_action('after_setup_theme', 'default_styles');

