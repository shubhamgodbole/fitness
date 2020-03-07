<?php
/**
 * Plugin Name: customProgram
 */

register_activation_hook( __FILE__, "customProgram_activate" );



register_deactivation_hook( __FILE__, "customProgram_deactivate" );



function customProgram_activate(){

}



function customProgram_deactivate(){

}


function customProgram_menu() {
    //adding plugin in menu
        add_menu_page('Program_list', //page title
        'Program ', //menu title
        'manage_options', //capabilities
        'Program_Listing', //menu slug
        program_list //function
    );
        add_submenu_page( 'Equipment_Listing',//parent page slug
        'program_update',//$page_title
        '',// $menu_title
        'manage_options',// $capability
        'Program_Update',// $menu_slug,
        'program_update'// $function
    );

    add_submenu_page('Program_Listing',//parent page slug
        'program_insert',//page title
        'Program Insert',//menu titel
        'manage_options',//manage optios
        'Program_Insert',//slug
        'program_insert'//function
    );
    add_submenu_page( 'Program_Listing',//parent page slug
        'program_delete',//$page_title
        '',// $menu_title
        'manage_options',// $capability
        'Program_Delete',// $menu_slug,
        'program_delete'// $function
    );
    
}

add_action('admin_menu', 'customProgram_menu');



// returns the root directory path of particular plugin
  define('ROOTDIR1', plugin_dir_path(__FILE__));
 require_once (ROOTDIR1.'display_program.php');
 require_once (ROOTDIR1.'insert.php');
 require_once (ROOTDIR1.'delete.php');
 require_once (ROOTDIR1.'edit.php');

