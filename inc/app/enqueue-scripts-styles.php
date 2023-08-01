<?php
add_action('wp_enqueue_scripts', function () {
    $version = md5_file(get_stylesheet_directory() . '/mix-manifest.json');
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Even more smart jQuery inclusion :)

    // Register from Google and for footer
    function jquery_register()
    {

        if (!is_admin()) {

            wp_enqueue_script(
                'jquery',
                'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
            );

            wp_enqueue_style(
                'fontAwesome',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css',
                [],
                '5.9.0'
            );
        }
    }
    add_action('init', 'jquery_register');


    wp_enqueue_style(
        'app',
        get_stylesheet_directory_uri() . '/dist/css/app.css',
        [],
        $version
    );

    wp_enqueue_style(
        'Inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        [],
        $version
    );
    wp_enqueue_script(
        'manifest',
        get_stylesheet_directory_uri() . '/dist/js/manifest.js',
        [],
        $version,
        true
    );
    wp_enqueue_script(
        'vendor',
        get_stylesheet_directory_uri() . '/dist/js/vendor.js',
        [],
        $version,
        true
    );
    wp_enqueue_script(
        'app',
        get_stylesheet_directory_uri() . '/dist/js/app.js',
        ['manifest', 'vendor'],
        $version,
        true
    );
    wp_localize_script('app', 'settings', [
        'ajax_url'      => admin_url( 'admin-ajax.php' ),
        "images" => get_stylesheet_directory_uri() . "/resources/images",
        "imagesPublic" => get_stylesheet_directory_uri() . "/dist/img",
        "endpoint"  => site_url("wp-json"),
        'nonce' => wp_create_nonce('ajax_nonce'),
        'rest_nonce' => wp_create_nonce('wp_rest'),
        'site' => [
            'url' => site_url(),
            'title' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
        ],
        'primary_menu' => wp_get_menu_array(3),
        'secondary_menu' => wp_get_menu_array(2),
        'loginStatus' => [
            'Status' => is_user_logged_in(),
            'currentUser' =>  wp_get_current_user(),
            'userMeta' => get_user_meta(wp_get_current_user()->ID),
        ],
        'social' => [
            'facebook' => get_field('sm_url_facebook', 'option') ?? false,
            'instagram' => get_field('sm_url_instagram', 'option') ?? false,
            'youtube' => get_field('sm_url_youtube', 'option') ?? false,
            'linkedin' => get_field('sm_url_linkedin', 'option') ?? false,
            'twitter' => get_field('sm_url_twitter', 'option') ?? false
        ],
        'footer_setting_desc' => get_field('footer_setting_site_desc', 'option') ?? null,
        'contact_us_setting' => [
            'phone' =>get_field('contact_setting_phone', 'option') ?? false,
            'email' =>get_field('contact_setting_email', 'option') ?? false,
            'address' =>get_field('contact_setting_address', 'option') ?? false,
        ] ?? false,
        'embed_map' => get_field('embed_map_setting_map', 'option') ?? false
    ]);
});
