<?php

function imigrasi_export_posts_to_excel( $admin_query) {
    
    global $my_query;
    if (isset($_GET['action']) && $_GET['action'] === 'export_posts') {
    // Query untuk mendapatkan data posting yang ingin diekspor
      $args = array(
        'post_type' => $_GET['post_type'], // Ganti dengan jenis posting yang sesuai
        'date_query' => [
            'after' => $_GET['dateafter'],
            'before' => $_GET['datebefore'] ?? $_GET['dateafter'],
            'inclusive' => true,
            'column' => 'post_date'    
        ],
        'posts_per_page' => -1,
      );
      $query = new WP_Query($args);
      // Membuat file Excel
      require_once ABSPATH . 'wp-admin/includes/file.php';
      require_once ABSPATH . 'wp-admin/includes/export.php';
  
      $export_data = array();
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          $post_id = get_the_ID();
          $post_title = get_the_title();
  
          $export_data[] = array(
            'ID' => $post_id,
            'subject' => $post_title,
            'nik' => get_field('pengaduan_nik', $post_id),
            'name' => get_field('pengaduan_full_name', $post_id),
            'email' => get_field('pengaduan_email', $post_id),
            'pesan' => get_field('pengaduan_pesan', $post_id),
            'file' => get_field('pengaduan_file', $post_id) ?? '',
          );
        }
      }
    //   echo '<pre>';
    //   echo print_r($export_data);
    //   exit;

        if ($export_data) {
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="report-pengaduan.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');

            $file = fopen('php://output', 'w');
            fputcsv($file, array('ID', 'Subject', 'NIK', 'Name', 'Email', 'Kategori', 'Pesan', 'Status', 'file'));
            foreach ($export_data as $data) {
                $categories = get_the_terms( $data['ID'], 'kategori-pengaduan' );
                $cats = array();
                if (!empty($categories)) {
                    foreach ( $categories as $category ) {
                        $cats[] = $category->name;
                    }
                }

                $statuses = get_the_terms( $data['ID'], 'status-pengaduan' );
                $stats = array();
                if (!empty($statuses)) {
                    foreach ( $statuses as $stat ) {
                        $stats[] = $stat->name;
                    }
                }

                $tmpFile = "";
                if (!empty($data['file'])) {
                    $tmpFile = $data['file']['url'];
                }

                fputcsv($file, array($data['ID'], $data['subject'], $data['nik'], $data['name'], $data['email'], implode(",", $cats), $data['pesan'], implode(",", $stats), $tmpFile));
            }
            exit();
        }
    }
}

add_action('admin_init', 'imigrasi_export_posts_to_excel');

function imigrasi_admin_post_list_add_export_button(){
    global $pagenow;
    global $my_query;

    $post_type = ( isset($_GET['post_type']) ) ? $_GET['post_type'] : 'pengaduan';

    if ($post_type == 'pengaduan' && $pagenow == 'edit.php' && !isset($_GET['date_query'])) {
        $postType = $my_query->query['post_type'];
        $dateafter = $my_query->query_vars['date_query']['after'] ?? '';
        $datebefore = $my_query->query_vars['date_query']['before'] ?? '';
        if ($pagenow === 'edit.php') { // Pastikan berada pada halaman "All Posts"
        ?>
        <style>
            .export-button {
            display: inline-block;
            margin-left: 10px;
            }
        </style>
        <a href="<?php echo esc_url(admin_url('admin-post.php?action=export_posts&post_type='.$postType.'&dateafter='.$dateafter.'&datebefore='.$datebefore)); ?>" class="button button-primary">Export to Excel</a>
        <?php
        }
    }
}

add_action( 'manage_posts_extra_tablenav', 'imigrasi_admin_post_list_add_export_button', 20, 1 );

add_action( 'save_post', 'send_email_respone_pengaduan', 100, 1 );
function send_email_respone_pengaduan($post_id){
    global $current_screen;

    if (!wp_is_post_revision($post_id) && $current_screen->post_type == 'pengaduan') {
        $emailMessage = get_field('pengaduan_submit_respon', $post_id) ?? '';
        $email = get_field('pengaduan_email', $post_id) ?? '';
        $headers = array('Content-Type: text/html; charset=UTF-8;');
        if (!empty($email) || $email !== '' || !empty($emailMessage) || $emailMessage !== '') {
            wp_mail($email, "Replay Pengaduan - Imigrasi Sukabumi", $emailMessage,$headers);
        }
    }
}