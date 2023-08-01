<?php
function get_all_posts() {
    if (!isset($_GET["token"]) || $_GET["token"] != "60195446176DRT65ff6bed6b6d2f") {
        return "failed token";
    }

    $posts = get_posts([
        'post_type'      => "post",
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'order'          => 'ASC',
        'orderby'        => 'ID',
    ]);
    foreach ($posts as $post) {
        $staffId = 111;
        // get current value
        $values = get_field('staff', $post->ID, false);
        if (is_array($values)) {
        // add new id to the array
            $newStaff = $values;
            $newStaff[] = $staffId;
        }else if (is_string($values)) {
            $newStaff = array($values, $staffId);
        }else{
            $newStaff = array($staffId);
        }
        // update the field
        update_field("staff", $newStaff, $post->ID);
        echo $post->post_title.":".$post->post_type." updated \n";
    }
}

function get_latest_posts(){
    $args = array(
        'post_status' => 'publish',
        'posts_per_page'   => '10',
        'post_type'        => 'post',
    );

    $the_query = new WP_Query($args);
    $postData= array_map(function ($post) {
        return [
            'id'            => $post->ID,
            'author_name'   => get_the_author_meta('display_name', $post->post_author),
            'title'         => html_entity_decode(get_the_title($post->ID)),
            'date'          => get_the_date(null,$post->ID),
            'link'          => get_the_permalink($post->ID),
            'image'         => get_the_post_thumbnail_url($post->ID) ? get_the_post_thumbnail_url($post->ID,"original") : get_template_directory_uri()."/images/sangatta_def.webp",
            'excerpt'       => apply_filters("the_excerpt",get_the_excerpt($post->ID))
        ];
    }, $the_query->posts);
    wp_reset_query();

    return $postData;
}

function fetchRegulation($request) {
    $args = [
        'paged'     => $request['paged'],
        'post_type' => 'regulation',
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'regulation-type',
                'field' => 'slug',
                'terms' => $request['term'],
            )
        )
    ];

    $wp_query = new WP_Query($args);
    $posts = array_map(function ($post) {
        return [
            'id'     => $post->ID,
            'link'   => get_the_permalink($post->ID),
            'title'  => html_entity_decode(get_the_title($post->ID)),
            'date'   => get_the_date(null,$post->ID),
            'meta_field' => get_fields($post->ID)
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

    return [
        'posts' => $posts,
        'pagination' => $pagination
    ];
}

function fetchPosts($request) {
    $args = [
        'paged'     => $request['paged'],
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $request['term'],
            )
        )
    ];

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

    return [
        'posts' => $posts,
        'pagination' => $pagination
    ];
}

function fetchSearch($request){
    $args = [
        'paged'     => $request['paged'] ?? 1,
        'posts_per_page' => $request['per_page'] ?? 4,
        'post_type' => 'post', 
        'post_status' => 'publish',
        'orderby' => 'publish_date',
        'order' => $request['order'],
        's' => $request['s'] ?? '',
    ];

    if (!empty($request['term'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => [$request['term']],
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

    return [
        'posts' => $posts,
        'pagination' => $pagination
    ];
}

function latestGallery($request) {
    $args = [
        'paged'     => 1,
        'post_type' => 'gallery',
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'orderby' => 'publish_date',
        'order' => 'DESC',
    ];

    $wp_query = new WP_Query($args);
    $posts = array_map(function ($gallery) {
        return [
            'id'     => $gallery->ID,
            'title'  => html_entity_decode(get_the_title($gallery->ID)),
            'link'   => get_the_permalink($gallery->ID),
            'date'   => get_the_date(null,$gallery->ID),
            'post_thumbnail'    => get_the_post_thumbnail_url($gallery->ID),
        ];
    }, $wp_query->posts);
    
    // Build pagination array
    $current_page = isset($wp_query->query['paged']) ? (int) $wp_query->query['paged'] : 1;
    $hasNextPage   = $current_page < $wp_query->max_num_pages ? true : false;

    $pagination = [
        'has_next_page'    => $hasNextPage,
        'current_page' => $current_page,
        'total_pages'  => $wp_query->max_num_pages,
        'total_posts' => (int) $wp_query->found_posts,
    ];

    wp_reset_query(  );

    return [
        'posts' => $posts,
        'pagination' => $pagination
    ];
}

function fetchGallery($request) {
    $args = [
        'paged'     => $request['paged'] ?? 1,
        'post_type' => 'gallery',
        'posts_per_page' => 9
    ];

    if (!empty($request['term'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'gallery-category',
                'field' => 'slug',
                'terms' => $request['term'],
            )
            );
    }

    $wp_query = new WP_Query($args);
    $posts = array_map(function ($gallery) {
        return [
            'id'     => $gallery->ID,
            'title'  => html_entity_decode(get_the_title($gallery->ID)),
            'link'   => get_the_permalink($gallery->ID),
            'date'   => get_the_date(null,$gallery->ID),
            'post_thumbnail'    => get_the_post_thumbnail_url($gallery->ID),
        ];
    }, $wp_query->posts);
    
    // Build pagination array
    $current_page = isset($wp_query->query['paged']) ? (int) $wp_query->query['paged'] : 1;
    $hasNextPage   = $current_page < $wp_query->max_num_pages ? true : false;

    $pagination = [
        'has_next_page'    => $hasNextPage,
        'current_page' => $current_page,
        'total_pages'  => $wp_query->max_num_pages,
        'total_posts' => (int) $wp_query->found_posts,
    ];

    wp_reset_query(  );

    return [
        'posts' => $posts,
        'pagination' => $pagination
    ];
}

function registerUser($request){
    $email = $request['email'];
    $first_Name = $request['first_Name'];
    $last_Name = $request['last_Name'];
    $password = $request['password'];
    $phone_Number = $request['phone_Number'];
    $nik = $request['nik'];

    $user_id = wp_create_user($email, $password, $email);
    if (is_wp_error($user_id)) {
        return  [
            'success' => false,
            'message' => 'Error '. $user_id->get_error_code() .': '. $user_id->get_error_message()
        ];
    }

    $userData = array(
        'ID' => $user_id,
        'first_name' => $first_Name,
        'last_name' => $last_Name,
    );
    $user_data = wp_update_user( $userData);
    if (is_wp_error($user_data)) {
        return  [
            'success' => false,
            'message' => 'Error '. $user_data->get_error_code() .': '. $user_data->get_error_message()
        ];
    }
    update_field('user_phone_number', $phone_Number, 'user_'.$user_id);
    update_field('user_nik', $nik, 'user_'.$user_id);
    return [
        'success' => true,
        'message' => 'Registration Success.'
    ];
}

function loginUser($request){
    $data = array();
    $data['user_login'] =  $request->get_param('username');
    $data['user_password'] =   $request->get_param('password');
    $data['remember'] = true;
    $user = wp_signon( $data, false );

    if (is_wp_error($user)) {
        return  [
            'success' => false,
            'message' => 'Error '. $user->get_error_code() .': '. $user->get_error_message()
        ];
    }

    return [
        'success' => true,
        'message' => 'Login Success.'
    ];
}

function userLogout(){
    return wp_logout();
}

function findDataPassport($request){
    $permohonan = $request['permohonan']; //$request['permohonan']
    $fullName = $request['name']; //$request['name']
    $args = [
        'post_type' => 'imigrasi-passport', 
        'post_status' => 'publish',
        "name" => $permohonan,
        // 'meta_query'    => array(
        //     'relation'      => 'AND',
        //     array(
        //         'key'       => 'passport_nama_lengkap',
        //         'value'     => $fullName,
        //         'compare'   => '=',
        //     )
        // ),
    ];
    


    $wp_query = new WP_Query($args);
    $resultData = array_map(function ($post) {
        
        return [
            'id'            => $post->ID,
            'title'         => html_entity_decode(get_the_title($post->ID)),
            'metafield'     => get_fields($post->ID),
        ];
    }, $wp_query->posts);

    wp_reset_query(  );

    if (!empty($resultData)) {
        $passportStatus = $resultData[0]["metafield"]["passport_status"]->slug ?? 'siap-diambil';
        
        if ($passportStatus == 'siap-diambil' ) {
            $passportNomor = $resultData[0]["title"] ?? '';
            $passportName = $resultData[0]['metafield']['passport_nama_lengkap'] ?? '';

            $replaceNomor = str_replace('[nomor]', $passportNomor, get_field('passport_found_messages', 'option'));
            $messages = str_replace('[nama]', $passportName, $replaceNomor);
            $response = [
                "status"   => "true",
                'finishStatus' => false,
                "result"  => $resultData,
                "message" => $messages,
                "drive_true" => get_field('passport_drive_tru_messages', 'option')
            ];
        }else{
            $passportNomor = $resultData[0]["title"] ?? '';
            $passportName = $resultData[0]['metafield']['passport_nama_lengkap'] ?? '';
            $passportDate = $resultData[0]['metafield']['passport_pengambilan'] ?? '';
            $namaPengambil = $resultData[0]["passport_pengambilan_nama"] ?? '';
            $tlpPengambil = $resultData[0]['metafield']['passport_pengambilan_no_telepon'] ?? '';

            $replaceNomor = str_replace('[nomor]', $passportNomor, get_field('passport_finish_messages', 'option'));
            $replaceDate = str_replace('[tanggal_ambil]', $passportDate, $replaceNomor);
            $messages = str_replace('[nama]', $passportName, $replaceDate);
            $messages = str_replace('[nama_pengambil]', $namaPengambil, $messages);
            $messages = str_replace('[telepon_pengambil]', $tlpPengambil, $messages);

            $response = [
                "status"   => "true",
                'finishStatus' => true,
                "result"  => $resultData,
                "message" => $messages,
                "drive_true" => get_field('passport_drive_tru_messages', 'option')
            ];
        }
        

        return $response;
    }

    $response = [
        "status"   => "false",
        "result"  => false,
        "message" => get_field('passport_not_found_messages', 'option'),
        "drive_true" => false
    ];
    

    return $response;
}

function updateDriveThru($request){
    $postID = $request['postID']; 
    $date = $request['date'];


    $post_id = get_post( $postID );
    if (!$post_id) {
        $response = [
            "status"   => "false",
            "message"  => 'Submited error. Try Again.'
        ];
        echo json_encode($response);
        exit;
    }

    update_field('passport_drive_thru', $date, $post_id);
    $response = [
        "status"   => "true",
        "message"  => 'Request has been submited'
    ];
    echo json_encode($response);
    exit;
}


add_action('rest_api_init', function () {
    register_rest_route('posts', 'latest', array(
        'methods' => 'GET',
        'callback' => 'get_latest_posts',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('regulations', 'getdata', array(
        'methods' => 'POST',
        'callback' => 'fetchRegulation',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('gallery', 'latest', array(
        'methods' => 'GET',
        'callback' => 'latestGallery',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('gallery', 'getdata', array(
        'methods' => 'POST',
        'callback' => 'fetchGallery',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('posts', 'getdata', array(
        'methods' => 'POST',
        'callback' => 'fetchPosts',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('posts', 'search', array(
        'methods' => 'POST',
        'callback' => 'fetchSearch',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('user', 'register', array(
        'methods' => 'POST',
        'callback' => 'registerUser',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('user', 'login', array(
        'methods' => 'POST',
        'callback' => 'loginUser',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('user', 'logout', array(
        'methods' => 'get',
        'callback' => 'userLogout',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('user', 'find-passport', array(
        'methods' => 'POST',
        'callback' => 'findDataPassport',
        'permission_callback' => '__return_true'
    ));
    register_rest_route('user', 'update-passport', array(
        'methods' => 'POST',
        'callback' => 'updateDriveThru',
        'permission_callback' => '__return_true'
    ));
});