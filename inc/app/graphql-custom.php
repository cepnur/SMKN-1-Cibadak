<?php 
function customPostImage($post) {
    preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', get_the_content(null, $post->ID), $image);
    $content = get_the_content($post->ID);
    if (get_the_post_thumbnail_url($post->ID)) {
        $featured_image = get_the_post_thumbnail_url($post->ID);
    } elseif (is_array($image) && count($image) > 0 && isset($image[1][0])) {
        $featured_image = $image[1][0];
        $content = preg_replace('/<img.*?src=[\'"](.*?)[\'"].*?>/i', '', $content);
    } else {
        $featured_image = null;
    }
    return $featured_image;
}

function custom_post_init() {
    add_action( 'graphql_register_types', function() {
        register_graphql_field( 'Resource', 'postImage', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get other images from Resource', 'csh' ),
                ],
            ],
            'resolve' => 'customPostImage'
        ]);
        register_graphql_field( 'Resource', 'excerpt', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get resources from Post', 'csh' ),
                ],
            ],
            'resolve' => function( $post ) {
                $excerpt = get_the_excerpt($post->ID);
                if (get_field("excerpt", $post->ID) && get_field("excerpt", $post->ID) != "") {
                    $excerpt = get_field("excerpt", $post->ID);
                }
                return $excerpt;
            },
        ]);

        register_graphql_field( 'StoryOfWelcome', 'excerpt', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get Story from Post', 'csh' ),
                ],
            ],
            'resolve' => function( $post ) {
                $excerpt = get_the_excerpt($post->ID);
                if (get_field("excerpt", $post->ID) && get_field("excerpt", $post->ID) != "") {
                    $excerpt = get_field("excerpt", $post->ID);
                }
                return $excerpt;
            },
        ]);

        register_graphql_field( 'News', 'postImage', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get other images from News', 'csh' ),
                ],
            ],
            'resolve' => 'customPostImage'
        ]);

        register_graphql_field( 'Resource', 'postImage', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get other images from Resource', 'csh' ),
                ],
            ],
            'resolve' => 'customPostImage'
        ]);

        register_graphql_field( 'StoryOfWelcome', 'postImage', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get other images from Resource', 'csh' ),
                ],
            ],
            'resolve' => 'customPostImage'
        ]);


        register_graphql_field( 'News', 'dateOfPublication', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get Custom Publication date from News', 'csh' ),
                ],
            ],
            'resolve' => function( $post ) {
                $date = get_the_date('F j, Y', $post->ID);
                $publication_date = get_field("date_of_publication", $post->ID);
                if ($publication_date && $publication_date != "") {
                    $date = $publication_date;
                }
                return $date;
            },
        ]);

        register_graphql_field( 'News', 'customUrl', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get Source/External URL from News', 'csh' ),
                ],
            ],
            'resolve' => function( $post ) {
                $url = get_permalink($post->ID);
                $custom_url = get_field("custom_url", $post->ID);
                if ($custom_url && $custom_url != "") {
                    $url = $custom_url["url"];
                }
                return $url;
            },
        ]);

        register_graphql_field( 'Resource', 'customUrl', [
            'type' => 'String',
            'args' => [
                'myArg' => [
                    'type' => 'String',
                    'description' => __( 'Get Source/External URL from News', 'csh' ),
                ],
            ],
            'resolve' => function( $post ) {
                $url = get_permalink($post->ID);
                $custom_url = get_field("custom_url", $post->ID);
                if ($custom_url && $custom_url != "") {
                    $url = $custom_url["url"];
                }
                return $url;
            },
        ]);
        

        register_graphql_field('RootQueryToPostConnectionWhereArgs', 'staffId', [
            'type' => 'Integer',
            'description' => __('Filter Post by Staff ID', 'sage'),
        ]);

        register_graphql_field( 'RootQueryToResourceConnectionWhereArgs', 'filters', [
            'type' => 'String',
            'description' => __( 'Custom Post Type Filters', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToNewsConnectionWhereArgs', 'filters', [
            'type' => 'String',
            'description' => __( 'Custom Post Type Filters', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToContentNodeConnectionWhereArgs', 'filters', [
            'type' => 'String',
            'description' => __( 'Custom Post Type Filters', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToWelcomerConnectionWhereArgs', 'filters', [
            'type' => 'String',
            'description' => __( 'Custom Post Type Filters', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToStoryOfWelcomeConnectionWhereArgs', 'filters', [
            'type' => 'String',
            'description' => __( 'Custom Post Type Filters', 'sage' ),
        ] );

        register_graphql_field('RootQueryToResourceConnectionWhereArgs', 'onlyFeatured', [
            'type' => 'Boolean',
            'description' => __('Custom Resource Type Term ID', 'sage'),
        ] );

        register_graphql_field('RootQueryToWelcomerConnectionWhereArgs', 'onlyFeatured', [
            'type' => 'Boolean',
            'description' => __('Custom Welcomer Type Term ID', 'sage'),
        ] );

        register_graphql_field('RootQueryToStoryOfWelcomeConnectionWhereArgs', 'onlyFeatured', [
            'type' => 'Boolean',
            'description' => __('Custom Story Type Term ID', 'sage'),
        ] );

        register_graphql_field('RootQueryToNewsConnectionWhereArgs', 'onlyFeatured', [
            'type' => 'Boolean',
            'description' => __('Custom News Type Term ID', 'sage'),
        ] );

        register_graphql_field('RootQueryToContentNodeConnectionWhereArgs', 'onlyFeatured', [
            'type' => 'Boolean',
            'description' => __('Custom Content Nodes Type Term ID', 'sage'),
        ] );

        register_graphql_field( 'RootQueryToResourceConnectionWhereArgs', 'keywords', [
            'type' => 'String',
            'description' => __( 'Custom Resource Type Keyword search', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToWelcomerConnectionWhereArgs', 'keywords', [
            'type' => 'String',
            'description' => __( 'Custom Welcomers Type Keyword search', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToNewsConnectionWhereArgs', 'keywords', [
            'type' => 'String',
            'description' => __( 'Custom News Type Keyword search', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToContentNodeConnectionWhereArgs', 'keywords', [
            'type' => 'String',
            'description' => __( 'Custom Content Nodes Type Keyword search', 'sage' ),
        ] );

        register_graphql_field( 'RootQueryToStoryOfWelcomeConnectionWhereArgs', 'keywords', [
            'type' => 'String',
            'description' => __( 'Custom Content Nodes Type Keyword search', 'sage' ),
        ] );

        add_filter( 'graphql_post_object_connection_query_args', function( $query_args, $source, $args, $context, $info ) {
            if (
                isset($args['where']['staffId'])
            ) {
                $query_args["meta_query"] = [
                    ['key' => 'staff', 'value' => '"'. $args['where']['staffId'].'"', "compare" => "LIKE"],
                ];
            }
            
            if ( isset( $args['where']['filters'] ) && "" !== $args['where']['filters'] ) {
                $filters = json_decode($args['where']['filters'], true);
                if(array_key_exists("keywords",$filters) && $filters["keywords"] !="") {
                    $query_args['s'] = $filters["keywords"];
                }
                if(array_key_exists("sortby",$filters) && $filters["sortby"] !="") {
                    $query_args['orderby'] = $filters["sortby"];
                    if ($filters["sortby"] == "date") {
                        $query_args['order'] = "DESC";
                    }else{
                        $query_args['order'] = "ASC";
                    }
                }
                if(array_key_exists("category",$filters) && $filters["category"] !="") {
                    $tax_query["relation"] = "OR";
                    $tax_query = [
                        'taxonomy' => 'resource-category', 
                        'terms' => explode("," , $filters["category"]),
                        'field' => 'slug',
                    ];
                    $query_args['tax_query'][] = $tax_query;
                }
                if(array_key_exists("resource_category",$filters) && $filters["resource_category"] !="") {
                    $tax_query["relation"] = "OR";
                    $tax_query = [
                        'taxonomy' => 'resource-category', 
                        'terms' => explode("," , $filters["resource_category"]),
                        'field' => 'slug',
                    ];
                    $query_args['tax_query'][] = $tax_query;
                }
                if(array_key_exists("news_category",$filters) && $filters["news_category"] !="") {
                    $tax_query["relation"] = "OR";
                    $tax_query = [
                        'taxonomy' => 'news_category', 
                        'terms' => explode("," , $filters["news_category"]),
                        'field' => 'slug',
                    ];
                    $query_args['tax_query'][] = $tax_query;
                }
            }

            if (
                isset($args['where']['keywords']) &&
                $args['where']['keywords'] != ""
            ) {
                $query_args['s'] = $args['where']['keywords'];
            }

            return $query_args;
        }, 10, 5 );
    });
}

if (function_exists('register_graphql_field')) {
    add_action('init', 'custom_post_init');
}

add_filter( 'graphql_connection_page_info', 'resolve_total_field', 10, 2 );
add_filter( 'graphql_connection_query_args', 'count_total_rows' );
add_filter( 'graphql_register_types', 'register_total_field' );

function resolve_total_field( $page_info, $connection ) {
	$page_info['total'] = null;
	if ( $connection->get_query() instanceof \WP_Query ) {
		if ( isset( $connection->get_query()->found_posts ) ) {
			$page_info['total'] = (int) $connection->get_query()->found_posts;
		}
	}
	return $page_info;
}

/**
 * Tell the underlying WP_Query to count the total number of rows.
 *
 * @param $args
 *
 * @return mixed
 */
function count_total_rows( $args ) {
	$args['no_found_rows'] = false;
	$args['count_total']   = true;
	return $args;
}

/**
 * Register a total field for queries.
 */
function register_total_field() {
	register_graphql_field( 'WPPageInfo', 'total', [
		'type' => 'String',
	] );
}