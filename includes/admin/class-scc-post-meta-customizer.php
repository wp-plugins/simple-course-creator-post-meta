<?php
/**
 * SCC_Post_Meta_Customizer class
 *
 * The plugin will first check to see if Simple Course Creator Customizer
 * is activated (http://buildwpyourself.com/downloads/scc-customizer/) and
 * if so, add settings to the "Simple Course Creator Design" section.
 *
 * If Simple Course Creator Customizer is not installed, a new section will
 * be created with style options.
 *
 * None of this is done if Simple Course Creator is not activated.
 * (http://buildwpyourself.com/downloads/simple-course-creator/)
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // No accessing this file directly


class SCC_Post_Meta_Customizer {

		
	/**
	 * check for Simple Course Creator Customizer plugin
	 */
	private $sccc_active;

		
	/**
	 * constructor for SCC_Post_Meta_Customizer class
	 */
	public function __construct() {
	
		// is Simple Course Creator Customizer active?
		$this->sccc_active = class_exists( 'Simple_Course_Creator_Customizer' );
	
		// load customizer functionality
		add_action( 'customize_register', array( $this, 'settings' ) );
		
		// If Simple Course Creator Customizer is installed, hook into
		// its <style> section of the head. If not, go for wp_head(). 
		$scc_styles_loc = $this->sccc_active ? 'scc_add_to_styles' : 'wp_head';
		add_action( $scc_styles_loc, array( $this, 'head_styles' ) );
	}


	/** 
	 * create customizer settings
	 *
	 * Only add the options to the customizer if SCC is activated.
	 */
	public function settings( $wp_customize ) {
		if ( class_exists( 'Simple_Course_Creator' ) ) {
		
			// color customization options
			$colors = array();
			
			// which section do we use? well... what plugins are installed?
			$sccpm_customizer = $this->sccc_active ? 'scc_customizer' : 'scc_post_meta_customizer';
			
			if ( ! $this->sccc_active ) {
			
				$wp_customize->add_section( 'scc_post_meta_customizer', array(
			    	'title'       	=> 'SCC Post Meta ' . __( 'Design', 'scc_post_meta' ),
					'description' 	=> __( 'Use this section to style the post meta output. For complete SCC output style options, you should install the ', 'scc_post_meta' ) . '<a href="http://buildwpyourself.com/downloads/scc-customizer/" target="_blank">' . 'SCC Customizer' . __( ' plugin', 'scc_post_meta' ) . '</a>.',
					'priority'   	=> 100,
				) );
				
			}
			
			// post meta text color
			$colors[] = array(
				'slug'		=>'scc_pm_text_color', 
				'label'		=> __( 'Post Meta Text Color', 'scc_post_meta' ),
				'priority'	=> 101
			);
			
			// build settings from $colors array
			foreach( $colors as $color ) {
		
				// customizer settings
				$wp_customize->add_setting( $color['slug'], array(
					'default'		=> $color['default'],
					'type'			=> 'option', 
					'capability'	=>  'edit_theme_options'
				) );
		
				// customizer controls
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
					'label'		=> $color['label'], 
					'section'	=> $sccpm_customizer,
					'settings'	=> $color['slug'],
					'priority'	=> $color['priority']
				) ) );
			}
		}
	}
	
	
	/**
	 * add customizer styles to <head>
	 *
	 * If Simple Course Creator Customizer is installed, hook into
	 * its <style> section of the head using the "scc_add_to_styles"
	 * hook. If not, create a new one <style> section through wp_head().
	 */
	public function head_styles() {
		if ( class_exists( 'Simple_Course_Creator' ) ) {
			$scc_pm_text_color = get_option( 'scc_pm_text_color' );
	
			echo ! $this->sccc_active ? '<style type="text/css">' : ''; // do we need a new <style> tag?
				echo '#scc-wrap .scc-post-meta{';
					
					// post meta text color
					if ( $scc_pm_text_color ) {
						echo "color:{$scc_pm_text_color};";		
					}
			
				echo '}';			
			echo ! $this->sccc_active ? '</style>' : '';
		}
	}
}
new SCC_Post_Meta_Customizer();