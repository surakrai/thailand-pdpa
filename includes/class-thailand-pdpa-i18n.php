<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.surakrai.com
 * @since      1.0.0
 *
 * @package    Thailand_Pdpa
 * @subpackage Thailand_Pdpa/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Thailand_Pdpa
 * @subpackage Thailand_Pdpa/includes
 * @author     https://www.surakrai.com <surakraisam@gmail.com>
 */
class Thailand_Pdpa_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'thailand-pdpa',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
