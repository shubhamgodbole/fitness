<?php
function program_delete()
{
	/*
	echo "string"."<br>";
	echo get_admin_url()."<br>";
	echo get_site_url();
	*/

	 global $wpdb;
	 $id=$_POST['id'];
	  // delete from prgram
	  $table_name = $wpdb->prefix . 'program';
	  $wpdb->delete(
            $table_name,
            array('id'=>$id)
        );
	  
	  // delete from program section
	  $table_name1 = $wpdb->prefix . 'program_section';
	  $wpdb->delete(
            $table_name1,
            array('program_id'=>$id)
        );

	  // delete from prodram escer...
	  $table_name2 = $wpdb->prefix . 'program_excercise'; 	  
	  $wpdb->delete(
            $table_name2,
            array('program_id'=>$id)
        );
	  


    wp_redirect(admin_url('/admin.php?page=Program_Listing'));
//    header('location:admin.php?page=Employee_Listing');
}
?>