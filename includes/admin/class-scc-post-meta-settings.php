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
		
		// add option for hiding the date
		add_settings_field( 'display_date', __( 'Post Meta Date', 'scc_post_meta'), array( $this, 'post_meta_date' ), 'simple_course_creator', 'course_display_settings' );
		
		if ( get_option( 'course_display_settings' ) == false ) {
			update_option( 'display_author', '0' );
			update_option( 'display_date', '0' );
		}
	}
	
	
	/**
	 * create post meta author option
	 *
	 * @callback_for 'display_author' field
	 */
	public function post_meta_author() {
		$pm_author = get_option( 'course_display_settings' );
		?>
		<input id="display_post_meta_author" type="checkbox" name="course_display_settings[display_author]" value="1" <?php echo checked( 1, isset( $pm_author['display_author'] ) ? $pm_author['display_author'] : 0, false ); ?>>
		<label for="display_post_meta_author"><?php _e( 'Check this box to hide the list item post meta author.', 'scc_post_meta' ); ?></label>
		<?php
	}
	
	
	/**
	 * create post meta date option
	 *
	 * @callback_for 'display_date' field
	 */
	public function post_meta_date() {
		$pm_date = get_option( 'course_display_settings' );
		?>
		<input id="display_post_meta_date" type="checkbox" name="course_display_settings[display_date]" value="1" <?php echo checked( 1, isset( $pm_date['display_date'] ) ? $pm_date['display_date'] : 0, false ); ?>>
		<label for="display_post_meta_date"><?php _e( 'Check this box to hide the list item post meta date.', 'scc_post_meta' ); ?></label>
		<?php
	}
	
	
	/**
	 * save options settings
	 *
	 * @used_by post_meta_author() & post_meta_date()
	 */
	public function save_settings( $input ) {
		$post_meta_options = get_option( 'course_display_settings' );
		
		// hide post author
		$post_meta_options['display_author'] = ( isset( $input['display_author'] ) && $input['display_author'] == true ? '1' : '0' );
		
		// hide post date
		$post_meta_options['display_date'] = ( isset( $input['display_date'] ) && $input['display_date'] == true ? '1' : '0' );
		
		return $input;
	}
}
new SCC_Post_Meta_Settings();