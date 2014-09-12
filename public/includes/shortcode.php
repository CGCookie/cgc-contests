<?php

/**
*
* Main class responsible for the contruction of the shortcode
* @since 1.0
*
*/

class cgcContestsShortcode {

	function __construct(){
		add_shortcode('cgc_contest', array($this,'shortcode'));
	}

	function shortcode( $atts, $content = null ) {

		$defaults = array(
			'id'	=> '',
			'position' => ''
		);

		$atts = shortcode_atts( $defaults, $atts );

		// form id
		$id 	= $atts['id'];
		$position 	= $atts['position'];

		ob_start();

			echo self::cgc_contest_get_entries( $id, $position );

		return ob_get_clean();
	}

	function cgc_contest_get_entries( $id = 0 , $position = 0 ){

		// bail if no id
		if ( empty ( $id ) || empty ( $position ) )
			return;

		$entries = GFAPI::get_entries( $id );

		// bail if no entries
		if ( empty( $entries ) )
			return;

		foreach ( $entries as $entry ){

			echo '<pre>';
			var_dump($entry[$position]);
		}

	}
}
new cgcContestsShortcode;