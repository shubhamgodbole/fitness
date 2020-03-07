<?php
function my_func($data ) {
	$excercise_name = $data['excercise_name'];
	$page_no = $data['page_no'];
	$items_per_page = 10;
	$offset = ($page_no - 1) * $items_per_page;
	global $wpdb;
	$table_name = $wpdb->prefix . 'excercise_master';
    if(empty($excercise_name)){
        $result = $wpdb->get_results("SELECT * from $table_name  limit $offset,$items_per_page ");
    }else{
        $result = $wpdb->get_results("SELECT * from $table_name where name LIKE '%$excercise_name%' limit $offset,$items_per_page ");
    }


    if(empty($excercise_name)){
        $result_count = $wpdb->get_results("SELECT count(*) as total_counnt from $table_name");
    }else{
        $result_count = $wpdb->get_results("SELECT count(*) as total_counnt from $table_name where name LIKE  '%$excercise_name%'");
    }

    $new_result=array();
    if(count($result)==0){
        $new_result['status']=false;
}
	$i = 0;
	foreach ($result as $res) {
		$excercise_table = $wpdb->prefix . 'excercise';
    	$excercise_result = $wpdb->get_results("SELECT * from $excercise_table where id=$res->excercise");	
    	$excercise = $excercise_result[0]->excercise;
 
        $target_region_table = $wpdb->prefix . 'target_region';
    	$target_region_result = $wpdb->get_results("SELECT * from $target_region_table WHERE id=$res->target_region"); 
    	$target_region = $target_region_result[0]->target_region;

    	$target_muscle_table = $wpdb->prefix . 'target_muscle';
    	$target_muscle_result = $wpdb->get_results("SELECT * from $target_muscle_table WHERE id=$res->target_muscle"); 
    	$target_muscle = $target_muscle_result[0]->target_muscle;

    	$dificulty_level_tbl = $wpdb->prefix . 'difficulty_level';
    	$dificulty_level_result = $wpdb->get_results("SELECT * from $dificulty_level_tbl where id =$res->dificulty_level");
    	$dificulty_level = $dificulty_level_result[0]->difficulty_level;

    	$equipment_table = $wpdb->prefix . 'target_equipment';
    	$equipment_result = $wpdb->get_results("SELECT * from $equipment_table where id = $res->equipment");
    	$equipment = $equipment_result[0]->equipment;

    	$log_entry_option_table = $wpdb->prefix . 'log_entry_option';
    	$log_entry_option_result1 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->duration");
		$duration = $log_entry_option_result1[0]->duration;
    	$log_entry_option_result2 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->distance");
    	$distance = $log_entry_option_result2[0]->duration;	
    	$log_entry_option_result3 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->speed");
    	$speed = $log_entry_option_result3[0]->duration;	
    	$log_entry_option_result4 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->calories");
    	$calories = $log_entry_option_result4[0]->duration;	

        $new_result[$i]['count']=$result_count[0]->total_counnt;
		$new_result[$i]['id'] = $res->id;
		$new_result[$i]['name'] = $res->name;
		$new_result[$i]['description'] = $res->description;
		$new_result[$i]['excercise_id'] = $res->excercise;
		$new_result[$i]['excercise'] = $excercise;
		$new_result[$i]['target_region_id'] = $res->target_region;
		$new_result[$i]['target_region'] = $target_region;
		$new_result[$i]['target_muscle_id'] = $res->target_muscle;
		$new_result[$i]['target_muscle'] = $target_muscle;
		$new_result[$i]['log_entry_option_1_id'] = $res->duration;
		$new_result[$i]['log_entry_option_1'] = $duration;
		$new_result[$i]['log_entry_option_2_id'] = $res->distance;
		$new_result[$i]['log_entry_option_2'] = $distance;
		$new_result[$i]['log_entry_option_3_id'] = $res->speed;
		$new_result[$i]['log_entry_option_3'] = $speed;
		$new_result[$i]['log_entry_option_4'] = $res->calories;
		$new_result[$i]['log_entry_option_4_id'] = $calories;
		$new_result[$i]['difficulty_level_id'] = $res->dificulty_level;
		$new_result[$i]['difficulty_level'] = $dificulty_level;
		$new_result[$i]['equipments_id'] = $res->equipment;
		$new_result[$i]['equipments'] = $equipment;
		$new_result[$i]['icon'] = $res->icon ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->icon : '';
		$new_result[$i]['image'] =$res->image ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->image : '';
		$new_result[$i]['vedio'] = $res->vedio ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->vedio :'';		
		$i++;
	}

  	return $response = new WP_REST_Response($new_result);
}


add_action( 'rest_api_init', function () {
    register_rest_route( 'api', '/excercise/', array(
      'methods' => 'GET',
      'callback' => 'my_func',
    ) );
  });

/* 
* API for find with excercise_id
*/

function my_func1($data ) {
	$excercise_type_id = $data['excercise_type_id'];
	$page_no = $data['page_no'];
	$length = $data['length'];
	$items_per_page = 10;
	$offset = ($page_no - 1) * $items_per_page;
	global $wpdb;

	$table_name = $wpdb->prefix . 'excercise_master';
	$result = $wpdb->get_results("SELECT * from $table_name where excercise= $excercise_type_id limit $offset,$items_per_page ");
    $result_count = $wpdb->get_results("SELECT count(*) as total_counnt from $table_name where excercise= '$excercise_type_id'");
    
	$i = 0;
	foreach ($result as $res) {
		$excercise_table = $wpdb->prefix . 'excercise';
    	$excercise_result = $wpdb->get_results("SELECT * from $excercise_table where id=$res->excercise");	
    	$excercise = $excercise_result[0]->excercise;
 
        $target_region_table = $wpdb->prefix . 'target_region';
    	$target_region_result = $wpdb->get_results("SELECT * from $target_region_table WHERE id=$res->target_region"); 
    	$target_region = $target_region_result[0]->target_region;

    	$target_muscle_table = $wpdb->prefix . 'target_muscle';
    	$target_muscle_result = $wpdb->get_results("SELECT * from $target_muscle_table WHERE id=$res->target_muscle"); 
    	$target_muscle = $target_muscle_result[0]->target_muscle;

    	$dificulty_level_tbl = $wpdb->prefix . 'difficulty_level';
    	$dificulty_level_result = $wpdb->get_results("SELECT * from $dificulty_level_tbl where id =$res->dificulty_level");
    	$dificulty_level = $dificulty_level_result[0]->difficulty_level;

    	$equipment_table = $wpdb->prefix . 'target_equipment';
    	$equipment_result = $wpdb->get_results("SELECT * from $equipment_table where id = $res->equipment");
    	$equipment = $equipment_result[0]->equipment;

    	$log_entry_option_table = $wpdb->prefix . 'log_entry_option';
    	$log_entry_option_result1 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->duration");
		$duration = $log_entry_option_result1[0]->duration;
    	$log_entry_option_result2 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->distance");
    	$distance = $log_entry_option_result2[0]->duration;	
    	$log_entry_option_result3 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->speed");
    	$speed = $log_entry_option_result3[0]->duration;	
    	$log_entry_option_result4 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->calories");
    	$calories = $log_entry_option_result4[0]->duration;	

        $new_result[$i]['count']=$result_count[0]->total_counnt;
		$new_result[$i]['id'] = $res->id;
		$new_result[$i]['name'] = $res->name;
		$new_result[$i]['description'] = $res->description;
		$new_result[$i]['excercise_id'] = $res->excercise;
		$new_result[$i]['excercise'] = $excercise;
		$new_result[$i]['target_region_id'] = $res->target_region;
		$new_result[$i]['target_region'] = $target_region;
		$new_result[$i]['target_muscle_id'] = $res->target_muscle;
		$new_result[$i]['target_muscle'] = $target_muscle;
		$new_result[$i]['log_entry_option_1_id'] = $res->duration;
		$new_result[$i]['log_entry_option_1'] = $duration;
		$new_result[$i]['log_entry_option_2_id'] = $res->distance;
		$new_result[$i]['log_entry_option_2'] = $distance;
		$new_result[$i]['log_entry_option_3_id'] = $res->speed;
		$new_result[$i]['log_entry_option_3'] = $speed;
		$new_result[$i]['log_entry_option_4'] = $res->calories;
		$new_result[$i]['log_entry_option_4_id'] = $calories;
		$new_result[$i]['difficulty_level_id'] = $res->dificulty_level;
		$new_result[$i]['difficulty_level'] = $dificulty_level;
		$new_result[$i]['equipments_id'] = $res->equipment;
		$new_result[$i]['equipments'] = $equipment;
		$new_result[$i]['icon'] = $res->icon ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->icon : '';
		$new_result[$i]['image'] =$res->image ? home_url().'/wp-content/plugins/custom_plugin/images/'.$res->image : '';
		$new_result[$i]['vedio'] = $res->vedio ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->vedio :'';	
		$i++;
	}

  	return $response = new WP_REST_Response($new_result);
}


add_action( 'rest_api_init', function () {
        register_rest_route( 'api', '/excercise_by_type/', array(
      'methods' => 'GET',
      'callback' => 'my_func1',
    ) );
  });

/* 
* API for find with TargetRegionId 
*/

function my_func2($data ) {
	$target_region_id = $data['target_region_id'];
	$equipment_id = $data['equipment_id'];
	$page_no = $data['page_no'];
	$length = $data['length'];
	$items_per_page = 10;
	$offset = ($page_no - 1) * $items_per_page;
	global $wpdb;
    if ($equipment_id == null){
		$equipment_id = 0;
	}
	if ($target_region_id == null){
		$target_region_id = 0;
	}
		
	$table_name2 = $wpdb->prefix . 'excercise_master';
	$query = "SELECT * from $table_name2 where 1=1 ";
	$countquery = "SELECT count(*) as total_counnt from $table_name2 where 1=1 ";
	 if ($equipment_id != 0){
		 $query  = $query. " AND equipment= $equipment_id";
		 $countquery  = $countquery. " AND equipment= $equipment_id";
	 }
	 if ($target_region_id != 0){
		 $query  = $query. " AND target_region= $target_region_id";
		 $countquery  = $countquery. " AND target_region= $target_region_id";
	 }
	 $query = $query." limit $offset,$items_per_page";
	 $result2 = $wpdb->get_results($query);
	 $result_count = $wpdb->get_results($countquery);
	//$result2 = $wpdb->get_results("SELECT * from $table_name2 where  ($equipment_id = 0 or target_region= $equipment_id) and ($equipment_id = 0 or equipment= $equipment_id) limit $offset,$items_per_page ");
	//$new_result['code'] = 200;
    //$result_count = $wpdb->get_results("SELECT count(*) as total_counnt from $table_name2 where target_region= $target_region_id and ($equipment_id = 0 or equipment= $equipment_id)");

    $new_result=array();

    $i = 0;
    if(count($result2) == 0){
        $new_result['status']=false;
    }
	foreach ($result2 as $res) {
		$excercise_table = $wpdb->prefix . 'excercise';
    	$excercise_result = $wpdb->get_results("SELECT * from $excercise_table where id=$res->excercise");	
    	$excercise = $excercise_result[0]->excercise;
 
        $target_region_table = $wpdb->prefix . 'target_region';
    	$target_region_result = $wpdb->get_results("SELECT * from $target_region_table WHERE id=$res->target_region"); 
    	$target_region = $target_region_result[0]->target_region;

    	$target_muscle_table = $wpdb->prefix . 'target_muscle';
    	$target_muscle_result = $wpdb->get_results("SELECT * from $target_muscle_table WHERE id=$res->target_muscle"); 
    	$target_muscle = $target_muscle_result[0]->target_muscle;

    	$dificulty_level_tbl = $wpdb->prefix . 'difficulty_level';
    	$dificulty_level_result = $wpdb->get_results("SELECT * from $dificulty_level_tbl where id =$res->dificulty_level");
    	$dificulty_level = $dificulty_level_result[0]->difficulty_level;

    	$equipment_table = $wpdb->prefix . 'target_equipment';
    	$equipment_result = $wpdb->get_results("SELECT * from $equipment_table where id = $res->equipment");
    	$equipment = $equipment_result[0]->equipment;

    	$log_entry_option_table = $wpdb->prefix . 'log_entry_option';
    	$log_entry_option_result1 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->duration");
		$duration = $log_entry_option_result1[0]->duration;
    	$log_entry_option_result2 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->distance");
    	$distance = $log_entry_option_result2[0]->duration;	
    	$log_entry_option_result3 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->speed");
    	$speed = $log_entry_option_result3[0]->duration;	
    	$log_entry_option_result4 = $wpdb->get_results("SELECT * from $log_entry_option_table where id = $res->calories");
    	$calories = $log_entry_option_result4[0]->duration;	

        $new_result[$i]['count']=$result_count[0]->total_counnt;
		$new_result[$i]['id'] = $res->id;
		$new_result[$i]['name'] = $res->name;
		$new_result[$i]['description'] = $res->description;
		$new_result[$i]['excercise_id'] = $res->excercise;
		$new_result[$i]['excercise'] = $excercise;
		$new_result[$i]['target_region_id'] = $res->target_region;
		$new_result[$i]['target_region'] = $target_region;
		$new_result[$i]['target_muscle_id'] = $res->target_muscle;
		$new_result[$i]['target_muscle'] = $target_muscle;
		$new_result[$i]['log_entry_option_1_id'] = $res->duration;
		$new_result[$i]['log_entry_option_1'] = $duration;
		$new_result[$i]['log_entry_option_2_id'] = $res->distance;
		$new_result[$i]['log_entry_option_2'] = $distance;
		$new_result[$i]['log_entry_option_3_id'] = $res->speed;
		$new_result[$i]['log_entry_option_3'] = $speed;
		$new_result[$i]['log_entry_option_4'] = $res->calories;
		$new_result[$i]['log_entry_option_4_id'] = $calories;
		$new_result[$i]['difficulty_level_id'] = $res->dificulty_level;
		$new_result[$i]['difficulty_level'] = $dificulty_level;
		$new_result[$i]['equipments_id'] = $res->equipment;
		$new_result[$i]['equipments'] = $equipment;
		$new_result[$i]['icon'] = $res->icon ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->icon : '';
		$new_result[$i]['image'] =$res->image ? home_url().'/wp-content/plugins/custom_plugin/images/'.$res->image : '';
		$new_result[$i]['vedio'] = $res->vedio ? home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$res->vedio :'';	
		$i++;
	}
  	return $response = new WP_REST_Response($new_result);
}


add_action( 'rest_api_init', function () {
    register_rest_route( 'api', '/target_region/', array(
      'methods' => 'GET',
      'callback' => 'my_func2',
    ) );
  });


function equipment_list()
{
?>

<br><br><br>
<div class="container">
    <div><a class="btn btn-primary" style="float:right" href="<?php echo admin_url('/admin.php?page=Equipment_Insert') ?>"> Add New </a> </div>
    <br><br>
<table class="table" id="myTable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Excercise</th>
			<th>Target Region</th>	
			<th>Difficulty Level</th>
			<th>Equipments</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<?php
		 global $wpdb;
		 $table_name = $wpdb->prefix . 'excercise_master';
		 $qry ="SELECT * from $table_name";
		 $result = $wpdb->get_results($qry);
		 foreach ($result as $res) {
                $edit_url=admin_url('/admin.php?page=Eqipment_Update&id='.$res->id);

                $excercise_table = $wpdb->prefix . 'excercise';
    			$excercise_result = $wpdb->get_results("SELECT * from $excercise_table where id=$res->excercise");	
    			$excercise = $excercise_result[0]->excercise;
 
                $target_region_table = $wpdb->prefix . 'target_region';
    			$target_region_result = $wpdb->get_results("SELECT * from $target_region_table WHERE id=$res->target_region"); 
    			$target_region = $target_region_result[0]->target_region;

    			$dificulty_level_tbl = $wpdb->prefix . 'difficulty_level';
    			$dificulty_level_result = $wpdb->get_results("SELECT * from $dificulty_level_tbl where id =$res->dificulty_level");
    			$dificulty_level = $dificulty_level_result[0]->difficulty_level;

    			$equipment_table = $wpdb->prefix . 'target_equipment';
    			$equipment_result = $wpdb->get_results("SELECT * from $equipment_table where id = $res->equipment");
    			$equipment = $equipment_result[0]->equipment;
		 	echo "<tr>
		 				<td>$res->name</td>
		 				<td>$excercise</td>
		 				<td>$target_region</td>
		 				<td>$dificulty_level</td>
		 				<td>$equipment</td>
		 				<td>
		 				<span ><a href=$edit_url >&#9998;</a></span>
		 				<span style='cursor: pointer;' id='$res->id'  onclick=del(this) >&#10006;</span>
		 				</td>
		 		</tr>";
		 }1
	?>
	<tfoot>
		<tr>		
			<th>Name</th>
			<th>Excercise</th>
			<th>Target Region</th>	
			<th>Difficulty Level</th>
			<th>Equipments</th>
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
                            url:'http://52.66.52.106/fitness/wp-admin/admin.php?page=Equipment_Delete',
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
return $response = new WP_REST_Response($result);

}

?>