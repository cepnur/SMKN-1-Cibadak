<?php

function mapQuery($query,$imgSize = 'full'){
    return array_map(function ($item) use ($imgSize){
        return [
            'item' => $item,
            'author_id' => $item->post_author,
            'id' => $item->ID,
            'link'   => get_the_permalink($item->ID),
            'date' => get_the_date('F j, Y', $item->ID),
            'title'  => html_entity_decode(get_the_title($item->ID)) ?? '',
            'excerpt' => get_the_excerpt($item) ?? '',
            'image' => getPostThumbnail($item->ID, $imgSize),
            'acf' => get_fields($item->ID) ?? [],
        ];
    }, $query->posts);
}

function getQuery($param = array()){
    $paged = $param["paged"] ?? 1; 
    $types=  $param['types'] ?? 'post';
    $search = $param['s'] ?? '';
    $author = $param['author'] ?? -1;
    $perpage = $param['perpage'] ?? '3';
    $sortby = $param['sortby'] ?? 'latest';
    $taxquery = $param['tax_query'] ?? array();
    $metaquery = $param['meta_query'] ?? array();
    $args = [
        'paged' => $paged,
        'post_type' => $types,
        's' => $search,
        'posts_per_page' => $perpage,
        'sortby' => $sortby,
        'tax_query' => $taxquery,
        'meta_query' => $metaquery,
        'author' => $author,
    ];
    if (isset($param['post__not_in'])) {
        $args['post__not_in'] = $param['post__not_in'];
    }
   $query = new \WP_Query($args);
   return $query;
};

// news
function getDataPagination($args){
    //data
    $dataQuery = getQuery($args);
    $posts = mapQuery($dataQuery);
    
    // pagination
    $pagination = getPagination($dataQuery);

    return [
        'data' => $posts,
        'pagination' => $pagination
    ];
}

function getPagination($query){
    $current_page = isset($query->query['paged']) ? (int) $query->query['paged'] : 1;
    $prev_page    = $current_page > 1 ? $current_page - 1 : false;
    $next_page    = $current_page + 1;

    $pagination = [
        'prev_page'    => $prev_page,
        'next_page'    => $next_page,
        'current_page' => $current_page,
        'total_pages'  => $query->max_num_pages,
        'total_posts' => (int) $query->found_posts,
    ];

    return $pagination;
}

function getPostThumbnail($post_id,$img_size){
    return get_the_post_thumbnail_url($post_id) ? get_the_post_thumbnail_url($post_id,$img_size) : defautlImageResource($img_size);
}

function defautlImageResource($img_size){
    $def_thumbnail=get_template_directory_uri()."/dist/images/default/no-image-150.webp";;
    $def_medium=get_template_directory_uri()."/dist/images/default/no-image-medium.webp";
    $def_large=get_template_directory_uri()."/dist/images/default/no-image.webp";
    $def_full=get_template_directory_uri()."/dist/images/default/no-image.webp";
    $srcimg = $def_full;
    if ($img_size == 'thumbnail') {
       $srcimg = $def_thumbnail;
    }elseif ($img_size == 'medium') {
       $srcimg = $def_medium;
    }
    elseif ($img_size == 'large') {
       $srcimg = $def_large;
    }
    return $srcimg;
}