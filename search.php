<?php
/* Template Name: Resources Archive */
get_header();

$title = get_the_title();
if (is_search()) {
    /* translators: %s is replaced with the search query */
    $title =  sprintf(
        __('Search Results for "%s"', "sage"),
        get_search_query()
    );
}

$terms = get_terms( array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
) );


$_s = $wp_query->query['s'] ?? '';
$_category_name = $wp_query->query['category_name'] ?? false;

$args = [
    'paged'     => 1,
    'posts_per_page' => 4,
    'post_type' => 'post',
    's' => $_s,
];

if ($_category_name) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => [$_category_name],
        )
    );
}

$wp_query = new WP_Query($args);

$posts = array_map(function ($post) {
    return [
        'id'            => $post->ID,
        'author_name'   => get_the_author_meta('display_name', $post->post_author),
        'title'         => html_entity_decode(get_the_title($post->ID)),
        'date'          => get_the_date(null,$post->ID),
        'link'          => get_the_permalink($post->ID),
        'post_thumbnail'         => get_the_post_thumbnail_url($post->ID),
        'excerpt'       => apply_filters("the_excerpt",get_the_excerpt($post->ID))
    ];
}, $wp_query->posts);

// Build pagination array
    // Build pagination array
    $current_page = isset($wp_query->query['paged']) ? (int) $wp_query->query['paged'] : 1;
    $pagination = [
        'next_page'    => $current_page < $wp_query->max_num_pages ? true : false,
        'current_page' => $current_page,
        'total_pages'  => $wp_query->max_num_pages,
        'total_posts' => (int) $wp_query->found_posts,
    ];

    wp_reset_query(  );



// echo '<pre>';
// echo print_r($wp_query);
// exit;

?>
<div id="vue-app" class="min-h-screen">
    <search :terms="<?php echo parseToVue($terms); ?>"
        :posts="<?php echo parseToVue($posts); ?>"
        :pagination="<?php echo parseToVue($pagination); ?>"
        keywords = "<?php echo $_s; ?>"
        cat_name = "<?php echo $_category_name; ?>">

    </search>
</div>

<?php
get_footer();

