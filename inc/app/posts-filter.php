<?php

add_action( 'restrict_manage_posts', 'form_select' );
add_action( 'pre_get_posts', 'query_filter' );
add_action( 'admin_enqueue_scripts', 'jqueryui' );
 
function form_select() {
    $post_type = ( isset($_GET['post_type']) ) ? $_GET['post_type'] : 'pengaduan';

    if ($post_type == 'pengaduan') {
        // please use unique name
        $from = ( isset( $_GET['pe_date'] ) && $_GET['pe_date'] ) ? $_GET['pe_date'] : '';
        $to = ( isset( $_GET['pe_date_to'] ) && $_GET['pe_date_to'] ) ? $_GET['pe_date_to'] : '';
        $current_status = $_GET['pe_status'] ?? '';
        $statuses = get_post_statuses();

        echo '<input type="text" name="pe_date" placeholder="Date From" value="' . esc_attr( $from ) . '" />';
        echo '<input type="text" name="pe_date_to" placeholder="Date To" value="' . esc_attr( $to ) . '" />';
        ?>

        <!-- <select name="pe_status">
            <option value=""><?= __('All statuses', 'imigrasi'); ?></option>

            <?php

            foreach ($statuses as $key => $status) {
                printf(
                    '<option value="%s"%s>%s</option>',
                    $key,
                    $key == $current_status ? ' selected="selected"' : '',
                    $status
                );
            }
            ?>
        </select> -->

        <?php


        echo '<script>
        jQuery( function($) {
            let from = $(\'input[name="pe_date"]\');
            let to = $(\'input[name="pe_date_to"]\');
    
            // the dates look like this "April 3, 2017" by default
            // you can schoose something different, for example
            from.datepicker( {dateFormat : "yy/mm/dd"} );
            to.datepicker( {dateFormat : "yy/mm/dd"} );
            
        });
        </script>';
    }
}

function query_filter( $admin_query ) {
	global $pagenow;
    global $my_query;
	$post_type = (isset($_GET['post_type'])) ? $_GET['post_type'] : 'pengaduan';

	if ( $post_type == 'pengaduan' && $pagenow == 'edit.php' ) {

		if ( isset( $_GET['pe_date'] ) && ! empty( $_GET['pe_date'] ) ) {
			$admin_query->set(
				'date_query', // date_query appeared in WordPress 3.7!
				array(
					'after'     => sanitize_text_field( $_GET['pe_date'] ),
					'before'    => sanitize_text_field( $_GET['pe_date'] ),
					'inclusive' => true, // include the selected days as well
					'column'    => 'post_date' // 'post_modified', 'post_date_gmt', 'post_modified_gmt'
				)
			);
		}

        if ( isset( $_GET['pe_date'] ) && ! empty( $_GET['pe_date'] ) && isset( $_GET['pe_date_to'] ) && ! empty( $_GET['pe_date_to'] ) ) {
			$admin_query->set(
				'date_query', // date_query appeared in WordPress 3.7!
				array(
					'after'     => sanitize_text_field( $_GET['pe_date'] ),
					'before'    => sanitize_text_field( $_GET['pe_date_to'] ),
					'inclusive' => true, // include the selected days as well
					'column'    => 'post_date' // 'post_modified', 'post_date_gmt', 'post_modified_gmt'
				)
			);
		}
	}

    $my_query = $admin_query;
	return $admin_query;
}


function jqueryui () {
	wp_enqueue_style( 'pe-jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
}