<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.surakrai.com
 * @since      1.0.0
 *
 * @package    Thailand_Pdpa
 * @subpackage Thailand_Pdpa/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Thailand_Pdpa
 * @subpackage Thailand_Pdpa/admin
 * @author     https://www.surakrai.com <surakraisam@gmail.com>
 */
class Thailand_Pdpa_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Thailand_Pdpa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Thailand_Pdpa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, THAILAND_PDPA_PLUGIN_URL . 'build/' . manifest_thailand_pdpa()->admin->css, array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Thailand_Pdpa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Thailand_Pdpa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, THAILAND_PDPA_PLUGIN_URL . 'build/' . manifest_thailand_pdpa()->admin->js, array(), $this->version, false );

	}

  public function add_plugin_page() {

    // This page will be under "Settings"

    add_menu_page(
      __( 'Thailand PDPA Settings', 'thailand-pdpa' ),
      __( 'Thailand PDPA', 'thailand-pdpa' ),
      'manage_options',
      'tpdpa-setting-admin',
      array( $this, 'create_admin_page' ),
			'dashicons-privacy',
    );
  }

  /**
   * Options page callback
   */
  public function create_admin_page() { ?>
    <div class="wrap">
      <h1><?php _e( 'Thailand PDPA Settings', 'thailand-pdpa' ) ?></h1>
      <div id="thailand-pdpa"><app></app></div>
    </div>
    <?php
  }

}
