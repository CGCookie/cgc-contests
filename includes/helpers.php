<?php

/**
	* Helper function to retrieve meta
 	*
 	* @param    string  $key       post meta key name
 	* @param    int    $post_id    The associated post ID
 	* @return                      The value; otherwise, null
*/
if ( !function_exists('cgc_contest_meta') ):
	function cgc_contest_meta( $post_id = 0 , $key = ' ') {

 		$post_date = get_the_date('mdy', $post_id);
   		$post_date = strtotime( $post_date );

		// old quiz new quiz migration
		if ( $post_date < strtotime(101714) ){
	  		$out = get_post_meta( $post_id, $key, false );
	  	} else {
	  		$out = get_post_meta( $post_id, $key, true );
	  	}

	  	return empty( $out ) ? null : $out;

	}
endif;