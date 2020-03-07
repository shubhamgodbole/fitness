<?php

add_action( 'rest_api_init', function () {
    register_rest_route( 'api', '/getprogram/', array(
        'methods' => 'GET',
        'callback' => 'getprogram',
    ) );
});

function getprogram($data)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'program';
    $program_type=0;
    $program_type = $data['program_type'];
    $limit = 10;
    if (isset($data["page"])) {  
      $pn  = $data["page"];  
    }  
    else {  
      $pn=1;  
    };   
  
    $start_from = ($pn-1) * $limit; 

    if($program_type==0){
    	$count = $wpdb->get_results("SELECT count(*) as total_counnt from $table_name ");
        $result = $wpdb->get_results("SELECT * from $table_name LIMIT $start_from, $limit");
    }else{
    	$count = $wpdb->get_results("SELECT count(*) as total_counnt from $table_name where program_type=$program_type ");
        $result = $wpdb->get_results("SELECT * from $table_name where program_type=$program_type LIMIT $start_from, $limit");
    }

    $i = 0;
    foreach ($result as $res) {
    	$final_result[$i]['count'] = $count[0]->total_counnt;
        $final_result[$i]['id'] = $res->id;
        $final_result[$i]['name'] = $res->name;
        $final_result[$i]['description'] = $res->description;
        $final_result[$i]['image'] = $res->image;
        $final_result[$i]['program_type'] = $res->program_type;
        $i++;


    }
    return $response = new WP_REST_Response($final_result);
}

function program_list()
{
	    global $wpdb;
    $table = $wpdb->prefix . 'program';
    $qry ="SELECT * FROM $table";
   $result = $wpdb->get_results($qry);
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
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
						<span style='font-size: 25px;' ><a href=$edit_url >&#9998;</a></span>
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