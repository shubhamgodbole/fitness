<?php
/**
 * Plugin Name: customPlugin
 */

register_activation_hook( __FILE__, "customPlugin_activate" );



register_deactivation_hook( __FILE__, "customPlugin_deactivate" );



function customPlugin_activate(){

}



function customPlugin_deactivate(){

}

function create_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_equipment';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id int(9) NOT NULL AUTO_INCREMENT,
		excercise  varchar(30),
		category varchar(30),
        sub_category varchar(30),
        difficulty_level varchar(30),
        equipments varchar(30),
        streches varchar(30),
        media varchar(50),
 		PRIMARY KEY  (id)
	) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_table' );

function customPlugin_menu() {
    //adding plugin in menu
        add_menu_page('Equipment_list', //page title
        'Equipment ', //menu title
        'manage_options', //capabilities
        'Equipment_Listing', //menu slug
        equipment_list //function
    );
        add_submenu_page( 'Equipment_Listing',//parent page slug
        'equipment_update',//$page_title
        '',// $menu_title
        'manage_options',// $capability
        'Eqipment_Update',// $menu_slug,
        'equipment_update'// $function
    );

    add_submenu_page('Equipment_Listing',//parent page slug
        'equipment_insert',//page title
        'Equipment Insert',//menu titel
        'manage_options',//manage optios
        'Equipment_Insert',//slug
        'equipment_insert'//function
    );
    add_submenu_page( 'Equipment_Listing',//parent page slug
        'equipment_delete',//$page_title
        '',// $menu_title
        'manage_options',// $capability
        'Equipment_Delete',// $menu_slug,
        'equipment_delete'// $function
    );
    
}

add_action('admin_menu', 'customPlugin_menu');



// returns the root directory path of particular plugin
 define('ROOTDIR', plugin_dir_path(__FILE__));

require_once (ROOTDIR.'equipment_display.php');
require_once (ROOTDIR.'equipment_insert.php');
require_once (ROOTDIR.'delete.php');
require_once (ROOTDIR.'equipment_edit.php');