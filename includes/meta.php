<?php

class cgcContestsMeta {

	function __construct(){
		add_filter('cmb_meta_boxes', array($this,'meta' ));
		add_action( 'admin_init', array($this,'remove_meta' ));
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

		$meta_boxes[] = array(
			'title' => __('Contest Setup', 'cgc-contests'),
			'pages' => array('page'),
			'fields' => array(
				array(
					'id' 			=> '_cgc_contest_banner',
					'name' 			=> __('Contest Banner Image', 'cgc-contests'),
					'type' 			=> 'image',
					'desc'			=> __('Upload a banner image for this contest. This can be different from the featured image that is picked up on social networks.', 'cgc-contests'),
				),
				array(
					'id' 			=> '_cgc_contest_rules',
					'name' 			=> __('Contest Rules', 'cgc-contests'),
					'type' 			=> 'textarea',
					'repeatable'     => true,
					'repeatable_max' => 20,
					'sortable'		=> true,
					'desc'			=> __('Add some rules for this contest', 'cgc-contests'),
				),
				array(
					'id' 			=> '_cgc_contest_sponsors',
					'name' 			=> __('Contest Sponsors', 'cgc-contests'),
					'type' 			=> 'group',
					'repeatable'     => true,
					'repeatable_max' => 20,
					'sortable'		=> true,
					'desc'			=> __('Add a logo and link for each sponsor of this contest.', 'cgc-contests'),
					'fields' 		=> array(
						array(
							'id' 	=> 'img',
							'name' 	=> __('Image', 'cgc-contests'),
							'type' 	=> 'image',
							'cols'	=> 4
						),
						array(
							'id' 	=> 'link',
							'name' 	=> __('Link', 'cgc-contests'),
							'type' 	=> 'url',
							'cols'	=> 8
						)
					)
				),
				array(
					'id' 			=> '_cgc_contest_awards',
					'name' 			=> __('Contest Rules', 'cgc-contests'),
					'type' 			=> 'wysiwyg',
					'options' => array(
					      'textarea_rows' => 5
					),
					'repeatable'     => true,
					'repeatable_max' => 3,
					'sortable'		=> true,
					'desc'			=> __('Add some awards for this contest.', 'cgc-contests'),
				)
			)
		);

		return $meta_boxes;

	}

	function remove_meta(){

		$post_id 		= isset( $_GET['post'] ) ? $_GET['post'] : null;
		$is_contest_page = get_post_meta( $post_id, '_cgc_contest_page', true );

		if ( $is_contest_page ):

 			remove_meta_box( 'commentstatusdiv' , 	'page' , 'normal' );
 			remove_meta_box( 'commentsdiv' , 		'page' , 'normal' );
 			remove_meta_box( 'authordiv' , 			'page' , 'normal' );
			remove_meta_box( 'pageparentdiv' , 		'page' , 'normal' );
			remove_meta_box( 'rcp_meta_box' , 		'page' , 'normal' );

		endif;
	}
}
new cgcContestsMeta();