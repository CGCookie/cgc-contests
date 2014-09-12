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
			'field_name' => ''
		);

		$atts = shortcode_atts( $defaults, $atts );

		// form id
		$id 	= $atts['id'];
		$field 	= $atts['field_name'];

		ob_start();

			echo self::cgc_contest_get_entries( $id, $field );

		return ob_get_clean();
	}

	function cgc_contest_get_entries( $id = 0 , $field = ''){

		// bail if no id
		if ( empty ( $id ) || empty ( $field ) )
			return;

		$entries = GFAPI::get_entries( $id );

		// bail if no entries
		if ( empty( $entries ) )
			return;

		foreach ( $entries as $entry ){

			var_dump($entry);
		}

	}
}
new cgcContestsShortcode;