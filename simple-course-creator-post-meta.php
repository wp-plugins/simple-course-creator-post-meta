<?php
/**
 * Plugin Name: SCC - Post Meta
 * Plugin URI: http://buildwpyourself.com/downloads/scc-post-meta/
 * Description: Add post meta information to each post in the output listing
 * Version: 1.0.1
 * Author: Sean Davis
 * Author URI: http://seandavis.co
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 3.8
 * Text Domain: scc_post_meta
 * Domain Path: /languages/
 * 
 * This plugin is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see http://www.gnu.org/licenses/.
 *
 * @package Simple Course Creator
 * @category Output
 * @author Sean Davis
 * @license GNU GENERAL PUBLIC LICENSE Version 2 - /license.txt
 */
if ( ! defined( 'ABSPATH' ) ) exit; // No accessing this file directly


/**
 * primary class for Simple Course Creator Post Meta
 *
 * @since 1.0.0
 */
class Simple_Course_Creator_Post_Meta {

		
	/**
	 * constructor for Simple_Course_Creator_Post_Meta class
	 *
	 * Set up the basic plugin environment and with definitions,
	 * plugin information, and required plugin files.
	 */
	public function __construct() {
		
		// define plugin name
		define( 'SCCPM_NAME', 'Simple Course Creator Post Meta' );
		
		// define plugin version
		define( 'SCCPM_VERSION', '1.0.1' );
		
		// define plugin directory
		define( 'SCCPM_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		
		// define plugin root file
		define( 'SCCPM_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// load text domain
		add_action( 'init', array( $this, 'load_textdomain' ) );
		
		// require additional plugin files
		$this->includes();
	}
	

	/**
	 * load SCC Post Meta textdomain
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'scc_post_meta', false, SCCPM_DIR . "languages" );
	}
	
	
	/**
	 * require additional plugin files
	 */
	private function includes() {
		require_once( SCCPM_DIR . 'includes/display/class-scc-post-meta-hook.php' );		// hooks output class
		require_once( SCCPM_DIR . 'includes/admin/class-scc-post-meta-customizer.php' );	// customizer class
		require_once( SCCPM_DIR . 'includes/admin/class-scc-post-meta-settings.php' );		// settings class
	}
}
new Simple_Course_Creator_Post_Meta();