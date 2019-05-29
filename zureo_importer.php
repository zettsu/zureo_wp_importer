<?php

/**
 * Plugin Name: Zureo importer
 * Plugin URI: http://www.makeitrunit.com/
 * Description: Zureo products importer and updater
 * Version: 1.0
 * Author: Matias Olivera
 * Author URI: http://www.makeitrunit.com/
 *
 **/

require_once 'zureo-ajax.php';

add_action( 'admin_menu', 'zureo_wp_importer');


function zureo_wp_importer() {

    $page_title = 'Zureo woocomerce importer';
    $menu_title = 'Zureo imprter';
    $capability = 'manage_options';
    $menu_slug  = 'zureo-importer';
    $function   = 'zureo_importer_main';
    $icon_url   = 'dashicons-media-code';
    $position   = 4;

    add_menu_page( $page_title,
        $menu_title,
        $capability,
        $menu_slug,
        $function,
        $icon_url,
        $position
    );
}


function zureo_importer_main()
{
    include_once( 'views/main.php' );
}

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . 'zureo_updater';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime NULL DEFAULT CURRENT_TIMESTAMP,
		action tinytext NOT NULL,
		status tinyint(2) DEFAULT 1 NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'jal_db_version', $jal_db_version );
}

register_activation_hook( __FILE__, 'jal_install' );

function my_enqueue() {
    wp_enqueue_script('zureo', plugins_url('js/zureo.js', __FILE__), ['jquery'], "1.0", true);
    wp_localize_script('zureo', 'zureo_ajax', ['ajaxurl' => admin_url('admin-ajax.php')]);
}

add_action( 'admin_enqueue_scripts', 'my_enqueue' );

