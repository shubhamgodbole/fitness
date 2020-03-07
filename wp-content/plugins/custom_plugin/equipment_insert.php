<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'myapi/v1', '/author/', array(
      'methods' => 'POST',
      'callback' => 'equipment_insert',
    ) );
  });
function add_my_stylesheet() 
{
    wp_enqueue_style( 'bootstrap.min', plugins_url( '/template/css/bootstrap.min.css', __FILE__ ) );
     wp_enqueue_style( 'dataTables.min', plugins_url( '/template/css/dataTables.min.css', __FILE__ ) );
    //wp_enqueue_script( 'jquery.min', plugins_url( '/template/js/jquery.min.js', __FILE__ ) );
    wp_enqueue_script( 'popper.min', plugins_url( '/template/js/popper.min.js', __FILE__ ) );
    wp_enqueue_script( 'bootstrap.min', plugins_url( '/template/js/bootstrap.min.js', __FILE__ ) );
    wp_enqueue_script( 'bootbox.min', plugins_url( '/template/js/bootbox.min.js', __FILE__ ) );
    wp_enqueue_script( 'customJs', plugins_url( '/template/js/customJs.js', __FILE__ ) );
    wp_enqueue_script( 'dataTables.min', plugins_url( '/template/js/dataTables.min.js', __FILE__ ) );
    wp_enqueue_script( 'CKEDITOR', plugins_url( '/template/js/ckeditor.js', __FILE__ ) );
}

  add_action('admin_print_styles', 'add_my_stylesheet');
  

function equipment_insert()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'excercise';
    $result = $wpdb->get_results("SELECT * from $table_name");

    $table_name1 = $wpdb->prefix . 'target_equipment';
    $result1 = $wpdb->get_results("SELECT * from $table_name1");

    $log_entry_tbl = $wpdb->prefix . 'log_entry_option';
    $log_entries = $wpdb->get_results("SELECT * from $log_entry_tbl");

    $dificulty_level_tbl = $wpdb->prefix . 'difficulty_level';
    $dificulty_level = $wpdb->get_results("SELECT * from $dificulty_level_tbl");
  
?>

  <div class="container">
    <h2>Add Excercise</h2>
    <form action=""  method="post" id="emp_for,""m" enctype="multipart/form-data" onsubmit="return valid()">
      <!-- Excercise Name--> 
      <div class="form-group">
        <label >Excercise Name :</label>
        <input type="text" class="form-control" name="name"  placeholder="Excercise Name">
      </div>
      <!-- Excercise Description --> 
      <div class="form-group">
        <label >Excercise Description :</label>
   <!--      <textarea name="description" id="description" class="form-control" required placeholder="Excercise Description"></textarea> -->
        <?php
         $editor_id = 'description';
$settings =   array(
    'wpautop' => true, // use wpautop?
    'media_buttons' => false, // show insert/upload button(s)
    'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
    'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
    'tabindex' => '',
    'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
    'editor_class' => '', // add extra class(es) to the editor textarea
    'teeny' => false, // output the minimal editor config used in Press This
    'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
); 
          wp_editor( '$content', $editor_id, $settings = array() ); 
          ?>
      </div>
      <!-- Excercise --> 
      <div class="form-group">
        <label >Excercise Type :</label>
        <select name="excercise" id="excercise" class="form-control" required>
        <option value="">--- Excercise ---</option>
        	<?php
            foreach ($result as $res) {
              echo "<option value=$res->id>$res->excercise</option>";
             }
          ?>
        </select>
      </div>
      <!-- Target Region --> 
      <div class="form-group" id="target_region_group">
        <label >Target Region:</label>
        <select name="target_region" id="target_region" class="form-control">
        	<option value="">--- Target Region  ---</option>
        </select>
      </div>
      <!-- Target Muscle --> 
      <div class="form-group" id="muscle_group"> 
        <label >Target Muscle:</label>
        <select name="target_muscle" id="muscle" class="form-control">
        	<option value="">--- Target Muscle ---</option>
        </select>
      </div>
      <!-- Equipments --> 
      <div class="form-group" id="equipments-group">
        <label >Equipments:</label>
        <select name="equipments" id="equipments" class="form-control">
          <option value="">--- Equipment ---</option>
          <?php
            foreach ($result1 as $res) {
              echo "<option value=$res->id>$res->equipment</option>";
             }
          ?>
        </select>
      </div>
      <!-- Difficulty Level --> 
      <div class="form-group" >
        <label >Difficulty Level:</label>
        <select name="level" id="level" required class="form-control">
          <option value="">--- Difficulty Level ---</option>
          <?php
            foreach ($dificulty_level as $res) {
              echo "<option value=$res->id>$res->difficulty_level</option>";
             }
          ?>
        </select>
      </div>
      <!-- Duration --> 
      <div class="form-group" id="duration_group">
        <label >Log Entry Option 1:</label>
        <select name="duration" id="duration" class="form-control">
          <option value="">--- Duration ---</option>
          <?php
            foreach ($log_entries as $res) {
              echo "<option value=$res->id>$res->duration</option>";
             }
          ?>
        </select>
      </div>
      
      <!-- Distance --> 
      <div class="form-group" id="discance_group">
        <label >Log Entry Option 2:</label>
        <select name="distance" id="distance" class="form-control">
          <option value="">--- Distance ---</option>
          <?php
            foreach ($log_entries as $res) {
              echo "<option value=$res->id>$res->duration</option>";
             }
          ?>
        </select>
      </div>
      <!-- Speed --> 
      <div class="form-group" id="speed_group">
        <label >Log Entry Option 3:</label>
        <select name="speed" id="speed" class="form-control">
          <option value="">--- Speed ---</option>
          <?php
            foreach ($log_entries as $res) {
              echo "<option value=$res->id>$res->duration</option>";
             }
          ?>
        </select>
      </div>
      <!-- Calories --> 
      <div class="form-group" id="calories_group">
        <label >Log Entry Option 4:</label>
        <select name="calories" id="calories" class="form-control">
          <option value="">--- Calories ---</option>
          <?php
            foreach ($log_entries as $res) {
              echo "<option value=$res->id>$res->duration</option>";
             }
          ?>
        </select>
      </div>
      
      <!-- Upload Media --> 
      <div class="form-group" >
        <label >Upload Icon:</label>
        <input type="file" name="file" required accept="image/*" class="form-control">
      </div>
      <!-- Upload Media --> 
      <div class="form-group" >
        <label >Upload Image:</label>
        <input type="file" name="image" required accept="image/*" class="form-control">
      </div>
       
      <div class="form-group" >
        <label >Upload Video:</label>
        <input type="file" name="video" required accept="video/*" class="form-control">
      </div>
      <button type="submit" name="insert" id="insert" class="btn btn-primary">Add</button>
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
            $("#target_region_group").css("display", "block");
           }
          jQuery.ajax({
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            type : 'post',
            data : {
              action : 'my_target_region',
              excercise_id : id,
            },
            success : function( html ) {
              jQuery("#target_region").html(html);
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
    function new_filename($filename, $filename_raw) {
        global $post;
        $info = pathinfo($filename);
        $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
        $new = $post->post_title . $ext;
        // the if is to make sure the script goes into an indefinate loop
        if( $new != $filename_raw ) {
            $new = sanitize_file_name( $new );
        }
        return $new;
    }
	if(isset($_POST['insert'])  )
	{
      $time_section=time();
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
    $_FILES['image']['name']= $time_section.'_'.$_FILES['image']['name'];
    $_FILES['file']['name'] = $time_section.'_'.$_FILES['file']['name'];
    $_FILES['video']['name'] = $time_section.'_'.$_FILES['video']['name'];
    $equipments=$_POST['equipments'] ? $_POST['equipments'] : '';
    $file_name=$_FILES['file'] ? $_FILES['file']['name'] : '';
    $image=$_FILES['image'] ? $_FILES['image']['name'] : '';
    $video=$_FILES['video'] ? $_FILES['video']['name'] : '';

    $fileTmpName  = $_FILES['image']['tmp_name'];
    $uploadPath = dirname(__FILE__).'\images\\' . basename($image);
      move_uploaded_file($fileTmpName, $uploadPath);

		$table_name = $wpdb->prefix . 'excercise_master';
		
		$wpdb->insert($table_name,
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
		            )
            );
      // move file
      require_once(ABSPATH . "wp-admin" . '/includes/image.php');
      require_once(ABSPATH . "wp-admin" . '/includes/file.php');
      require_once(ABSPATH . "wp-admin" . '/includes/media.php');
      $file_id = media_handle_upload( 'file', $post->ID );
      $file_id1 = media_handle_upload( 'image', $post->ID );
      $file_id2 = media_handle_upload( 'video', $post->ID );
      $uploadPath = dirname(__FILE__).'\images\\' . basename($image);
      move_uploaded_file($fileTmpName, $uploadPath);
  		
  		echo "<script>
        bootbox.alert({
  			    message:'Data Is Sucessfully Inserted!',
  			    size: 'small'
  			});
  		 </script>";
	}
}


?>

