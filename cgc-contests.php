<?php
/**
 *
 * @package   CGC_Contests
 * @author    Nick Haskins <nick@cgcookie.com>
 * @license   GPL-2.0+
 * @link      http://cgcookie.com
 * @copyright 2014 CG Cookie
 *
 * @wordpress-plugin
 * Plugin Name:       CGC Contests
 * Plugin URI:        http://cgcookie.com
 * Description:       Displays contests entries in a grid via shortcode
 * Version:           1.0.0
 * Author:            @TODO
 * Author URI:        @TODO
 * Text Domain:       cgc-contests-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 * WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-cgc-contests.php' );


register_activation_hook( __FILE__, array( 'CGC_Contests', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CGC_Contests', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'CGC_Contests', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/


if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-cgc-contests-admin.php' );
	add_action( 'plugins_loaded', array( 'CGC_Contests_Admin', 'get_instance' ) );

}
