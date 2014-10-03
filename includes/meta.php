<?php

class cgcContestsMeta {

	function __construct(){
		add_filter('cmb_meta_boxes', array($this,'meta' ));
	}

	/**
	 	* Adds custom meta
	 	*
	 	* @since    1.0.0
	*/
	function meta( array $meta_boxes ) {

		$meta_boxes[] = array(
			'title' 								=> __('Contest Page', 'cgc-contests'),
			'pages' 								=> array('page'),
			'context'    							=> 'side',
			'priority'								=> 'low',
			'fields' 								=> array(
				array(
					'id' 							=> '_cgc_contest_page',
					'name' 							=> __('Make this page a Contest Page', 'cgc-contests'),
					'type' 							=> 'checkbox',
				)
			)
		);

		return $meta_boxes;

	}

}
new cgcContestsMeta();