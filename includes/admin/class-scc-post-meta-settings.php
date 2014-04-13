<?php
/**
 * SCC Post Meta settings class
 *
 * This class adds new settings to the Simple Course Creator
 * settings page.
 *
 * It does not use add_settings_section() from WordPress Settings API
 * because it uses the settings section already created by SCC. 
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // No accessing this file directly


class SCC_Post_Meta_Settings {

		
	/**
	 * constructor for SCC_Post_Meta_Settings class
	 */
	public function __construct() {
		
		// register settings
		add_action( 'admin_init', array( $this, 'register_settings' ), 20, 2 );
	}
	
	
	/**
	 * register SCC post meta settings
	 */
	public function register_settings() {
		
		// add option for hiding the author
		add_settings_field( 'display_author', __( 'Post Meta Author', 'scc_post_meta'), array( $this, 'post_meta_author' ), 'simple_course_creator', 'course_display_settings' );
		register_setting( 'course_display_settings', 'display_author', array( $this, 'save_settings' ) ); 
		
		// add option for hiding the date
		add_settings_field( 'display_date', __( 'Post Meta Date', 'scc_post_meta'), array( $this, 'post_meta_date' ), 'simple_course_creator', 'course_display_settings' );
		register_setting( 'course_display_settings', 'display_date', array( $this, 'save_settings' ) ); 
	}
	
	
	/**
	 * create post meta author option
	 *
	 * @callback_for 'display_author' field
	 */
	public function post_meta_author() {
		$pm_author = get_option( 'display_author' );
		echo '<input name="display_author" id="display_post_meta_author" type="checkbox" value="1" ' . checked( 1, $pm_author, false ) . ' />';
		echo '<label for="display_post_meta_author">' . __( 'Hide the list item post meta author', 'scc_post_meta' ) . '</label>';
	}
	
	
	/**
	 * create post meta date option
	 *
	 * @callback_for 'display_date' field
	 */
	public function post_meta_date() {
		$pm_date = get_option( 'display_date' );
		echo '<input name="display_date" id="display_post_meta_date" type="checkbox" value="1" ' . checked( 1, $pm_date, false ) . ' />';
		echo '<label for="display_post_meta_date">' . __( 'Hide the list item post meta date', 'scc_post_meta' ) . '</label>';
	}
	
	
	/**
	 * save options settings
	 *
	 * @used_by post_meta_author() & post_meta_date()
	 */
	public function save_settings( $input ) {
		
		// hide the post meta author
		$pm_author = get_option( 'display_author' );
		if ( ! isset( $input['display_author'] ) ) {
			$input['display_author'] == 0;
		} else {
			$input['display_author'] == $pm_author['display_author'];
		}
		
		// hide the post meta date
		$pm_date = get_option( 'display_date' );
		if ( ! isset( $input['display_date'] ) ) {
			$input['display_date'] == 0;
		} else {
			$input['display_date'] == $pm_date['display_date'];
		}
		return $input;
	}
}
new SCC_Post_Meta_Settings();