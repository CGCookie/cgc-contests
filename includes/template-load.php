<?php

class cgcContestsPageTemplater {

	function __construct(){

		add_filter( 'template_include', array($this,'template_loader'));
	}

	function template_loader($template) {


		$is_contest_page = cgc_contest_meta( get_the_ID(), '_cgc_contest_page' );

	    // override single
	    if ( $is_contest_page ):

	    	if ( $overridden_template = locate_template( 'contest-page-template.php', true ) ) {

			   $template = load_template( $overridden_template );

			} else {

			    $template = CGC_CONTESTS_DIR.'templates/contest-page-template.php';
			}

	    endif;

	    return $template;


	}
}
new cgcContestsPageTemplater();
