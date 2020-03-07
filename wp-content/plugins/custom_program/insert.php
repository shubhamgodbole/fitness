  <?php

  /*function add_my_stylesheet_program1() 
  {
      wp_enqueue_style( 'bootstrap.min', plugins_url( '/template/css/bootstrap.min.css', __FILE__ ) );
       wp_enqueue_style( 'dataTables.min', plugins_url( '/template/css/dataTables.min.css', __FILE__ ) );
      //wp_enqueue_script( 'jquery.min', plugins_url( '/template/js/jquery.min.js', __FILE__ ) );
      wp_enqueue_script( 'popper.min', plugins_url( '/template/js/popper.min.js', __FILE__ ) );
      wp_enqueue_script( 'bootstrap.min', plugins_url( '/template/js/bootstrap.min.js', __FILE__ ) );
      wp_enqueue_script( 'bootbox.min', plugins_url( '/template/js/bootbox.min.js', __FILE__ ) );
      wp_enqueue_script( 'customJs', plugins_url( '/template/js/customJs.js', __FILE__ ) );
      wp_enqueue_script( 'dataTables.min', plugins_url( '/template/js/dataTables.min.js', __FILE__ ) );
      wp_enqueue_script( 'jquery-ui-autocomplete' );
      wp_enqueue_style( 'example-1', plugins_url( '/template/css/example-1.css', __FILE__ ) );
      wp_enqueue_script( 'jquery-2', plugins_url( '/template/js/jquery-2.2.2.min.js', __FILE__ ) );
      wp_enqueue_script( 'm-select-d-box', plugins_url( '/template/js/m-select-d-box.js', __FILE__ ) );
      wp_enqueue_script( 'ex-1-custom-appear', plugins_url( '/template/js/ex-1-custom-appear.js', __FILE__ ) );
      wp_enqueue_script( 'example-1-js', plugins_url( '/template/js/example-1.js', __FILE__ ) );

      
  }

    add_action('admin_print_styles_program1', 'add_my_stylesheet_program1');
    
  */
  function program_insert()
  {
    
    global $wpdb;
      $table = $wpdb->prefix . 'program_type';
      $qry ="SELECT * FROM $table";
     $result = $wpdb->get_results($qry);
  ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
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
      <h2>Add Program</h2>
      
      
      <form action=""  method="post" id="emp_for" enctype="multipart/form-data" novalidate>
   <div class="form-group">
        <label for="name">Program Name:</label>
        <input type="text" class="form-control" id="name" required name="name" placeholder="Program Name">
        <!-- <input type="hidden" name="Section[]" placeholder="Enter Name"> -->
        <input type="hidden" id="count" value="0" name="count">
    </div>
    <div class="form-group">
        <label >Description:</label>
        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                <?php
           // $editor_id = 'description';
           //  $settings =   array(
           //      'wpautop' => true, // use wpautop?
           //      'media_buttons' => false, // show insert/upload button(s)
           //      'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
           //      'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
           //      'tabindex' => '',
           //      'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
           //      'editor_class' => '', // add extra class(es) to the editor textarea
           //      'teeny' => false, // output the minimal editor config used in Press This
           //      'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
           //      'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
           //      'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
           //  ); 
           //  wp_editor( '', $editor_id, $settings = array() ); 
            ?>

    </div>
    <div class="form-group">
        <label for="sel1">Program Type:</label>
        <select class="form-control" required name="program_type"  >
          <option value="">--- Select Type ---</option>
          <?php
            foreach ($result as $res) {
            echo "<option value=$res->id >$res->type</option>";
            }
           ?>
        </select>
    </div>
    <div class="form-group">
        <label >Image:</label>
        <input type="file" required class="form-control" id="image" name="image" >
    </div>
    <div id="field_div"></div>
     <button type="button" class="btn btn-default" id="addMore" >Add New Element</button>
        <button type="submit" name="insert" id="insert" class="btn btn-primary">Add</button>
      </form>
    </div>

    <?php
      global $wpdb;
      $table = $wpdb->prefix . 'excercise_master';
      $qry ="SELECT * FROM $table";
     $result = $wpdb->get_results($qry);
   //  $dropDown = "<select class=form-control multiple required name='excercise[]' id='framework'>";
    // $dropDown .= "<option value='' selected>--- Select Excercise ---</option>";
     foreach ($result as $res) {
     $dropDown .= "<option value=$res->id >$res->name</option>";
      }
   //   $dropDown .="</select>";

    ?>
  <script>
      function add_field(a)
      {
        var total_text=document.getElementsByClassName("input_text");
        total_text=total_text.length+1;
        var id='framework'+a;
        var programId='program'+a;
        document.getElementById('count').value = total_text;
        document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
        "<div id='input_text"+total_text+"_wrapper'>"+
        "<span class='remove'  onclick=remove_field('input_text"+total_text+"')>&#10006;</span>"+
        "<div class='section' >"+
        "<div class='form-group' >"+
          "<label >Program Section"+ total_text +"</label>"+
          "<input type='text' class='input_text form-control' id="+programId +" required name='Section[]' placeholder='Enter Text'>"+
          "</div>"+
          "<div class=form-group >"+
          "<label >Excercise Section"+ total_text +"</label><br>"+
          "<select class="+ id +" multiple  required name="+id+"excercise[] id="+id +">"+
          "<?php echo $dropDown; ?>"+
          "</select>"+
          "</div>"+
          "<div id=repeatation_section"+a+" ></div>"+
          "</div>"+
          "</div>";

      }
      function add_field2(a)
      {
       // var length= document.getElementById('framework'+a).value;
     //   alert(length);
        var total_text=document.getElementsByClassName("repeatation");
        total_text=total_text.length+1;
        var id='repeatation';
       // document.getElementById('count').value = total_text;
        document.getElementById("repeatation_section"+a).innerHTML=document.getElementById("repeatation_section"+a).innerHTML+
        "<div id=input_text"+a+">"+
        "<span class='remove'  onclick=remove_repetation("+a+")>&#10006;</span>"+
        "<div class='section' >"+
        "<div class='form-group' >"+
          "<label >Repeatation Section</label>"+
          "<input type='text' class='repeatation form-control' id="+ id +" required name='repeatation[]' placeholder='Enter Text'>"+
          "</div>"+
          "<div class='form-group' >"+
          "<label >Sets Section</label>"+
          "<input type='text' class='repeatation form-control' id="+ id +" required name='sets[]' placeholder='Enter Text'>"+
          "</div>"+
          "</div></div>";

      }
        function remove_field(id)
        {
          document.getElementById(id+"_wrapper").innerHTML="";
           document.getElementById('count').value = document.getElementById('count').value -1;
        }
      jQuery(document).ready(function(){
     
      jQuery('#addMore').on('click',function(){
      var a =Math.floor(Math.random() * (1000 - 0)) + 0;

        add_field(a);  
         jQuery('.framework'+a).multiselect({
          nonSelectedText: 'Select Excercise',
          enableFiltering: true,
          enableCaseInsensitiveFiltering: true,
          buttonWidth:'100%',
          onChange: function(element, checked) {
                var len = jQuery('.framework'+a).val().length;
                       jQuery(len).each(function(index, brand){
                            add_field2(a);
                        });
              }
         });
         jQuery('.framework'+a).multiselect('rebuild');
        }); 
      });
  </script>

    <?php
  	if(isset($_POST['insert'])  )
  	{
       print_r($_POST);
       exit;

$excercise= array();
      global $wpdb;
      $name=$_POST['name'];
      $description=$_POST['description'];	
  	 	$program_type=$_POST['program_type'];
      $file_name=$_FILES['image']['name'] ? $_FILES['image']['name'] : '';
      $count = $_POST['count'];
      $section = $_POST['Section'];
      $excercise = $_POST['excercise'];
      $repeatation = $_POST['repeatation'];
      $sets = $_POST['sets'];
 

 /*var_dump($excercise);
 exit;*/

      $table_name = $wpdb->prefix . 'program';
      $wpdb->insert($table_name,
                  array(
                      'name' => $name,
                      'description' => $description,                  
                      'program_type' => $program_type,
                      'image' => $file_name,
                  )
              );
   
     $qry ="SELECT * FROM $table_name ORDER BY id DESC LIMIT 1";
     $result = $wpdb->get_results($qry);
      
     
    $table_name2 =$wpdb->prefix . 'program_section';
    $table_name3 =$wpdb->prefix . 'program_excercise';
    for ($x = 0; $x < count($section); $x++) {
     
    $wpdb->insert($table_name2,
                  array(
                      'section_name' => $section[$x],
                      'program_id' =>$result[0]->id,
                  )
              );     
        $qry1 ="SELECT * FROM $table_name2 ORDER BY id DESC LIMIT 1";
        $result1 = $wpdb->get_results($qry1);
        for ($i = 0; $i < count($excercise); $i++) {
          $wpdb->insert($table_name3,
                    array(
                        'program_section_id' => $result1[0]->id,
                        'excercise_id' =>$excercise[$i],
                        'sets'=>$sets[$i],
                        'repeatation'=>$repeatation[$i],
                        'program_id' =>$result[0]->id,
                    )
                );
        }
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

