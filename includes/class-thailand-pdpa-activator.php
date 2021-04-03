<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.surakrai.com
 * @since      1.0.0
 *
 * @package    Thailand_Pdpa
 * @subpackage Thailand_Pdpa/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Thailand_Pdpa
 * @subpackage Thailand_Pdpa/includes
 * @author     https://www.surakrai.com <surakraisam@gmail.com>
 */

global $tpdpa_db_version;
$tpdpa_db_version = '1.0';

class Thailand_Pdpa_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		global $tpdpa_db_version;

		$charset_collate = $wpdb->get_charset_collate();
		$table_tpdpa_logs = $wpdb->prefix . 'tpdpa_logs';
		$table_tpdpa_logmeta = $wpdb->prefix . 'tpdpa_logmeta';

		$sql_tpdpa_logs = "CREATE TABLE $table_tpdpa_logs (
			log_id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			user_id mediumint(9),
			ip_address varchar(55) DEFAULT '' NOT NULL,
			PRIMARY KEY  (log_id)
		) $charset_collate;";

		
		$sql_tpdpa_logmeta = "CREATE TABLE $table_tpdpa_logmeta (
			meta_id mediumint(9) NOT NULL AUTO_INCREMENT,
			log_id mediumint(9),
			meta_key varchar(55) DEFAULT '' NOT NULL,
			meta_value varchar(55) DEFAULT '' NOT NULL,
			PRIMARY KEY  (meta_id)
		) $charset_collate;";
			
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql_tpdpa_logs );
		dbDelta( $sql_tpdpa_logmeta );

		add_option( 'tpdpa_db_version', $tpdpa_db_version );

	}

}
