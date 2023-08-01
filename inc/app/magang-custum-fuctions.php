<?php
global $magangBeforeStatus;
function execute_on_posts_selection_event($post_id,$post_data ){
    //You can write code here to be executed when this action occurs in WordPress. Use the parameters received in the function arguments & implement the required additional custom functionality according to your website requirements.
    global $magangBeforeStatus;
    $magangBeforeStatus = apply_filters( 'before_update_post', $post_id, 'magang-status');
}
 // add the action
add_action( 'pre_post_update', 'execute_on_posts_selection_event', 10, 2);

add_filter( 'before_update_post', function($post_id, $taxonomy){
    $termsBefore = get_the_terms( $post_id, $taxonomy );
    return $termsBefore;
}, 10, 2 );

add_action( 'save_post', 'send_email_updated_magang', 100, 2 );
function send_email_updated_magang($post_id){
    global $magangBeforeStatus, $current_screen;

    if (!wp_is_post_revision($post_id) && $current_screen->post_type == 'magang-request') {
        $headers = array('Content-Type: text/html; charset=UTF-8;');
        $magangAfterStatus = get_the_terms($post_id, 'magang-status');
        $emailMessage = get_field('update_email_messages', $magangAfterStatus[0]->taxonomy . '_' . $magangAfterStatus[0]->term_id);
        $email = get_field('req_magang_email', $post_id);
        if ( $magangBeforeStatus[0]->term_id !== $magangAfterStatus[0]->term_id) {
            if (!empty($email) || $email !=='' ) {
                wp_mail($email, "Pengajuan Magang - Imigrasi Sukabumi", $emailMessage, $headers);
            }
        }
    }
}