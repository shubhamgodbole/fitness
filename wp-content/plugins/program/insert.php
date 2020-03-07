    <?php
    
    function program_insert()
    {
      
      global $wpdb;
        $table = $wpdb->prefix . 'program_type';
        $qry ="SELECT * FROM $table";
       $result = $wpdb->get_results($qry);
    ?>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
        <?php echo dirname(__FILE__).'/images/'; ?>
        <!-- novalidate -->
        <form action=""  method="post" id="emp_for" enctype="multipart/form-data"  onsubmit="return valid()">
     <div class="form-group">
          <label for="name">Program Name:</label>
          <input type="text" class="form-control" id="name" required name="name" placeholder="Program Name">
      </div>
      <div class="form-group">
          <label >Description:</label>
          <textarea class="form-control" rows="5" id="description" name="description"></textarea>
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
          <input type="file" required class="form-control" onchange="loadFiles(event)" accept="image/*" id="img" name="image" >
          <img class="img-thumbnail" style="display: none;" id="image">
      </div>
       <script>
        var loadFiles = function(event) {
          var output = document.getElementById('image');
          output.src = URL.createObjectURL(event.target.files[0]);
           output.height ="300";
          output.width ="300";
          output.style.display = "block";
          console.log(event.target.files[0]);
        };
      </script>
      <div id="dvprogramsection" ></div>
      <br>
       <button type="button" class="btn btn-default" id="addMore" onclick="AddProgramSection();" >Add New Section</button>
          <button type="submit" name="insert" id="insert" class="btn btn-primary">Add</button>
        </form>
      </div>

      <?php
        global $wpdb;
        $table = $wpdb->prefix . 'excercise_master';
        $qry ="SELECT * FROM $table";
       $result = $wpdb->get_results($qry);
       $dropDown = "";
       foreach ($result as $res) {
       $dropDown .= "{ id: $res->id, text: '$res->name'},";
        }
     

      ?>
      <script>
var ecnt = 0;
  document.getElementById('addMore').click();
  function AddProgramSection(){
  var sectionnumber = Math.floor(Math.random()*1000) + 1;
  var dvsectionid= "dvsection_" +sectionnumber;
  
  var dvexcercisesectionid= "dvexcercisesection_" +sectionnumber;
      var strHtml = "<div id=\""+dvsectionid+"\" style=\"margin-top:10px;\">"+
        "<label>Program Section :</label>" +
        "<input type=text name='Section[]' required placeholder='program section' style=\"width:300px\" class=form-control>" +
        "<label>Excercise Section :</label><br>" +
        "<select id=\""+dvexcercisesectionid+"\" required name=excercise"+ecnt+"[]  data="+ ecnt +"  multiple=\"multiple\" style=\"width:300px\" placeholder=\"select excercise...\"></select>"+
      "<input type=\"button\" value=\"Remove\" onclick=\"RemoveProgramSection('"+dvsectionid+"');\"/>"+  
      "<button class=close type=button aria-label=Close onclick=RemoveProgramSection('"+dvsectionid+"');><span aria-hidden=true>&times;</span><button>"+  
      "</div>";
      jQuery("#dvprogramsection").append(strHtml);
      ecnt= ecnt+1;
      RenderSection(dvexcercisesectionid);
  }

    function RenderSection(id){
    
  jQuery('#' +id).select2({
      placeholder: "Select features"
    ,data: [
        <?php echo $dropDown; ?>
      ],
    
  });
  jQuery('#' +id).on('select2:select', function (e) {
    var sectionnumber = e.target.id.split("_")[1];
    CreateExerciseSection(sectionnumber, e.params.data);
  });4
  jQuery('#' +id).on('select2:unselect', function (e) {
  var sectionnumber = e.target.id.split("_")[1];
    RemoveExerciseSection(sectionnumber, e.params.data);
  });

  }
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

  function CreateExerciseSection(sectionnumber,data){
    var dvsectionid= "dvsection_" +sectionnumber;
    var strHtml = '<div id="'+dvsectionid + "_dvexcercise_" + data.id + '" style="margin-top:10px;">'+
    "<label>Section for "+ data.text +":</label><br>"+
    '<input type="text"  placeholder="sets" onkeypress="return isNumberKey(event)" name="sets[]">' +
    '<input type="text" placeholder="repeatation" onkeypress="return isNumberKey(event)" name="repeatation[]">' +
      '</div>';
      jQuery("#" +dvsectionid).append(strHtml);
  }
  function RemoveExerciseSection(sectionnumber,data){
      var dvsectionid= "dvsection_" +sectionnumber;
      jQuery("#" +dvsectionid + "_dvexcercise_" +data.id).remove();
  }
   
   function RemoveProgramSection(id)
  {
    debugger
    var data = jQuery("#" +id+' select').attr('data');
              for(z = data; z < ecnt; z++){
                var d = jQuery( "select[data$="+z+"]" ).attr('name' );
                var n = d[9];
                var final = parseInt(n) - 1;  
                jQuery( "select[data$="+z+"]" ).attr("name","excercise"+final+"[]" )
              }
  jQuery("#" +id).remove();
  ecnt = ecnt -1; 
  }
  </script>
      <?php
    if(isset($_POST['insert'])  )
    {
      //  print_r($_POST);
        //exit;

      $excercise= array();
      global $wpdb;
       $time_section=time();
      $name=$_POST['name'];
      $description=$_POST['description']; 
      $program_type=$_POST['program_type'];
      $_FILES['image']['name']= $time_section.'_'.$_FILES['image']['name'];
      $file_name=$_FILES['image']['name'] ? $_FILES['image']['name'] : '';
      $fileTmpName  = $_FILES['image']['tmp_name'];
      $count = $_POST['count'];
      $section = $_POST['Section'];
      $repeatation = $_POST['repeatation'];
      $sets = $_POST['sets'];
      $cnt =0;
      $uploadPath = dirname(__FILE__).'\images\\' . basename($file_name);
      move_uploaded_file($fileTmpName, $uploadPath);

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
        $excercise = $_POST['excercise'.$x];
 
  
         for ($i = 0; $i < count($excercise); $i++) {
         //   echo $cnt;
          $wpdb->insert($table_name3,
                    array(
                        'program_section_id' => $result1[0]->id,
                        'excercise_id' =>$excercise[$i],
                        'sets'=>$sets[$cnt],
                        'repeatation'=>$repeatation[$cnt],
                        'program_id' =>$result[0]->id,
                    )
                );
          $cnt=$cnt+1;
        }
   }
    
    
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $file_id = media_handle_upload( 'image', $post->ID );
        echo "Image URL".wp_get_attachment_url($file_id)."<br>".$upload_dir['baseurl'];
        echo "<script>
          bootbox.alert({
              message:'Data Is Sucessfully Inserted!',
              size: 'small'
          });
         </script>";
         wp_redirect(admin_url('/admin.php?page=Program_Listing'));
    }
  }


  ?>


