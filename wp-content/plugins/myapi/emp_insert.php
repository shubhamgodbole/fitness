<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'myapi/v1', '/author/', array(
      'methods' => 'POST',
      'callback' => 'emp_insert',
    ) );
  });
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

function emp_insert()
{
?>

<div class="container">
  <h2>Stacked form</h2>
  <form action=""  method="post" id="emp_form" enctype="multipart/form-data" onsubmit="return valid()">
    <!-- Excercise --> 
    <div class="form-group">
      <label >Excercise Type :</label>
      <select name="excercise" id="excercise" class="form-control">
      <option value="">--- Excercise ---</option>
        <option value="weight">Weight</option>
        <option value="cardio">Cardio</option>
        <option value="streches">Streches</option>
      </select>
    </div>
    <!-- Category --> 
    <div class="form-group">
      <label >Category:</label>
      <select name="category" id="category" class="form-control">
        <option value="">--- Category  ---</option>
      </select>
    </div>
    <!-- Sub Category --> 
    <div class="form-group">
      <label >Sub Category:</label>
      <select name="SubCategory" id="SubCategory" class="form-control">
        <option value="">--- Sub Category ---</option>
      </select>
    </div>
    <!-- Difficulty Level --> 
    <div class="form-group">
      <label >Difficulty Level:</label>
      <select name="level" id="level" class="form-control">
        <option value="">--- Difficulty Level ---</option>
        <option value="beginner">Beginner</option>
        <option value="intermediate">Intermediate</option>
        <option value="advanceed">Advanceed</option>
        <option value="none">None</option>
      </select>
    </div>
    <!-- Has Equipment --> 
    <div class="form-group form-check">
      <label class="form-check-label"> Has Equipment </label>
      <input class="form-control" type="checkbox" id="hasEquipment" value="hasEquipment">
    </div>
    <!-- Has Streches --> 
    <div class="form-group form-check">
      <label class="form-check-label"> Has Streches </label>
      <input class="form-control" type="checkbox" id="hasStreches" value="hasStreches">
    </div>
    <!-- Equipments --> 
    <div class="form-group" id="equipments-group">
      <label >Equipments:</label>
      <select name="equipments" id="equipments" class="form-control">
        <option value="">--- Equipments ---</option>
        <option value="dumbells">Dumbells</option>
        <option value="barbell">Barbell</option>
        <option value="none">None</option>
      </select>
    </div>
    <!-- Streches --> 
    <div class="form-group" id="streches-group">
      <label >Streches:</label>
      <select name="streches" id="streches" class="form-control">
        <option value="">--- Streches ---</option>
        <option value="upperBody">UpperBody</option>
        <option value="lowerBody">LowerBody</option>
        <option value="fullBody">FullBody</option>
      </select>
    </div>
    <!-- Upload Media --> 
    <div class="form-group" >
      <label >Upload Media:</label>
      <input type="file" name="file" class="form-control">
    </div>
    <button type="submit" name="insert" id="insert" class="btn btn-primary">Add</button>
  </form>
</div>
<script type="text/javascript">
 // on excercise change
 $('#excercise').on('change', function() {
         var excercise = $(this).val();
        if(excercise == 'weight')
        {
            $('#category option.categoryopt').remove();
            $('#category').append(
              "<option value=abdonimal class=categoryopt>Abdonimal</option>"+
              "");
        }
        else if(excercise == 'cardio')
        {
            $('#category option.categoryopt').remove();
            $('#category').append(
              "<option value=cardio class=categoryopt>Cardio</option>"+
              "");
        }
        else if(excercise == 'streches')
        {
            $('#category option.categoryopt').remove();
            $('#category').append(
              "<option value=streches class=categoryopt>Streches</option>"+
              "");
        }
   });
 // on Category change
 $('#category').on('change', function() {
         var category = $(this).val();
       if(category == 'abdonimal')
        {
            $('#SubCategory option.subCategoryopt').remove();
            $('#SubCategory').append(
              "<option value=abdonimal_sub1 class=subCategoryopt>Abdonimal-Sub1</option>"+
              "");
        }
        else if(category == 'cardio')
        {
            $('#SubCategory option.subCategoryopt').remove();
            $('#SubCategory').append(
              "<option value=cardio_sub1 class=subCategoryopt>Cardio-Sub1</option>"+
              "");
        }
        else if(category == 'streches')
        {
            $('#SubCategory option.subCategoryopt').remove();
            $('#SubCategory').append(
              "<option value=steched_sub1 class=subCategoryopt>Steched-Sub1</option>"+
              "");
        }
   });
$("#equipments-group").css("display", "none");
 $('#hasEquipment').on('change', function() {
    if(this.checked != true){
       $("#equipments-group").css("display", "none");
     }
     else {
      $("#equipments-group").css("display", "block");
     }
  });
 $("#streches-group").css("display", "none");
 $('#hasStreches').on('change', function() {
    if(this.checked != true){
       $("#streches-group").css("display", "none");
     }
     else {
      $("#streches-group").css("display", "block");
     }
  });
</script>

<?php
    global $wpdb; 
    $excercise=$_POST['excercise'];
    $category=$_POST['category'];
    $sub_category=$_POST['SubCategory'];
    $level=$_POST['level'];
    $equipments=$_POST['equipments'] ? $_POST['equipments'] : '';
    $streches=$_POST['streches'] ? $_POST['streches'] : '';
    $file_name=$_FILES['file'] ? $_FILES['file']['name'] : '';

    $table_name = $wpdb->prefix . 'custom_equipment';
    $wpdb->insert($table_name,
                array(
                    'excercise' => $excercise,
                    'category' => $category,
                    'sub_category' => $sub_category,
                    'difficulty_level' => $level,
                    'equipments' => $equipments,
                    'streches' => $streches,
                    'media' => $file_name
                )
            );
    // move file
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $file_id = media_handle_upload( 'file', $post->ID );
    
    
    echo "<script>
      bootbox.alert({
          message:'Data Is Sucessfully Inserted!',
          size: 'small'
      });
    </script>";
}