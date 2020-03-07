<?php

function program_update()
{
  $id=$_GET['id'];
  global $wpdb;
    $table = $wpdb->prefix . 'program_type';
    $qry ="SELECT * FROM $table";
   $result = $wpdb->get_results($qry);


    $table1 = $wpdb->prefix . 'program';
    $qry1 ="SELECT * FROM $table1  where id = $id";
   $result1 = $wpdb->get_results($qry1);

    $typeID = $result1[0]->program_type;
    $qry2 ="SELECT * FROM $table  where id = $typeID";
   $result2 = $wpdb->get_results($qry2);
?>
<style type="text/css">
  .section {
        border: 1px solid darkgray;
    box-shadow: 1px 1px 1px 1px;
    padding: 13px;
        margin-bottom: 15px;
  }
  .remove {
        position: relative;
    float: right;
    font-size: 27px;
        cursor: pointer;
  }

</style>
  <div class="container">
    <h2>Update Program</h2>
    <form action=""  method="post" id="emp_for,""m" enctype="multipart/form-data" onsubmit="return valid()">
 <div class="form-group">
      <label for="name">Program Name:</label>
      <input type="text" class="form-control" id="name" value="<?php echo $result1[0]->name; ?>" required name="name" placeholder="Program Name">
      <!-- <input type="hidden" name="Section[]" placeholder="Enter Name"> -->
      <input type="hidden" id="count" value="0" name="count">
  </div>
  <div class="form-group">
      <label >Description:</label>
      <!-- <textarea class="form-control" rows="5" id="description" name="description"></textarea> -->
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
          wp_editor( $result1[0]->description, $editor_id, $settings = array() ); 
          ?>

  </div>
  <div class="form-group">
      <label for="sel1">Program Type:</label>
      <select class="form-control" required name="program_type" id="sel1">
        <option value="<?php echo $result2[0]->id ?>"><?php echo $result2[0]->type ?></option>
        <?php
          foreach ($result as $res) {
             if($res->id != $result2[0]->id) {
                echo "<option value=$res->id >$res->type</option>";
            }
          }
         ?>
      </select>
  </div>
  <div class="form-group">
      <label >Image:</label>
      <input type="file" required class="form-control" onchange=" loadFile(event)" id="image" name="image" >
      <?php if($result2[0]->image) { ?>
        <img class="img-thumbnail" height="300"  width="300" id="img" src="<?php echo home_url().'/wp-content/uploads/'.date("Y").'/.date("m")./'.$result2[0]->image; ?>">
        <?php } ?>
        <script>
        var loadFile = function(event) {
          var output = document.getElementById('img');
          output.src = URL.createObjectURL(event.target.files[0]);
        };
      </script>
  </div>
  <?php
    $table3 = $wpdb->prefix . 'program_section';
    $qry3 ="SELECT * FROM $table3  where program_id = $id";
    $result3 = $wpdb->get_results($qry3);
    $table4 = $wpdb->prefix . 'program_excercise';
    $qry4 ="SELECT * FROM $table4  where program_id = $id";
    $result4 = $wpdb->get_results($qry4);
    for($i=0; $i < count($result3);$i++)
    {
    ?>
    <div id='input_text"+total_text+"_wrapper'>
      <span class='remove'  onclick=remove_field('input_text"+total_text+"')>&#10006;</span>
      <div class='section' >
     <div class="form-group">
        <label >Program Section:<?php echo $i+1; ?></label>
        <input type="text" class="form-control" id="name" value="<?php echo $result3[$i]->section_name; ?>" required name="Section[]" placeholder="Program Name">
        <input type="hidden"  value="<?php echo $result3[$i]->id;  ?>" name="psid[]">
        <input type="hidden" id="count" value="<?php echo count($result3); ?>" name="count">
      </div>
      <div class="form-group">
        <?php
          $eid = $result4[$i]->excercise_id;
          $table5 = $wpdb->prefix . 'excercise_master';
          $qry5 ="SELECT * FROM $table5  where id = $eid";
          $result5 = $wpdb->get_results($qry5);
          $qry6 ="SELECT * FROM $table5 ";
          $result6 = $wpdb->get_results($qry6);
        ?>
        <input type="hidden"  value="<?php echo  $result5[0]->id;  ?>" name="id[]">
        <label >Excercise Section<?php echo $i+1; ?></label>
        <select class="form-control" required name='excercise[]' id="sel1">
        <option value="<?php echo $result5[0]->id ?>"><?php echo $result5[0]->name ?></option>
        <?php
          foreach ($result6 as $res) {
             if($res->id != $result5[0]->id) {
                echo "<option value=$res->id >$res->name</option>";
            }
          }
         ?>
      </select>
      </div>
    </div>
    </div>
   <?php   
   }
  ?>
  <div id="field_div"></div>
   <button type="button" class="btn btn-default" onclick="add_field();">Add New Element</button>
      <button type="submit" name="insert" id="insert" class="btn btn-primary">Add</button>
    </form>
  </div>
  <?php
    global $wpdb;
    $table = $wpdb->prefix . 'excercise_master';
    $qry ="SELECT * FROM $table";
   $result = $wpdb->get_results($qry);
   $dropDown = "<select class=form-control required name='excercise[]' id=sel1>";
   $dropDown .= "<option value=''>--- Select Excercise ---</option>";
   foreach ($result as $res) {
   $dropDown .= "<option value=$res->id >$res->name</option>";
    }
    $dropDown .="</select>";
  ?>
 <script>
    function add_field()
    {
      var total_text=document.getElementsByClassName("input_text");
      total_text=total_text.length+1;
      document.getElementById('count').value = total_text;
      document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
      "<div id='input_text"+total_text+"_wrapper'>"+
      "<span class='remove'  onclick=remove_field('input_text"+total_text+"')>&#10006;</span>"+
      "<div class='section' >"+
      "<div class='form-group' >"+
        "<label >Program Section"+ total_text +"</label>"+
        "<input type='text' class='input_text form-control' required name='Section[]' placeholder='Enter Text'>"+
        "</div>"+
        "<div class=form-group >"+
        "<label >Excercise Section"+ total_text +"</label>"+
        "<?php echo $dropDown; ?>"+
        "</div>"+
        "</div></div>";
    }
    function remove_field(id)
    {
      document.getElementById(id+"_wrapper").innerHTML="";
       document.getElementById('count').value = document.getElementById('count').value -1;
    }
</script>

  <?php
	if(isset($_POST['insert'])  )
	{
    global $wpdb;
    $name=$_POST['name'];
    $description=$_POST['description'];	
	 	$program_type=$_POST['program_type'];
    $file_name=$_FILES['image']['name'] ? $_FILES['image']['name'] : '';
    $count = $_POST['count'];
    $section = $_POST['Section'];
    $excercise = $_POST['excercise'];
  
    $table_name = $wpdb->prefix . 'program';
    $wpdb->update($table_name,
                array(
                    'name' => $name,
                    'description' => $description,                  
                    'program_type' => $program_type,
                    'image' => $file_name,
                ),
                array('id'=> $id)
            );
 
    
   
  $table_name2 =$wpdb->prefix . 'program_section';
  // delete from program section    
    $wpdb->delete(
            $table_name2,
            array('program_id'=>$id)
        );
  $table_name3 =$wpdb->prefix . 'program_excercise';
    $wpdb->delete(
            $table_name3,
            array('program_section_id'=>$id)
        );

  for ($x = 0; $x < count($section); $x++) {
   //echo $section[$x]." ".$excercise[$x]."<br>";
      $wpdb->insert($table_name2,
                array(
                    'section_name' => $section[$x],
                    'program_id' =>$id,
                )
            );
      
      $qry1 ="SELECT * FROM $table_name2 where program_id=$id ORDER BY id DESC LIMIT 1";
      echo $qry1;
      $result1 = $wpdb->get_results($qry1);
      $wpdb->insert($table_name3,
                array(
                    'program_section_id' => $result1[0]->id,
                    'excercise_id' =>$excercise[$x],
                    'sets'=>'',
                    'repeatation'=>'',
                    'program_id' =>$id,
                )
            );
  }
	
	
      require_once(ABSPATH . "wp-admin" . '/includes/image.php');
      require_once(ABSPATH . "wp-admin" . '/includes/file.php');
      require_once(ABSPATH . "wp-admin" . '/includes/media.php');
      $file_id = media_handle_upload( 'file', $post->ID );
      $file_id1 = media_handle_upload( 'image', $post->ID );
      $file_id2 = media_handle_upload( 'vedio', $post->ID );
  		
  		echo "<script>
        bootbox.alert({
  			    message:'Data Is Sucessfully Inserted!',
  			    size: 'small'
  			});
  		 </script>";
	}
}


?>

