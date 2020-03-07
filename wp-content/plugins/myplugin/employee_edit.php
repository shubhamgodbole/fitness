<?php

function employee_update()
{
     //echo  admin_url('/admin.php?page=Employee_Listing');
    global $wpdb;
    $id=$_GET['id'];
    $table_name = $wpdb->prefix . 'my_user';
    $result = $wpdb->get_results("SELECT * from $table_name WHERE id=".$id);
    foreach ($result as $res) {
        ?>

        <div class="container">
            <h2>Update form</h2>
            <form action="" method="post" id="emp_form" >
                <div class="form-group">
                    <label for="email">First Name:</label>
                    <input type="hidden" value="<?php echo $res->id ?>" name="hid">
                    <input type="text" class="form-control" id="fname" value="<?php echo $res->fname ?>" name="fname">
                </div>
                <div class="form-group">
                    <label for="pwd">Last Name:</label>
                    <input type="text" class="form-control" id="lname"  value="<?php echo $res->lname ?>" name="lname">
                </div>
                <button type="submit" name="update" id="update" class="btn btn-primary">Update</button>
            </form>
        </div>
        <?php
    }

    if(isset($_REQUEST['update']))
    {
        global $wpdb;
        echo    $hid=$_POST['hid'];
        echo 	$fname=$_POST['fname'];
        echo 	$lname=$_POST['lname'];
    echo    $table_name = $wpdb->prefix . 'my_user';

        $wpdb->update($table_name,
            array(
                'fname' => $fname,
                'lname' => $lname),
                array('id'=> $hid)

        );
        wp_redirect(admin_url('/admin.php?page=Employee_Listing'));
    }

}


