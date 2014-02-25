<?php
/**
 * Shortcode Options
 */
class SMPL_Shortcode_Options {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Go, go Settings API.
		add_action( 'admin_init', array( $this, 'register' ) );

	}

	/**
	 * Register setting.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Add the section to General settings
	 	add_settings_section( 'smpl_shortcodes', __('SMPL Shortcodes', 'smpl_shortcodes'), array( $this, 'display_section' ), 'writing' );

	 	// Add options to "SMPL Shortcodes" section.
	 	add_settings_field( 'smpl_raw', __('Raw Shortcode', 'smpl_shortcodes'), array( $this, 'display_option_raw' ), 'writing', 'smpl_shortcodes' );
	 	add_settings_field( 'smpl_shortcode_generator', __('Shortcode Generator', 'smpl_shortcodes'), array( $this, 'display_option_generator' ), 'writing', 'smpl_shortcodes' );
	 	add_settings_field( 'smpl_disable_scripts', __('Disable/Enable Scripts', 'smpl_shortcodes'), array( $this, 'disable_scripts' ), 'writing', 'smpl_shortcodes' );

	 	// Register options
	 	register_setting( 'writing', 'smpl_raw', array( $this, 'sanitize_yes_no' ) );
	 	register_setting( 'writing', 'smpl_shortcode_generator', array( $this, 'sanitize_yes_no' ) );
	 	register_setting( 'writing', 'smpl_disable_scripts', array( $this, 'sanitize_yes_no' ) );

	}

	/**
	 * Display shortcodes options section.
	 *
	 * @since 1.0.0
	 */
	public function display_section() {
		// do nothing
	}

	/**
	 * Display option to disable [raw] shortcode.
	 *
	 * @since 1.0.0
	 */
	public function display_option_raw() {
		$desc = __( 'Because the [raw] shortcode isn\'t a standard shortcode, having it enabled does effect the output of your content and may conflict with other plugins.', 'smpl_shortcodes' );
		$this->display_yes_no( 'smpl_raw', $desc );
	}

	/**
	 * Display option to disable shortcode generator.
	 *
	 * @since 1.0.4
	 */
	public function display_option_generator() {
		$desc = __( 'If the editor plugin\'s shortcode button causes any problems with WordPress\'s Visual Editor and your server setup, you can disable it here.', 'smpl_shortcodes' );
		$this->display_yes_no( 'smpl_shortcode_generator', $desc );
	}

	/**
	 * Display option to disable shortcode CSS.
	 *
	 * @since 1.0.4
	 */
	public function disable_scripts() {
		$desc = __( 'If you\'d like to add use your own Javascript &amp; CSS (or if your theme already supports it), you can disable it here' , 'smpl_shortcodes' );
		$this->display_yes_no( 'smpl_disable_scripts', $desc );
	}



	/**
	 * Display yes/no type options.
	 *
	 * @since 1.0.4
	 *
	 * @param string $id Registerd ID of option
	 * @param string $desc Description to user of what option does
	 */
	public function display_yes_no( $id, $desc ) {
		$value = get_option($id);
		echo '<select name="'.$id.'" id="'.$id.'">';
		echo '<option value="yes" '.selected( $value, 'yes', false ).'>'.__('Enabled', 'smpl_shortcodes').'</option>';
		echo '<option value="no" '.selected( $value, 'no', false ).'>'.__('Disabled', 'smpl_shortcodes').'</option>';
		echo '</select>';
		echo '<p class="description">'.$desc.'</p>';
	}

	/**
	 * Sanitization.
	 *
	 * @since 1.0.4
	 */
	public function sanitize_yes_no( $input ) {
		$output = '';
		$answers = array( 'yes', 'no' );
		if( in_array( $input, $answers ) )
			$output = $input;
		return $output;
	}

}