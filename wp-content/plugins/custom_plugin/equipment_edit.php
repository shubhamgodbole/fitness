<?php
function equipment_update()
{
    global $wpdb;
    $id=$_GET['id'];
    $table_name2 = $wpdb->prefix . 'excercise_master';
    $result2 = $wpdb->get_results("SELECT * from $table_name2 WHERE id=".$id); 
    
    $table_name = $wpdb->prefix . 'excercise';
    $result = $wpdb->get_results("SELECT * from $table_name");
    $excercise_id =$result2[0]->excercise;
    $target_region_id = $result2[0]->target_region;
    $target_muscle_id = $result2[0]->target_muscle;
    $equipment_id = $result2[0]->equipment;
    $dificulty_level_id = $result2[0]->dificulty_level;
    $duration_id = $result2[0]->duration;
    $distance_id = $result2[0]->distance;
    $speed_id = $result2[0]->speed;
    $calories_id = $result2[0]->calories;

    $edit_excercise_resule = $wpdb->get_results("SELECT * from $table_name where id=$excercise_id");

    $table_name1 = $wpdb->prefix . 'target_equipment';
    $result1 = $wpdb->get_results("SELECT * from $table_name1");
    $edit_equipment_result = $wpdb->get_results("SELECT * from $table_name1 where id=$equipment_id");

    $log_entry_tbl = $wpdb->prefix . 'log_entry_option';
    $log_entries = $wpdb->get_results("SELECT * from $log_entry_tbl");
    $duration_log_entries = $wpdb->get_results("SELECT * from $log_entry_tbl where id = $duration_id");
    $distance_log_entries = $wpdb->get_results("SELECT * from $log_entry_tbl where id = $distance_id");
    $speed_log_entries = $wpdb->get_results("SELECT * from $log_entry_tbl where id = $speed_id");
    $calories_log_entries = $wpdb->get_results("SELECT * from $log_entry_tbl where id = $calories_id");


    $target_region_table = $wpdb->prefix . 'target_region';
    $target_region_result = $wpdb->get_results("SELECT * from $target_region_table WHERE excercise_id=$excercise_id"); 
    $edit_target_region_result = $wpdb->get_results("SELECT * from $target_region_table WHERE id=$target_region_id"); 
     
    
    $target_muscle_table = $wpdb->prefix . 'target_muscle';
    $target_muscle_result = $wpdb->get_results("SELECT * from $target_muscle_table WHERE  target_region_id=$target_region_id"); 
    $edit_target_muscle_result = $wpdb->get_results("SELECT * from $target_muscle_table WHERE  id=$target_muscle_id"); 

  
    $dificulty_level_tbl = $wpdb->prefix . 'difficulty_level';
    $dificulty_level = $wpdb->get_results("SELECT * from $dificulty_level_tbl");  
    $edit_dificulty_level = $wpdb->get_results("SELECT * from $dificulty_level_tbl where id=$dificulty_level_id");  
    
    // $log_entry_option = $wpdb->prefix . 'log_entry_option';
    // $duration = $result2[0]->duration;
    // $duration_result = $wpdb->get_results("SELECT * from $log_entry_option WHERE  duration='$duration'"); 
    
?>
  <div class="container">
    <h2>Add Excercise</h2>
    <form action=""  method="post" id="emp_for,""m" enctype="multipart/form-data" onsubmit="return valid()">
      <!-- Excercise Name--> 
      <div class="form-group">
        <label >Excercise Name :</label>
        <input type="text" class="form-control" value="<?php echo $result2[0]->name; ?>" name="name" required placeholder="Excercise Name">
      </div>
      <!-- Excercise Description --> 
      <div class="form-group">
        <label >Excercise Description :</label>
        <textarea name="description" class="form-control"  required placeholder="Excercise Description"><?php echo $result2[0]->description; ?></textarea>
      </div>
      <!-- Excercise --> 
      <div class="form-group">
        <label >Excercise Type :</label>
        <select name="excercise" id="excercise" class="form-control" required>

        <option value="<?php echo $edit_excercise_resule[0]->id; ?>"><?php echo $edit_excercise_resule[0]->excercise; ?></option>
        	<?php
            foreach ($result as $res) {
                if($res->id != $edit_excercise_resule[0]->id) {
                echo "<option value=$res->id>$res->excercise</option>";
                }
             }
          ?>
        </select>
      </div>
      <!-- Target Region --> 
      <div class="form-group" id="target_region_group">
        <label >Target Region:</label>
        <select name="target_region" id="target_region" class="form-control">
        	<option value="<?php echo $edit_target_region_result[0]->id; ?>"><?php echo $edit_target_region_result[0]->target_region; ?></option>
          <?php
            foreach ($target_region_result as $res) {
                if($res->target_region !=  $edit_target_region_result[0]->target_region)
              echo "<option value=$res->id>$res->target_region</option>";
             }
          ?>
        </select>
      </div>
      <!-- Target Muscle --> 
      <div class="form-group" id="muscle_group"> 
        <label >Target Muscle:</label>
        <select name="target_muscle" id="muscle" class="form-control">
        	<option value="<?php echo $edit_target_muscle_result[0]->id; ?>"><?php echo $edit_target_muscle_result[0]->target_muscle; ?></option>
          <?php
            foreach ($target_muscle_result as $res) {
                if($res->target_muscle !=  $edit_target_muscle_result[0]->target_muscle)
              echo "<option value=$res->target_muscle>$res->target_muscle</option>";
             }
          ?>
        </select>
      </div>
      <!-- Equipments --> 
      <div class="form-group" id="equipments-group">
        <label >Equipments:</label>
        <select name="equipments" id="equipments" class="form-control">
          <option value="<?php echo $edit_equipment_result[0]->id; ?>"><?php echo $edit_equipment_result[0]->equipment; ?></option>
          <?php
            foreach ($result1 as $res) {
              if($res->equipment !=  $edit_equipment_result[0]->equipment) {
              echo "<option value=$res->equipment>$res->equipment</option>";
            }
             }
          ?>
        </select>
      </div>
      <!-- Difficulty Level --> 
      <div class="form-group" >
        <label >Difficulty Level:</label>
        <select name="level" id="level" required class="form-control">
          <option value="<?php echo $edit_dificulty_level[0]->id; ?>"><?php echo $edit_dificulty_level[0]->difficulty_level; ?></option>
           <?php
            foreach ($dificulty_level as $res) {
              if($res->id != $edit_dificulty_level[0]->id) {
              echo "<option value=$res->id>$res->difficulty_level</option>";
              }
             }
          ?>
        </select>
      </div>
      <!-- Duration --> 
      <div class="form-group" id="duration_group">
        <label >Duration:</label>
        <select name="duration" id="duration" class="form-control">
          <option value="<?php echo $duration_log_entries[0]->id; ?>"><?php echo $duration_log_entries[0]->duration; ?></option>
          <?php
            foreach ($log_entries as $res) {
              if($res->duration != $duration_log_entries[0]->duration) {
              echo "<option value=$res->id>$res->duration</option>";
              }
             }
          ?>
        </select>
      </div>
      
      <!-- Distance --> 
      <div class="form-group" id="discance_group">
        <label >Distance:</label>
        <select name="distance" id="distance" class="form-control">
          <option value="<?php echo $distance_log_entries[0]->id; ?>"><?php echo $distance_log_entries[0]->duration; ?></option>
          <?php
            foreach ($log_entries as $res) {
              if($res->duration != $distance_log_entries[0]->distance) {
              echo "<option value=$res->id>$res->duration</option>";
              }
             }
          ?>
        </select>
      </div>
      <!-- Speed --> 
      <div class="form-group" id="speed_group">
        <label >Speed:</label>
        <select name="speed" id="speed" class="form-control">
          <option value="<?php echo $speed_log_entries[0]->id; ?>"><?php echo $speed_log_entries[0]->duration; ?></option>
          <?php
            foreach ($log_entries as $res) {
              if($res->duration != $speed_log_entries[0]->duration) {
              echo "<option value=$res->id>$res->duration</option>";
              }
             }
          ?>
        </select>
      </div>
      <!-- Calories --> 
      <div class="form-group" id="calories_group">
        <label >Calories:</label>
        <select name="calories" id="calories" class="form-control">
          <option value="<?php echo $calories_log_entries[0]->id; ?>"><?php echo $calories_log_entries[0]->duration; ?></option>
          <?php
            foreach ($log_entries as $res) {
              if($res->duration != $calories_log_entries[0]->duration) {
              echo "<option value=$res->id>$res->duration</option>";
              }
             }
          ?>
        </select>
      </div>
      
      <!-- Upload Media --> 
      <div class="form-group" >
        <label >Upload Icon:</label>
        <input type="file" name="file"  accept="image/*" class="form-control">
      </div>
      <!-- Upload Media --> 
      <div class="form-group" >
        <label >Upload Image:</label>
        <input type="file" name="image"  accept="image/*" class="form-control">
      </div>
       
      <div class="form-group" >
        <label >Upload Video:</label>
        <input type="file" name="video"  accept="video/*" class="form-control">
      </div>
      <button type="submit" name="insert" id="insert" class="btn btn-primary">Update</button>
    </form>
  </div>
  <script type="text/javascript">
      jQuery("#target_region_group").css("display", "none");
      jQuery("#muscle_group").css("display", "none");
      jQuery("#equipments-group").css("display", "none");
      jQuery("#duration_group").css("display", "none");
      jQuery("#discance_group").css("display", "none");
      jQuery("#speed_group").css("display", "none");
      jQuery("#calories_group").css("display", "none");

      jQuery(document).ready(function(){
        
          jQuery("#excercise").ready(function(){
            var id = '<?php echo $edit_excercise_resule[0]->id; ?>';
            if(id != 1){
             jQuery("#target_region_group").css("display", "none");
             jQuery("#muscle_group").css("display", "none");
             jQuery("#equipments-group").css("display", "none");
           }
           else {
            jQuery("#target_region_group").css("display", "block");
            jQuery("#muscle_group").css("display", "block");
            jQuery("#equipments-group").css("display", "block");
           }
           if(id != 2){
             jQuery("#duration_group").css("display", "none");
             jQuery("#discance_group").css("display", "none");
             jQuery("#speed_group").css("display", "none");
             jQuery("#calories_group").css("display", "none");
           }
           else {
           jQuery("#duration_group").css("display", "block");
            jQuery("#discance_group").css("display", "block");
            jQuery("#speed_group").css("display", "block");
            jQuery("#calories_group").css("display", "block");
           }
           if(id ==3) {
           jQuery("#target_region_group").css("display", "block");
           }
          //   alert(id);
          // jQuery.ajax({
          //   url : '<?php echo admin_url('admin-ajax.php'); ?>',
          //   type : 'post',
          //   data : {
          //     action : 'my_target_region',
          //     excercise_id :id ,
          //   },
          //   success : function( html ) {
          //     $("#target_region").html(html);
          //   }
          // });
        });
        
        
      });
   // on excercise change
   jQuery('#excercise').on('change', function() {
           var id = jQuery(this).val();
           if(id != 1){
             jQuery("#target_region_group").css("display", "none");
             jQuery("#muscle_group").css("display", "none");
             jQuery("#equipments-group").css("display", "none");
           }
           else {
            jQuery("#target_region_group").css("display", "block");
            jQuery("#muscle_group").css("display", "block");
            jQuery("#equipments-group").css("display", "block");
           }
           if(id != 2){
             jQuery("#duration_group").css("display", "none");
             jQuery("#discance_group").css("display", "none");
             jQuery("#speed_group").css("display", "none");
             jQuery("#calories_group").css("display", "none");
           }
           else {
            jQuery("#duration_group").css("display", "block");
            jQuery("#discance_group").css("display", "block");
            jQuery("#speed_group").css("display", "block");
            jQuery("#calories_group").css("display", "block");
           }
           if(id ==3) {
            jQuery("#target_region_group").css("display", "block");
           }
          jQuery.ajax({
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            type : 'post',
            data : {
              action : 'my_target_region',
              excercise_id : id,
            },
            success : function( html ) {
              $("#target_region").html(html);
            }
          });
    });

   // on Category change
   jQuery('#target_region').on('change', function() {
           var id = jQuery(this).val();
          jQuery.ajax({
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            type : 'post',
            data : {
              action : 'my_target_muscle',
              muscle_id : id,
            },
            success : function( html ) {
              jQuery("#muscle").html(html);
            }
          });
    });

   jQuery('#hasEquipment').on('change', function() {
      if(this.checked != true){
         jQuery("#equipments-group").css("display", "none");
       }
       else {
        jQuery("#equipments-group").css("display", "block");
       }
    });
  
  </script>

  <?php
	if(isset($_POST['insert'])  )
	{
    global $wpdb;
    $name=$_POST['name'];
    $description=$_POST['description'];	
	 	$excercise=$_POST['excercise'];
	 	$target_region=$_POST['target_region'];
    $target_muscle=$_POST['target_muscle'];
    $duration=$_POST['duration'];
    $distance=$_POST['distance'];
    $speed=$_POST['speed'];
    $calories=$_POST['calories'];
    $level=$_POST['level'];
    $equipments=$_POST['equipments'] ? $_POST['equipments'] : '';
    $file_name=$_FILES['file'] ? $_FILES['file']['name'] : $result2[0]->icon;
    $image=$_FILES['image'] ? $_FILES['image']['name'] : $result2[0]->image;
    $video=$_FILES['video'] ? $_FILES['video']['name'] : $result2[0]->vedio;
    $hid = $result2[0]->id;

		$table_name = $wpdb->prefix . 'excercise_master';
		
		$wpdb->update($table_name,
		            array(
                    'name' => $name,
                    'description' => $description,                  
                    'excercise' => $excercise,
                    'target_region' => $target_region,
                    'target_muscle' => $target_muscle,
                    'duration' => $duration,
                    'distance' => $distance,
                    'speed' => $speed,
                    'calories' => $calories,
                    'dificulty_level' => $level,
                    'equipment' => $equipments,
                    'icon' => $file_name,
                    'image' => $image,
                    'vedio' => $video,
		            ),
                array('id'=> $hid)
            );

      // move file
      require_once(ABSPATH . "wp-admin" . '/includes/image.php');
      require_once(ABSPATH . "wp-admin" . '/includes/file.php');
      require_once(ABSPATH . "wp-admin" . '/includes/media.php');
      $file_id = media_handle_upload( 'file', $post->ID );
      $file_id1 = media_handle_upload( 'image', $post->ID );
      $file_id2 = media_handle_upload( 'vedio', $post->ID );
  		
      //header("location:".admin_url('/admin.php?page=Equipment_Listing'));
  		echo "<script>
        bootbox.alert({
  			    message:'Data Is Sucessfully Updated!',
  			    size: 'small'
  			});
  		 </script>";
      wp_redirect(admin_url('/admin.php?page=Equipment_Listing'));
	}
}

// target region
  function target_region() 
  {
    $id=$_POST['excercise_id'];
    global $wpdb;
    $table_name = $wpdb->prefix.'target_region';
    $result = $wpdb->get_results("SELECT * from $table_name  where  excercise_id='$id'");
    echo "SELECT * from $table_name  where  excercise='$id'";
    echo "<option value=''>--- Target Region ---</option>";
    foreach ($result as $res) {
              echo "<option value=$res->id>$res->target_region</option>";
    }
  }
  add_action( 'wp_ajax_my_target_region', 'target_region' );
  add_action( 'wp_ajaxn_nopriv_my_target_region', 'target_region' );

  // target muscle
  function target_muscle() 
  {
    $id=$_POST['muscle_id'];
    global $wpdb;
    $table_name = $wpdb->prefix.'target_muscle';
    $result = $wpdb->get_results("SELECT * from $table_name  where  target_region_id='$id'");
    echo "<option value=''>--- Target Muscle ---</option>";
    foreach ($result as $res) {
              echo "<option value=$res->target_muscle>$res->target_muscle</option>";
    }
  }
  add_action( 'wp_ajax_my_target_muscle', 'target_muscle' );
  add_action( 'wp_ajaxn_nopriv_my_target_muscle', 'target_muscle' );
