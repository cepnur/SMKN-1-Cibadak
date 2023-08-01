<?php

function camel2dashed($className)
{
    return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
}

function template($block)
{
    $name = str_replace('acf/', '', $block['name']);
    $id = $name . '-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    $className = $name;
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

    $fields = get_fields();
?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr('vue-block')." ".$className; ?> ">

        <?php
        echo '<' . $name . ' ';
        if ($fields) {
            foreach ($fields as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }

                echo ' ' . $key . '="' . htmlspecialchars($value, ENT_QUOTES) . '"  ';
            }
        }
        ?>
        <?php 
        echo '>';
        if ( current_user_can( 'manage_options' ) ) {
        echo '<div class="border rounded-lg" style="cursor:pointer; display: block; padding: 15px; width:100%;">' . $block["title"] . '...</div></' .
            $name .
            '>'; ?>
        <?php } ?>
    </div>
<?php
}

function register_block($name, $settings_)
{
    if (function_exists('acf_register_block_type')) {
        $version = md5_file(get_stylesheet_directory() . '/mix-manifest.json');
        $settings = [
            'name' => $name,
            'render_callback' => 'template',
            'enqueue_assets' => function () use ($version) {
                if (is_admin()) {
                    wp_enqueue_style(
                        'app',
                        get_stylesheet_directory_uri() . '/dist/css/app.css',
                        [],
                        $version
                    );

                    wp_enqueue_script(
                        'bt-manifest',
                        get_template_directory_uri() . '/dist/js/manifest.js',
                        [],
                        '',
                        $version
                    );
                    wp_enqueue_script(
                        'bt-vendor',
                        get_template_directory_uri() . '/dist/js/vendor.js',
                        [],
                        '',
                        $version
                    );
                    wp_enqueue_script(
                        'vue-block',
                        get_template_directory_uri() . '/dist/js/appEditor.js',
                        ['bt-manifest', 'bt-vendor'],
                        '',
                        $version
                    );
                    wp_localize_script('vue-block', 'settings', [
                        'ajax_url'          => admin_url('admin-ajax.php'),
                        "images" => get_stylesheet_directory_uri() . "/resources/images",
                        "endpoint"  => site_url("wp-json"),
                        'nonce' => wp_create_nonce('ajax_nonce'),
                        'rest_nonce' => wp_create_nonce('wp_rest'),
                        'site' => [
                            'url' => site_url(),
                        ],
                        'primary_menu' => wp_get_menu_array(3),
                        'loginStatus' => [
                            'Status' => is_user_logged_in(),
                            'currentUser' =>  wp_get_current_user(),
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
                }
            },
        ];

        acf_register_block_type(array_merge($settings, $settings_));
    }
}

// create custom category and place it first

function custom_block_category($categories)
{
    $basic_block_custom = [
        'slug' => 'custom_basic',
        'title' => 'Basic Components',
    ];
    $basic_block_list_custom = [
        'slug' => 'custom_lists',
        'title' => 'List Components',
    ];
    
    $categories_sorted = [];
    $categories_sorted[0] = $basic_block_custom;
    $categories_sorted[1] = $basic_block_list_custom;

    foreach ($categories as $category) {
        $categories_sorted[] = $category;
    }

    return $categories_sorted;
}
add_filter('block_categories', 'custom_block_category', 10, 2);

add_action('acf/init', function () {
    
    // CUSTOM BLOCK
    register_block('hero-slider-with-image-button', [
        'title' => 'Hero Slider With Image Button',
        'description' => 'Hero Slider with Image Button',
        'category' => 'custom_basic',
        'icon' => 'format-image',
        'keywords' => ['hero', 'main hero', 'homepage'],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);
    register_block('banner-with-image-button', [
        'title' => 'Banner With Image Button',
        'description' => 'Simple banner With Image Button',
        'category' => 'custom_basic',
        'icon' => 'format-image',
        'keywords' => ['banner', 'image', 'cta', 'image button'],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);
    register_block('list-card-service', [
        'title' => 'List Card Service',
        'description' => 'Simple card list for services',
        'category' => 'custom_lists',
        'icon' => 'editor-ul',
        'keywords' => ['list', 'services'],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);
    register_block('list-latest-post', [
        'title' => 'List Latest Posts',
        'description' => 'Simple list for Latest Post',
        'category' => 'custom_lists',
        'icon' => 'embed-post',
        'keywords' => ['list', 'posts', 'latest', 'latest post'],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);
    
    register_block('tweeter-embed', [
        'title' => 'Embed Tweeter',
        'description' => 'Simple embeded tweeter',
        'category' => 'custom_basic',
        'icon' => 'embed-post',
        'keywords' => ['tweeter', 'embed', ],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);

    register_block('list-partner', [
        'title' => 'List Partner',
        'description' => 'Simple card list partner',
        'category' => 'custom_lists',
        'icon' => 'networking',
        'keywords' => ['list', 'card', 'partner'],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);

    register_block('latest-gallery', [
        'title' => 'Latest Gallery',
        'description' => 'Simple 4 cards for CPT Gallery',
        'category' => 'custom_lists',
        'icon' => 'format-image',
        'keywords' => ['list', 'card', 'gallery'],
        'mode' => 'edit',
        'mode' => false,
        'align' => false,
        // Show text alignment toolbar.
        'align_text' => false,
        // Show content alignment toolbar.
        'align_content' => false,
    ]);
});
