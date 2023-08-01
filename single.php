<?php
get_header();

$detail = [
    'id'      => $post->ID,
    'image'  => get_the_post_thumbnail_url($post->ID),
    'content' => apply_filters("the_content", get_the_post($post)),
    'excerpt' => get_custom_excerpt($post),
    'title'   => html_entity_decode(get_the_title($post->ID)),
    'date'  => get_the_date(null, $post->ID),
    'categories' => getTaxonomy($post->ID, "category")
];

$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'post_not_in' => $post->id
];

foreach (query_posts($args) as $v) {
     $detail['relatedPosts'][] = [
            'image'  => get_the_post_thumbnail_url($v->ID),
            "name" => html_entity_decode(get_the_title($v->ID)),
            'date'  => get_the_date(null, $v->ID),
            "link" => get_permalink($v->ID),
            'excerpt' => get_the_excerpt($v) ,
        ];
}

?>
<div id="vue-app">
    <!-- <post-header :post="<?php echo parseToVue($detail); ?>"></post-header> -->
    <section class="bg-[#FAFAFA] py-9 lg:py-16">
        <div class="container flex flex-col gap-6 items-center">
            <p class="paragraph text-[#969696]">
                <span class="font-bold"><?php echo get_the_author_meta('display_name', $post->post_author); ?>, </span><?php echo get_the_date(null, $post->ID); ?></p>
            <h2 class="page-title font-bold display-2">
                <?php echo get_the_title(); ?>
            </h2>
        </div>
    </section>
</div>
<div class="relative z-10 bg-white">
    <div class="container flex mx-auto pb-7 lg:pb-14 gap-5">
        <div class="content-main-wrapper w-full">
            <?php echo get_the_post_thumbnail($post->ID, 'original', 'feature-image'); ?>
            <div class="content-main paragraph"><?php echo $detail["content"]; ?></div>
        </div>
    </div>
</div>
<div id="vue-altapp" class="pb-10 md:pb-14 lg:pb-20">
    <related-article :posts="<?php echo parseToVue($detail); ?>"></related-article>
</div>
<?php
get_footer();
