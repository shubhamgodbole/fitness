<?php
/**
 * Plugin Name: myplugin

 */

register_activation_hook( __FILE__, "myplugin_activate" );



register_deactivation_hook( __FILE__, "myplugin_deactivate" );



function myplugin_activate(){

}



function myplugin_deactivate(){

}

function create_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'my_user';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id int(9) NOT NULL AUTO_INCREMENT,
		fname varchar(30),
		lname varchar(30),
		PRIMARY KEY  (id)
	) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_table' );

function my_plugin_menu() {
    //adding plugin in menu
    add_menu_page('employee_list', //page title
        'Employee ', //menu title
        'manage_options', //capabilities
        'Employee_Listing', //menu slug
        employee_list //function
    );
    //adding submenu to a menu
    add_submenu_page('Employee_Listing',//parent page slug
        'employee_insert',//page title
        'Employee Insert',//menu titel
        'manage_options',//manage optios
        'Employee_Insert',//slug
        'employee_insert'//function
    );
    add_submenu_page( 'Employee_Listing',//parent page slug
        'employee_update',//$page_title
        'Employee Update',// $menu_title
        'manage_options',// $capability
        'Employee_Update',// $menu_slug,
        'employee_update'// $function
    );
    add_submenu_page( 'Employee_Listing',//parent page slug
        'employee_delete',//$page_title
        'Employee Delete',// $menu_title
        'manage_options',// $capability
        'Employee_Delete',// $menu_slug,
        'employee_delete'// $function
    );
}

add_action('admin_menu', 'my_plugin_menu');



// returns the root directory path of particular plugin
define('ROOTDIR', plugin_dir_path(__FILE__));


require_once (ROOTDIR.'employee_insert.php');
require_once (ROOTDIR.'employee_display.php');
require_once (ROOTDIR.'employee_delete.php');
require_once (ROOTDIR.'employee_edit.php');









