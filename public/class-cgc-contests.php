<?php
/**
 * CGC Contests.
 *
 * @package   CGC_Contests
 * @author    Nick Haskins <nick@cgcookie.com>
 * @license   GPL-2.0+
 * @link      http://cgcookie.com
 * @copyright 2014 CG Cookie
 */

/**
 *
 * @package CGC_Contests
 * @author  Nick Haskins <nick@cgcookie.com>
 */
class CGC_Contests {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'cgc-contests';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {


		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		require_once(CGC_CONTESTS_DIR.'/includes/meta.php');
		require_once(CGC_CONTESTS_DIR.'/includes/helpers.php');
		require_once(CGC_CONTESTS_DIR.'/public/includes/shortcode.php');
		require_once(CGC_CONTESTS_DIR.'/includes/template-load.php');

		add_filter('body_class', array($this,'body_class'));
		add_action('wp_enqueue_scripts', 	array($this,'scripts'));

	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	function body_class($classes){


	    if ( cgc_contest_meta( get_the_ID(), '_cgc_contest_page' ) )
		//$theme 		= wp_get_theme();
		//$get_name  	=  strtolower( $theme->get( 'Name' ) );
		//$name 		= str_replace(' ', '-', $get_name );

		$classes[] = 'cgc-contest-page';
		//$classes[] = 'contest-page-on-'.$name;

		return $classes;
	}

	function scripts(){

		global $post;

		$classes = get_body_class();

		if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'cgc_contest' ) || in_array('cgc-contest-page',$classes) ) {

			wp_enqueue_script('cgc-contest-script', CGC_CONTESTS_URL.'/public/assets/js/lazyload.min.js', CGC_CONTESTS_VERSION, array('jquery') );
			wp_enqueue_script('cgc-contest-display', CGC_CONTESTS_URL.'/public/assets/js/general.js', array('cgc-contest-script', 'jquery'), true);
			wp_enqueue_style('cgc-contest-style', CGC_CONTESTS_URL.'/public/assets/css/style.css', CGC_CONTESTS_VERSION, true );
		}
	}


}
