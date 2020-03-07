<?php
function employee_delete()
{
	/*
	echo "string"."<br>";
	echo get_admin_url()."<br>";
	echo get_site_url();
	*/

	 global $wpdb;
	 $id=$_POST['id'];
	  $table_name = $wpdb->prefix . 'my_user';
	  $wpdb->delete(
            $table_name,
            array('id'=>$id)
        );

    wp_redirect(admin_url('/admin.php?page=Employee_Listing'));
//    header('location:admin.php?page=Employee_Listing');
}
?>