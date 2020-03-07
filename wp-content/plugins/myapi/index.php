<?php
/**
 * Plugin Name: myAPI
 */

register_activation_hook( __FILE__, "myAPI_activate" );



register_deactivation_hook( __FILE__, "myAPI_deactivate" );



function myAPI_activate(){

}



function myAPI_deactivate(){

}

/*function create_table()
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
*/
function customPlugin_menu() {
    //adding plugin in menu
    add_menu_page('Emp_list', //page title
        'Emp ', //menu title
        'manage_options', //capabilities
        'Emp_List', //menu slug
        emp_list //function
    );

    add_submenu_page('Emp_List',//parent page slug
        'emp_insert',//page title
        'Emp Insert',//menu titel
        'manage_options',//manage optios
        'Emp_Insert',//slug
        'emp_insert'//function
    );
}

add_action('admin_menu', 'customPlugin_menu');



// returns the root directory path of particular plugin
 define('ROOTDIR', plugin_dir_path(__FILE__));

require_once (ROOTDIR.'emp_display.php');
require_once (ROOTDIR.'emp_insert.php');
