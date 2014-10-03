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

	  	$out = get_post_meta( $post_id, $key, false );

	  	return empty( $out ) ? null : $out;

	}
endif;