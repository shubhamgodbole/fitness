<?php

function add_my_stylesheet() 
{
    wp_enqueue_style( 'bootstrap.min', plugins_url( '/template/css/bootstrap.min.css', __FILE__ ) );
     wp_enqueue_style( 'dataTables.min', plugins_url( '/template/css/dataTables.min.css', __FILE__ ) );
    wp_enqueue_script( 'jquery.min', plugins_url( '/template/js/jquery.min.js', __FILE__ ) );
    wp_enqueue_script( 'popper.min', plugins_url( '/template/js/popper.min.js', __FILE__ ) );
    wp_enqueue_script( 'bootstrap.min', plugins_url( '/template/js/bootstrap.min.js', __FILE__ ) );
    wp_enqueue_script( 'bootbox.min', plugins_url( '/template/js/bootbox.min.js', __FILE__ ) );
    wp_enqueue_script( 'customJs', plugins_url( '/template/js/customJs.js', __FILE__ ) );
    wp_enqueue_script( 'dataTables.min', plugins_url( '/template/js/dataTables.min.js', __FILE__ ) );
}

add_action('admin_print_styles', 'add_my_stylesheet');

function employee_insert()
{


?>


<div class="container">
  <h2>Stacked form</h2>
  <form action="" method="post" id="emp_form" onsubmit="return valid()">
    <div class="form-group">
      <label for="email">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" >
    </div>
    <div class="form-group">
      <label for="pwd">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" >
    </div>

    <div class="form-group">
      <label for="pwd">Country:</label>
      <select name="country" id="country">
      <option value="">---</option>
      	<option value="india">India</option>
      	<option value="pakisthan">Pakisthan</option>
      	<option value="slanka">ShriLanka</option>
      </select>
    </div>
    <div class="form-group">
      <label for="pwd">State:</label>
      <select name="state" id="state">
      	<option value="">--</option>
      </select>
    </div>
    <div class="form-group">
      <label for="pwd">City:</label>
      <select name="city" id="city">
      	<option value="">--</option>
      </select>
    </div>

    <button type="submit" name="insert" id="insert" class="btn btn-primary">Add</button>
  </form>
</div>
<script type="text/javascript">
	function valid() 
	{
		var fname=$('#fname').val();
		var lname=$('#lname').val();
		if(fname == "" && lname != "")
		{
			bootbox.alert({
			    message: "Plz Insert First Name!",
			    size: 'small'
			});
 			return false;
		}
		else if(lname == "" && fname != "")
		{
			bootbox.alert({
			    message: "Plz Insert Last Name!",
			    size: 'small'
			});
			 return false;
		}
		else if(fname == "" && fname == "")
		{
			bootbox.alert({
			    message: "Plz Fill the Data!",
			    size: 'small'
			});
 			return false;
		}
		else
		{

		
		}
	//return true;
//		event.preventDefault();
		
	}
 // on country change
 $('#country').on('change', function() {
         var databseID = $(this).val();
       // alert( databseID );

        if(databseID == 'india')
        {
            $('#state').append(
            	"<option value=gujarat>Gujarat</option>"+
            	"<option value=panjab>Panjab</option>"+
            	"<option value=rajasthan>Rajasthan</option>"+
            	"");
        }
   });
 // on state change
 $('#state').on('change', function() {
         var state = $(this).val();
       // alert( databseID );

        if(state == 'gujarat')
        {
        	$('#city option').remove();
            $('#city').append(
            	"<option value=surat>Surat</option>"+
            	"<option value=navsari>Navsari</option>"+
            	"");
        }
        else if(state == 'panjab')
        {
            $('#city').append(
            	"<option value=jalandhar>Jalandhar</option>"+
            	"<option value=patiyala>Patiyala</option>"+
            	"");
        }
   })
</script>

<?php
	if(isset($_POST['insert'])  )
	{
	global $wpdb;	
	echo 	$fname=$_POST['fname'];
	echo 	$lname=$_POST['lname'];

		$table_name = $wpdb->prefix . 'my_user';
		
		$wpdb->insert($table_name,
		            array(
		                'fname' => $fname,
		                'lname' => $lname
		            )
            );
		
		echo "<script>
bootbox.alert({

			    message:'Data Is Sucessfully Inserted!',
			    size: 'small'
			});
		</script>";
		//echo $wpdb->last_query;
	}

}
?>

