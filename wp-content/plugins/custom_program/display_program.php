<?php

function program_list()
{
	    global $wpdb;
    $table = $wpdb->prefix . 'program';
    $qry ="SELECT * FROM $table";
   $result = $wpdb->get_results($qry);
?>

<br><br><br>
<div class="container">
    <div><a class="btn btn-primary" style="float:right" href="<?php echo admin_url('/admin.php?page=Program_Insert') ?>"> Add New </a> </div>
    <br><br>
<table class="table" id="myTable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Program Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<!-- 		  // delete from prodram escer...
	  $table_name2 = $wpdb->prefix . 'program_excercise';
 -->
		<?php 
			foreach ($result as $res) {
				$edit_url=admin_url('/admin.php?page=Program_Update&id='.$res->id);
				$id = $res->program_type;
				$table1 = $wpdb->prefix . 'program_type';
			    $qry1 ="SELECT * FROM $table1 where id = $id";
			    $result1 = $wpdb->get_results($qry1);
			    $type = $result1[0]->type;
				echo "<tr>
					<td>$res->name</td>
					<td>$res->description</td>
					<td>$type</td>
					<td>
						<a href=$edit_url><spa >edit</span></a>
		 				<span id='$res->id'  onclick=del(this) >&#10006;</span>
		 			</td>
				</tr>";
			}
		?>
		
		
	</tbody>
	<tfoot>
		<tr>		
			<th>Name</th>
			<th>Description</th>
			<th>Program Type</th>
			<th>Action</th>
		</tr>
	</tfoot>


</table>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery('#myTable').DataTable();
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
	    			
	    				jQuery.ajax({
                            type:'POST',
                            url:'http://localhost/wp_demoapi/wp-admin/admin.php?page=Program_Delete',
                            data:{
                                'id':a
                            },
                            success:function(res)
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