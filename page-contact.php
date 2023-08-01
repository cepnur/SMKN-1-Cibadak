<?php
get_header();

$title = get_the_title(get_the_ID());

// Applies all registered 
// hooks, shortcodes, filters, etc...
$content = apply_filters(
    'the_content',
    get_the_content(null, false, get_the_ID())
);

?>
<?php if (get_post_thumbnail_id(get_the_ID())) : ?>
    <img srcset="<?php echo wp_get_attachment_image_srcset(get_post_thumbnail_id(get_the_ID())); ?>" src="<?php get_the_post_thumbnail_url(get_the_ID(), "full") ?>" class="h-[434px] w-full object-center object-cover">
<?php endif ?>

<?php if (!is_front_page()) { ?>
    <!-- <section class="bg-[#FAFAFA] py-16 page-header">
        <div class="container">
            <h2 class="page-title font-bold display-2">
                <?php echo get_the_title(); ?>
            </h2>
            <p class="paragraph text-softlight pt-6  lg:w-[40%]">
                <?php echo get_field("page_header_description") ?? ''; ?>
            </p>
        </div>
    </section> -->
<?php } ?>


<div id="vue-app" class="content-main">
    <contact></contact>
</div>
<?php
echo $footer_script = get_field("footer_script");
get_footer();
