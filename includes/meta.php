<?php

class cgcContestsMeta {

	function __construct(){
		add_filter('cmb2_meta_boxes', array($this,'meta' ));
		add_action( 'admin_init', array($this,'remove_meta' ));
		add_action('admin_head', array($this, 'hide_meta'));
	}

	function hide_meta(){
		?>
		<!-- CGC Contest Meta -->
		<script>
			jQuery(document).ready(function($){

				var el 		= $('#_cgc_contest_page'),
					meta 	= $('#cgc_contest_page_setup');

				// hide the contest page setup metabox
				$(meta).hide();

				// if the box for contest page is checked show the meta on click
				$(el).click(function () {
				    $(meta).toggle(this.checked);
				});

				// if the page is reloaded and its checked show the meta
				if ( $(el).is(':checked') )
				    $(meta).show();
				else
					$(meta).hide();
			});
		</script>
		<?php
	}

	/**
	 	* Adds custom meta
	 	*
	 	* @since    1.0.0
	*/
	function meta( array $meta_boxes ) {

		$meta_boxes[] = array(
			'id'									=> 'cgc_contest_page',
			'title' 								=> __('Contest Page', 'cgc-contests'),
			'object_types' 								=> array('page'),
			'context'    							=> 'side',
			'priority'								=> 'low',
			'show_names'							=> false,
			'inline'								=> true,
			'fields' 								=> array(
				array(
					'id' 							=> '_cgc_contest_page',
					'name' 							=> __('Make this page a Contest Page', 'cgc-contests'),
					'type' 							=> 'checkbox'
				)
			)
		);

		$meta_boxes[] = array(
			'id'	=> 'cgc_contest_page_setup',
			'title' => __('Contest Setup', 'cgc-contests'),
			'object_types' => array('page'),
			'fields' => array(
				array(
					'id'			=> '_cgc_contest_gform_id',
					'name'			=> 'Gravity Form ID',
					'type'			=> 'text_small',
					'desc'			=> 'Enter the ID of the Gravity Form to be used to display the recent entries',
					'cols'			=> 4
				),
				array(
					'id'			=> '_cgc_contest_gform_field',
					'name'			=> 'Gravity Form Field ID',
					'type'			=> 'text_small',
					'desc'			=> 'Enter the ID of the Field ID in the Gravity Form chosen above with the Entry URL.',
					'cols'			=> 4
				),
				array(
					'id'			=> '_cgc_contest_expiration',
					'name'			=> 'Contest Expiration Date',
					'type'			=> 'text_date',
					'desc'			=> 'Choose an expiration date for this contest.',
					'cols'			=> 4
				),
				array(
					'id' 			=> '_cgc_contest_banner',
					'name' 			=> __('Contest Banner Image', 'cgc-contests'),
					'type' 			=> 'file',
					'desc'			=> __('Upload a banner image for this contest. This can be different from the featured image that is picked up on social networks.', 'cgc-contests'),
					'cols'			=> 6
				),
				array(
					'id' 			=> '_cgc_contest_banner_contain',
					'name' 			=> __('Contain Banner Image', 'cgc-contests'),
					'type' 			=> 'checkbox',
					'desc'			=> __('By default banner will be full-bleed. Checking this box will contain the image into the column.', 'cgc-contests'),
					'cols'			=> 6
				),
				array(
					'id' 			=> '_cgc_contest_banner_txt_color',
					'name' 			=> __('Contain Banner Text Color', 'cgc-contests'),
					'type' 			=> 'colorpicker',
					'desc'			=> __('Optionally change the color of the banner text.', 'cgc-contests'),
					'cols'			=> 6
				),
				array(
					'id'						=> '_cgc_contest_subtitle',
					'name'						=> 'Contest Subtitle',
					'type'						=> 'textarea_small',
					'desc'						=> 'Add some text to be displayed beneath the main page title.',
					'cols'						=> 6
				),
				array(
					'id' 			=> '_cgc_contest_disable_entries',
					'name' 			=> __('Disable the Entries portion', 'cgc-contests'),
					'type' 			=> 'checkbox',
					'desc'			=> __('By default the entries submission will show, checking this will hide the feature completely.', 'cgc-contests'),
					'cols'			=> 6
				),
				array(
					'id'						=> '_cgc_contest_entries_page',
					'name'						=> 'Contest Entries Page',
					'cols'						=> 6,
					'type'     					=> 'select',
					'options'					=> cgc_get_posts_for_cmb( array( 'post_type' => 'page' )),
					'desc'						=> 'Choose the page that has the contest entries.'
				),
				array(
					'id'						=> '_cgc_contest_color',
					'name'						=> 'Contest Accent Color',
					'type'						=> 'colorpicker',
					'cols'						=> 6,
					'desc'						=> 'Supply an accent color to be used throughout the contest page.'
				),
				array(
					'id' 			=> '_cgc_contest_rules',
					'name' 			=> __('Contest Rules', 'cgc-contests'),
					'type' 			=> 'textarea_small',
					'repeatable'     => true,
					'repeatable_max' => 20,
					'sortable'		=> true,
					'desc'			=> __('Add some rules for this contest', 'cgc-contests'),
				),
				array(
					'id' 			=> '_cgc_contest_sponsors',
					'name' 			=> __('Contest Sponsors', 'cgc-contests'),
					'type' 			=> 'group',
					'options'     => array(
						'group_title'   => __( 'Sponsor {#}', 'cgc-contests' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Another Sponsor', 'cgc-contests' ),
						'remove_button' => __( 'Remove Sponsor', 'cgc-contests' ),
						'sortable'      => true
					),
					'repeatable'     => true,
					'repeatable_max' => 20,
					'desc'			=> __('Add a logo and link for each sponsor of this contest.', 'cgc-contests'),
					'fields' 		=> array(
						array(
							'id' 	=> 'img',
							'name' 	=> __('Logo', 'cgc-contests'),
							'type' 	=> 'file',
							'cols'	=> 4
						),
						array(
							'id' 	=> 'link',
							'name' 	=> __('Website', 'cgc-contests'),
							'type' 	=> 'text_url',
							'cols'	=> 8
						)
					)
				),
				array(
					'id' 			=> '_cgc_contest_awards',
					'name' 			=> __('Contest Awards', 'cgc-contests'),
					'type' 			=> 'textarea',
					'options' => array(
						'textarea_rows' => 5,
						'media_buttons'	=> false
					),
					'repeatable'     => true,
					'repeatable_max' => 3,
					'sortable'		=> true,
					'desc'			=> __('Add some awards for this contest.', 'cgc-contests'),
				),
				array(
					'id' 			=> '_cgc_contest_extra_awards',
					'name' 			=> __('Extra Awards', 'cgc-contests'),
					'type' 			=> 'textarea',
					'options' => array(
						'textarea_rows' => 5,
						'media_buttons'	=> false
					),
					'repeatable'     => true,
					'repeatable_max' => 2,
					'sortable'		=> true,
					'desc'			=> __('These awards are additional and extra and can be used for things like "judges awards" or "community awards."', 'cgc-contests'),
				),
				array(
					'id' 			=> '_cgc_contest_faq',
					'name' 			=> __('Frequently Asked Questions', 'cgc-contests'),
					'type' 			=> 'group',
					'options'     => array(
						'group_title'   => __( 'FAQ {#}', 'cgc-contests' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Another FAQ', 'cgc-contests' ),
						'remove_button' => __( 'Remove FAQ', 'cgc-contests' ),
						'sortable'      => true
					),
					'repeatable'     => true,
					'repeatable_max' => 20,
					'sortable'		=> true,
					'desc'			=> __('Add a question and accompanying answer.', 'cgc-contests'),
					'fields' 		=> array(
						array(
							'id' 	=> 'question',
							'name' 	=> __('Question', 'cgc-contests'),
							'type' 	=> 'text'
						),
						array(
							'id' 	=> 'answer',
							'name' 	=> __('Answer', 'cgc-contests'),
							'type' 	=> 'wysiwyg',
							'options' => array(
								'textarea_rows' => 5,
								'media_buttons'	=> false
							)
						)
					)
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