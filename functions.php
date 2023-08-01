<?php

/**
 * csh functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package csh
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}
/**
 * Enqueue scripts and custom.
 */
require get_template_directory() . '/inc/app/setup.php';
require get_template_directory() . '/inc/app/helpers.php';
require get_template_directory() . '/inc/app/custom-helpers.php';
require get_template_directory() . '/inc/app/graphql-custom.php';
require get_template_directory() . '/inc/app/rest-endpoints.php';
require get_template_directory() . '/inc/app/enqueue-scripts-styles.php';

require get_template_directory() . '/inc/app/theme-settings.php';

require get_template_directory() . '/inc/custom-post-types/regulation.php';

require get_template_directory() . '/inc/custom-post-types/gallery.php';

require get_template_directory() . '/inc/custom-post-types/magang.php';
require get_template_directory() . '/inc/app/magang-custum-fuctions.php';

require get_template_directory() . '/inc/custom-post-types/pengaduan.php';
require get_template_directory() . '/inc/app/pengaduan-custom-functions.php';

require get_template_directory() . '/inc/custom-post-types/passport.php';

/**
 * Disable EMOJIs
 */
require get_template_directory() . '/inc/disable-emojis.php';

/**
 * Disable Comments
 */
require get_template_directory() . '/inc/disable-comments.php';

/**
 * Enable SVG
 */
require get_template_directory() . '/inc/enable-svg.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
// if (class_exists('WooCommerce')) {
//     require get_template_directory() . '/inc/woocommerce.php';
// }

require get_template_directory() . '/inc/seo-tag.php';

require get_template_directory() . '/inc/block-editor.php';

/**
 * Includes posts filter
 */
require get_template_directory() . '/inc/app/posts-filter.php';

/**
 * Restrict page access for 
 * user subscriber
 */


function restrict_page_access()
{
    if (is_user_logged_in() && !is_admin()) {
        global $post;

        $PageRegister = csh_get_id_by_slug('register-user');
        $PageLoginUser = csh_get_id_by_slug('login-member');

        $restricted_pages = array($PageRegister, $PageLoginUser);
        if (in_array($post->ID, $restricted_pages)) {
            wp_redirect(home_url());
            exit();
        }
    }
}
add_action('wp', 'restrict_page_access');

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

function restrict_subscriber_access()
{

    if (current_user_can('subscriber')) {
        // wp_redirect(home_url());
        remove_menu_page('edit.php?post_type=gallery');
        remove_menu_page('edit.php?post_type=regulation');
        remove_menu_page('edit.php');
        remove_menu_page('admin.php?page=theme-settings');
    }
}
add_action('admin_init', 'restrict_subscriber_access');


if (!is_user_logged_in()) {
    add_action('init', 'request_magang_init');
    add_action('init', 'submit_pengaduan_init');
} else {
    add_action('init', 'request_magang_init');
    add_action('init', 'submit_pengaduan_init');
    add_action('init', 'update_user_profile_init');
    add_action('init', 'request_passport_init');
}

function request_magang_init()
{
    add_action('wp_ajax_nopriv_requestMagang', 'request_magang');
    add_action('wp_ajax_requestMagang', 'request_magang');
}

function submit_pengaduan_init()
{
    add_action('wp_ajax_nopriv_submitPengaduan', 'submit_pengaduan');
    add_action('wp_ajax_submitPengaduan', 'submit_pengaduan');
}

function update_user_profile_init()
{
    add_action('wp_ajax_nopriv_updateUserProfile', 'update_user_profile');
    add_action('wp_ajax_updateUserProfile', 'update_user_profile');
}

function request_passport_init(){
    add_action('wp_ajax_nopriv_requestPassport', 'imigrasi_add_request_passport');
    add_action('wp_ajax_requestPassport', 'imigrasi_add_request_passport');
}

function update_user_profile()
{
    check_ajax_referer('ajax-register-nonce', 'security');
    $firstName  = sanitize_text_field($_POST["first_name"]);
    $lastName  = sanitize_text_field($_POST["last_name"]);
    $email  = sanitize_email($_POST["email"]);
    $phoneNumber  = sanitize_text_field($_POST["phone_number"]);
    $nik  = sanitize_text_field($_POST["nik"]);



    // Periksa apakah pengguna sedang login
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_data = [
            'ID'           => $user_id,
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'user_email'   => $email,
        ];

        // Periksa apakah nomor telepon diberikan
        if (!empty($phoneNumber)) {
            update_field('user_phone_number',$phoneNumber, 'user_' . $user_id);
        }

        // Periksa apakah nik diberikan
        if (!empty($nik)) {
            update_field('user_nik',$nik, 'user_' . $user_id);
        }

        // Perbarui data pengguna
        wp_update_user($user_data);

        $response = [
            "status"   => "true",
            "message"  => 'User profile has been updated.'
        ];
    } else {
        $response = [
            "status"   => "false",
            "message"  => 'User is not logged in.'
        ];
    }

    echo json_encode($response);
    exit;
}

function submit_pengaduan()
{
    check_ajax_referer('ajax-register-nonce', 'security');
    $nama  = sanitize_text_field($_POST["nama"]);
    $email  = sanitize_text_field($_POST["email"]);
    $kategori  = sanitize_text_field($_POST["kategori"]);
    $pesan  = sanitize_text_field($_POST["pesan"]);
    $nik  = sanitize_text_field($_POST["nik"]);
    $subject  = sanitize_text_field($_POST["subject"]);

    $postData = array(
        'post_title' => $subject,
        'post_status' => "publish",
        'post_type' => "pengaduan",
        'post_author' => get_current_user_id() ?? 1
    );
    kses_remove_filters();
    $post_id = wp_insert_post($postData);


    if (!$post_id) {
        $response = [
            "status"   => "false",
            "message"  => 'Submited error. Try Again.'
        ];
        echo json_encode($response);
        exit;
    }

    wp_set_object_terms($post_id, $kategori, "kategori-pengaduan", true);
    wp_set_object_terms($post_id, 'Diproses', "status-pengaduan", true);
    
    update_field('pengaduan_full_name', $nama, $post_id);
    update_field('pengaduan_nik', $nik, $post_id);
    update_field('pengaduan_email', $email, $post_id);
    update_field('pengaduan_pesan', $pesan, $post_id);

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $attachment_id = media_handle_upload('file', $post_id);
    update_field('pengaduan_file', $attachment_id, $post_id);

    $response = [
        "status"   => "true",
        "message"  => 'Data has been submited'
    ];
    echo json_encode($response);
    exit;
}

function request_magang()
{
    check_ajax_referer('ajax-register-nonce', 'security');
    $nim  = sanitize_text_field($_POST["nim"]);
    $nama  = sanitize_text_field($_POST["nama"]);
    $email  = sanitize_text_field($_POST["email"]);
    $sekolah  = sanitize_text_field($_POST["sekolah"]);
    $no_telepon  = sanitize_text_field($_POST["no_telepon"]);
    $tempat_lahir  = sanitize_text_field($_POST["tempat_lahir"]);
    $tanggal_lahir  = sanitize_text_field($_POST["tanggal_lahir"]);
    $alamat  = sanitize_text_field($_POST["alamat"]);
    $mulai_magang = sanitize_text_field($_POST["mulai_magang"]);
    $berakhir_magang = sanitize_text_field($_POST["berakhir_magang"]);


    $postData = array(
        'post_title' => $nama,
        'post_status' => "publish",
        'post_type' => "magang-request",
        'post_author' => get_current_user_id() ?? 1
    );
    kses_remove_filters();
    $post_id = wp_insert_post($postData);


    if (!$post_id) {
        $response = [
            "status"   => "false",
            "message"  => 'Submited error. Try Again.'
        ];
        echo json_encode($response);
        exit;
    }

    wp_set_object_terms($post_id, "Diajukan", "magang-status", true);
    $term = get_term_by( 'name', 'Diajukan', 'magang-status');

    update_field('req_magang_nim', $nim, $post_id);
    update_field('req_magang_nama_lengkap', $nama, $post_id);
    update_field('req_magang_email', $email, $post_id);
    update_field('req_magang_sekolah', $sekolah, $post_id);
    update_field('req_magang_no_telepon', $no_telepon, $post_id);

    update_field('req_magang_tempat_lahir', $tempat_lahir, $post_id);
    update_field('req_magang_tanggal_lahir', $tanggal_lahir, $post_id);
    update_field('req_magang_alamat', $alamat, $post_id);

    
    update_field('req_magang_mulai', $mulai_magang, $post_id);
    update_field('req_magang_berakhir', $berakhir_magang, $post_id);

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $attachment_id = media_handle_upload('file', $post_id);
    update_field('req_magang_file', $attachment_id, $post_id);
    $headers = array('Content-Type: text/html; charset=UTF-8;');


    //email send
    $emailMessage = get_field('update_email_messages', $term->taxonomy . '_' . $term->term_id);

    wp_mail($email, "Pengajuan Magang - Imigrasi Sukabumi", $emailMessage, $headers);

    $response = [
        "status"   => "true",
        "message"  => 'Request has been submited'
    ];
    echo json_encode($response);
    exit;
}

function imigrasi_add_request_passport(){
    check_ajax_referer('ajax-register-nonce', 'security');
    $nik  = sanitize_text_field($_POST["nik"]);
    $nama  = sanitize_text_field($_POST["nama"]);
    $email  = sanitize_text_field($_POST["email"]);
    $no_telepon  = sanitize_text_field($_POST["no_telepon"]);
    $tempat_lahir  = sanitize_text_field($_POST["tempat_lahir"]);
    $tanggal_lahir  = sanitize_text_field($_POST["tanggal_lahir"]);
    $alamat  = sanitize_text_field($_POST["alamat"]);

    $postData = array(
        'post_title' => $nama,
        'post_status' => "publish",
        'post_type' => "imigrasi-passport",
        'post_author' => get_current_user_id() ?? 1
    );
    kses_remove_filters();
    $post_id = wp_insert_post($postData);
    if (!$post_id) {
        $response = [
            "status"   => "false",
            "message"  => 'Submited error. Try Again.'
        ];
        echo json_encode($response);
        exit;
    }
    wp_set_object_terms($post_id, "Diproses", "passport-status", true);

    update_field('req_passport_nik', $nik, $post_id);
    update_field('req_passport_nama_lengkap', $nama, $post_id);
    update_field('req_passport_email', $email, $post_id);
    update_field('req_passport_no_telepon', $no_telepon, $post_id);
    update_field('req_passport_tempat_lahir', $tempat_lahir, $post_id);
    update_field('req_passport_tanggal_lahir', $tanggal_lahir, $post_id);
    update_field('req_passport_alamat', $alamat, $post_id);



    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $attachment_id = media_handle_upload('file', $post_id);
    update_field('req_passport_file', $attachment_id, $post_id);
    $response = [
        "status"   => "true",
        "message"  => 'Request has been submited'
    ];
    echo json_encode($response);
    exit;
}

global $my_query;


/* Upgrade the Subscriber Role */
function subscriber_level_up()
{
    // Retrieve the  Subscriber role.
    $role = get_role('subscriber');
    // Let's add a set  of new capabilities we want Subscribers to have.
    $role->add_cap('read_post');
    $role->add_cap('edit_post');
    $role->add_cap('publish_post');
    $role->add_cap('upload_files');
}
add_action( 'admin_init', 'subscriber_level_up');


