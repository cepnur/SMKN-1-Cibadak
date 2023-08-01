<?php
/* Template Name: Block Editor */
get_header();

$title = get_the_title(get_the_ID());
$footer_script = get_field("footer_script");
// Applies all registered 
// hooks, shortcodes, filters, etc...
$content = apply_filters(
    'the_content',
    get_the_content(null, false, get_the_ID())
);

?>
<div id="block-editor-app">
    <?php echo $content; ?>
</div>

<?php echo $footer_script; ?>
<?php
get_footer();
