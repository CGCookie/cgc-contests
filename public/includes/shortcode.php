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

		// form id and url from entry position
		$id 	= $atts['id'];
		$url 	= $atts['position'];

		ob_start();

			echo self::cgc_contest_get_entries( $id, $url );

		return ob_get_clean();
	}

	function cgc_contest_get_entries( $id = 0 , $url = '' ){

		// get entries via GF api with entry id
		$entries = GFAPI::get_entries( $id );

		// bail if no data
		if ( !$id || !$url || !$entries )
			return;

		// incase there are ever multiple on one page (likely never but we never know)
		static $instance = 0;
		$instance++;
		$unique = sprintf('cgc-contest-%s-%s',get_the_ID(), $instance);

		ob_start();

		?><div id="<?php echo $unique;?>" class="cgc-contests"><?php

			foreach ( $entries as $entry ){

				// bail if no url in entry
				if ( empty( $entry[$url] ) )
					return;

				// get the sketchfab url from the entry
				$source = $entry[$url] ? sprintf('%s/embed', $entry[$url] ) : null;;

				?>
					<div class="cgc-contest-entry">
						<iframe width="640" height="480" src="<?php echo $source;?>" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe>
					</div>
				<?php
			}

		?></div><?php

		return ob_get_clean();

	}
}
new cgcContestsShortcode;