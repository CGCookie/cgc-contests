<?php

class cgcContestsShortcode {

	function __construct(){
		add_shortcode('cgc_contest', array($this,'shortcode'));
	}

	function shortcode( $atts, $content = null ) {

		$defaults = array(
		);

		$atts = shortcode_atts( $defaults, $atts );

		ob_start();

			echo 'showtime';

		return ob_get_clean();
	}
}
new cgcContestsShortcode;