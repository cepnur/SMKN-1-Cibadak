<?php 
//This snippet goes in your theme functions.php or plugin

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info
function insert_fb_in_head() {
    global $post;
    if ( !is_single()){ //if it is not a post or a page
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="website"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'.get_bloginfo( 'name' ).'"/>';//change My Website to your thing
        echo '<meta property="og:description" content="'.get_bloginfo( 'description' ).'"/>';//change description to your thing
        echo '<meta property="og:image" content="' . get_template_directory_uri() . '/resources/images/default-image.jpeg">';
        echo "
    ";
    }
    if ( is_single()){
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'.get_bloginfo( 'name' ).'"/>';//change My Website to your thing
        echo '<meta property="og:description" content="' . get_the_excerpt() . '"/>';

        if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image

            echo '<meta property="og:image" content="' . get_template_directory_uri() . '/resources/images/default-image.jpeg">';
        }
        else{// assign the post featured image
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'single-post-thumbnail');
            echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
        }
        echo "
    ";
    }
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );