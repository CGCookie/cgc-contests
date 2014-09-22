<?php

/**
*
* Main class responsible for the contruction of the shortcode
* @since 1.0
*
*/

class cgcContestsShortcode {

	function __construct(){
		add_shortcode('cgc_contest', 		array($this,'shortcode'));
		add_action('wp_enqueue_scripts', 	array($this,'scripts'));
	}

	// load style and script only if page has a the contest shortcode
	function scripts(){

		global $post;

		if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'cgc_contest' ) ) {

			wp_enqueue_script('cgc-contest-script', CGC_CONTESTS_URL.'/public/assets/js/lazyload.min.js', CGC_CONTESTS_VERSION, true );
			wp_enqueue_style('cgc-contest-style', CGC_CONTESTS_URL.'/public/assets/css/style.css', CGC_CONTESTS_VERSION, true );
		}
	}

	// build the shortcode
	function shortcode( $atts, $content = null ) {

		$defaults = array(
			'id'		=> '',
			'position' 	=> '',
			'limit'		=> ''
		);

		$atts = shortcode_atts( $defaults, $atts );

		// get options
		$id 	= $atts['id'];
		$url 	= $atts['position'];
		$limit  = $atts['limit'];

		// incase there are ever multiple on one page (likely never but we never know)
		static $instance = 0;
		$instance++;
		$unique = sprintf('cgc-contest-%s-%s',get_the_ID(), $instance);

		ob_start();

		?>
			<div id="<?php echo $unique;?>" class="cgc-contest-wrap">

				<script>
				  	var lazy = lazyload({
				    	container: document.getElementById('<?php echo $unique;?>')
				  	});
				</script>

				<?php echo self::cgc_contest_get_entries( $id, $url, $limit ); ?>

			</div>
		<?php

		return ob_get_clean();
	}

	// get entries from gravity forms api
	function cgc_contest_get_entries( $id = 0 , $url = '', $limit = '' ){

		// get entries via GF api with entry id
		$entries = GFAPI::get_entries( $id );

		// bail if no data
		if ( !$id || !$url || !$entries )
			return;

		$i = 0;
		foreach ( $entries as $entry ){

			$i++;

			// bail if no url in entry
			if ( empty( $entry[$url] ) )
				return;

			// get the sketchfab url from the entry and build the iframe url
			$source = $entry[$url] ? sprintf('%s/embed', $entry[$url] ) : null;

			// add a class to every 3rd
			if ( 0 == $i % 3 ) $last = 'last'; else $last = null;

			// draw the item
			printf('<div class="cgc-contest-entry %s"><div class="cgc-contest-entry-inner"><iframe width="310" height="230" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="%s" onload=lzld(this) frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe></div></div>', $last, $source );

			// if a limit is set then break at the set limit
			if ( $limit && 0 == $i % $limit ) {
				break;
			}
		}

	}

}
new cgcContestsShortcode;