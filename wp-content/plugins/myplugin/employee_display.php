<?php
function employee_list()
{
   // echo  admin_url('/admin.php?page=Employee_Listing');
?>

<br><br><br>
<div class="container">
    <div><a class="btn btn-primary" style="float:right" href="<?php echo admin_url('/admin.php?page=Employee_Insert') ?>"> Add New </a> </div>
    <br><br>
<table class="table" id="myTable">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last  Name</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<?php
		 global $wpdb;
		 $table_name = $wpdb->prefix . 'my_user';
		 $result = $wpdb->get_results("SELECT * from $table_name");
		 foreach ($result as $res) {
                $edit_url=admin_url('/admin.php?page=Employee_Update&id='.$res->id);
		 	echo "<tr>
		 				<td>$res->fname</td>
		 				<td>$res->lname</td>
		 				<td><span style='font-size: 25px;' ><a href=$edit_url >&#9998;</a></span></td>
		 				<td><span id='$res->id'  onclick=del(this) >&#10006;</span></td>
		 		</tr>";
		 }

	?>
	<tfoot>
		<tr>		
			<th>First Name</th>
			<th>Last  Name</th>	
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</tfoot>


</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    $('#myTable').DataTable();
});

	function del(z)
	{

		//alert(z.id);
		var a=z.id;

		/*
		
		*/
		var l=bootbox.confirm({
			message: "Do you want to delete it?",
			buttons: {
	        	cancel: {
	            	label: '&#10005; Cancel'
	        	},
	        	confirm: {
	            	label: '&check; Confirm'
	        	}
	    	},
	    	callback: function (result) {
	    		if(result==true)
	    		{
	    			
	    				$.ajax({
                            type:'POST',
                            url:'http://localhost/mywordpress/wp-admin/admin.php?page=Employee_Delete',
                            data:{
                                'id':a
                            },
                            success:function()
                            {
                              
                               // alert(res);
                                window.location.reload();
                            }
                        });
	    			
	    		}	
	    	}
		});


	}


</script>
<?php
}
?>