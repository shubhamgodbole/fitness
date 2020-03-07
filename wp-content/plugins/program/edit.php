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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style type="text/css">
  .section {
        margin-top: 10px;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
    flex: 1 1 auto;
    padding: 1.25rem;
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
      <textarea class="form-control" rows="5" id="description" name="description"><?php echo $result1[0]->description ?></textarea>
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
      <input type="file"  class="form-control" onchange="loadFile1(event)" id="image" name="image" >
      <?php if($result1[0]->image) { ?>
        <img class="img-thumbnail" height="300"  width="300" id="img" src="<?php echo home_url().'/wp-content/uploads/'.date("Y").'/'.date("m").'/'.$result1[0]->image; ?>">
      <?php } ?>
      <script>
        var loadFile1 = function(event) {
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
      echo"<div id=dvprogramsection>";
      for($i=0; $i < count($result3);$i++)
      {

    ?>

            <div id="<?php echo $i; ?>" style="margin-top:10px;">
              <!-- <label>Program Section <?php //echo $i+1; ?>:</label>
              <input type=text name='Section[]' value="<?php //echo $result3[$i]->section_name; ?>" class=form-control> -->
              <div class=form-group>
                <?php
                   $psid =$result3[$i]->id;
                  $qry4 = "SELECT count(*) as total  FROM `wp_program_excercise` ,wp_program_section WHERE wp_program_excercise.program_section_id = wp_program_section.id AND wp_program_section.id = $psid";
                    $result4 = $wpdb->get_results($qry4);
                    $tot = $result4[0]->total;
                    // echo "tot=".$tot ;
                   // echo "qry=".$qry4;
                   $idArrray = array();
                   $pro_sec_idArray = array();
                   $editdropDown="";
                   for ($cntr =0; $cntr < $tot; $cntr ++) {
                          $q="select * from $table4 where program_section_id=$psid ";
                          $r = $wpdb->get_results($q);
                          $eid = $r[$cntr]->excercise_id;
                          $table5 = $wpdb->prefix . 'excercise_master';
                          $qry5 ="SELECT * FROM $table5  where id = $eid";
                          $result5 = $wpdb->get_results($qry5);
                          $exid= $result5[0]->id;
                           $qry6 ="SELECT * FROM $table5 ";
                          $result6 = $wpdb->get_results($qry6);
                          $currentDropDown = "";

                          foreach ($result6 as $res) {

                              if($res->id == $exid)
                              {
                                
                               // array_push($idArrray,$res->id);
                                $qry7 ="SELECT * FROM $table4  where excercise_id = $exid And program_section_id=$psid ";
                                $result7 = $wpdb->get_results($qry7);
                                $set =  $result7[0]->sets;
                                $rept =$result7[0]->repeatation;
                              //  echo $qry7."<br>";
                                $editdropDown .= "{ id: $res->id, text: '$res->name',sets:$set,repetation:$rept},";
                                $total_records=count($result7);
                              }
                              
                    //            $editdropDown .= "<option value=$res->id selected>$res->name</option>";
                          }
                   }
                //     
                ?>
                
              </div>
            
            
            <script>
             var val<?php echo $i; ?> = '<?php echo $result3[$i]->section_name; ?>';
             var cnt =  <?php echo count($tot) ?>;
             var ecnt;
              jQuery( document ).ready(function() {
                
                var currentselecteddata= [
                  <?php echo $editdropDown; ?>
                ];
              
                    AddProgramSection<?php echo $i; ?>(currentselecteddata);
                });

                var data= [
                  <?php echo $dropDown; ?>
                ];
                function AddProgramSection<?php echo $i; ?>(currentselecteddata){
                var sectionnumber = Math.floor(Math.random()*1000) + 1;
                var dvsectionid= "dvsection_" +sectionnumber;
                 ecnt = <?php echo $i; ?>;
                var dvexcercisesectionid= "dvexcercisesection_" +sectionnumber;
                    var strHtml = "<div id=\""+dvsectionid+"\" class=section style=\"margin-top:10px;\">"+
                     "<label>Program Section :</label>" +
        "<input type=text name='Section[]' placeholder='program section' value="+val<?php echo $i; ?>+" style=\"width:300px\" class=form-control>" +
                      "<label>Excercise Section :</label><br>"+
                      "<select id=\""+dvexcercisesectionid+"\" data="+ ecnt +" name=excercise"+ecnt+"[] multiple=\"multiple\" style=\"width:300px\" placeholder=\"select excercise...\"></select>"+
                    "<input type=\"button\" value=\"Remove\" onclick=\"RemoveProgramSection('"+dvsectionid+"');\"/>"+  
                    "</div>";
                    jQuery("#dvprogramsection #<?php echo $i; ?>").append(strHtml);
                   // ecnt= ecnt+1;
                    RenderSection(dvexcercisesectionid,currentselecteddata);
                }
                 function AddProgramSection(){
                  var sectionnumber = Math.floor(Math.random()*1000) + 1;
                  var dvsectionid= "dvsection_" +sectionnumber;
                  cnt= cnt+1;
                  var dvexcercisesectionid= "dvexcercisesection_" +sectionnumber;
                      var strHtml = "<div id=\""+dvsectionid+"\" class=section style=\"margin-top:10px;\">"+
                        "<label>Program Section :</label>" +
                        "<input type=text name='Section[]' placeholder='program section' style=\"width:300px\" class=form-control>" +
                        "<label>Excercise Section :</label><br>" +
                        "<select id=\""+dvexcercisesectionid+"\"  data="+ cnt +" name=excercise"+cnt+"[]  multiple=\"multiple\" style=\"width:300px\" placeholder=\"select excercise...\"></select>"+
                      "<input type=\"button\" value=\"Remove\" onclick=\"RemoveProgramSection('"+dvsectionid+"');\"/>"+  
                      "</div>";
                      jQuery("#dvprogramsection").append(strHtml);
                      
                      RenderSection(dvexcercisesectionid);
                  }



                function RenderSection(id, currentselecteddata){
                //var currentData = JSON.parse(JSON.stringify(data));
                var currentData = cloneArray(data);
                if(currentselecteddata != undefined && currentselecteddata.length > 0)
                {
                  for (i= 0;i< currentselecteddata.length ; i++)
                  {
                  var sectionnumber = id.split("_")[1];
                   var index  = currentData.findIndex(x => x.id == currentselecteddata[i].id);
                   if(index > -1)
                   {
                    currentData[index].selected =  'selected';
                    CreateExerciseSection(sectionnumber, currentselecteddata[i] , currentselecteddata[i].sets, currentselecteddata[i].repetation);
                   }
                  }
                      
                }
                else 
                {
                  currentData =data;
                }
                jQuery('#' +id).select2({
                    placeholder: "Select Excercise",
                  data: currentData,
                  
                });
                jQuery('#' +id).on('select2:select', function (e) {
                  var sectionnumber = e.target.id.split("_")[1];
                  CreateExerciseSection(sectionnumber, e.params.data, '', '',);
                });4
                jQuery('#' +id).on('select2:unselect', function (e) {
                var sectionnumber = e.target.id.split("_")[1];
                  RemoveExerciseSection(sectionnumber, e.params.data);
                });
            }
            function CreateExerciseSection(sectionnumber,data, sets, repeatation){
              var dvsectionid= "dvsection_" +sectionnumber;
              var strHtml = "<div id=\""+dvsectionid + "_dvexcercise_" + data.id + "\" style=\"margin-top:10px;\">"+
              "<label>Section for "+ data.text +":</label><br>"+
              "<input type=\"text\" onkeypress='return isNumberKey(event)' name=sets[] placeholder=\"sets\" value=\"" +sets+ "\">" +
              "<input type=\"text\" onkeypress='return isNumberKey(event)'' name=repeatation[] placeholder=\"repeatation\" value=\"" +repeatation+ "\">" +
                "</div>";
                jQuery("#" +dvsectionid).append(strHtml);
            }
            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
            function RemoveExerciseSection(sectionnumber,data){
                var dvsectionid= "dvsection_" +sectionnumber;
                jQuery("#" +dvsectionid + "_dvexcercise_" +data.id).remove();
            }
             
             function RemoveProgramSection(id)
            {
              debugger
              // document.getElementById(id).innerHTML="";
              // jQuery("#" +id).remove();
              
              var data = jQuery("#" +id+' select').attr('data');
              for(z = data; z <= ecnt; z++){
                var d = jQuery( "select[data$="+z+"]" ).attr('name' );
                var n = d[9];
                var final = parseInt(n) - 1;  
                jQuery( "select[data$="+z+"]" ).attr("name","excercise"+final+"[]" )
              }
              jQuery("#" +id).remove();
              cnt= cnt-1;
            }

            function cloneArray(aObject) {
              if (!aObject) {
                return aObject;
              }

              let v;
              let bObject = Array.isArray(aObject) ? [] : {};
              for (const k in aObject) {
                v = aObject[k];
                bObject[k] = (typeof v === "object") ? cloneArray(v) : v;
              }

              return bObject;
            }
          </script>
          </div>
    <?php  
    }
    ?>  
    
  </div>  
  <br>
   <button type="button" class="btn btn-default" onclick="AddProgramSection();" id="btn1">Add New Section</button>
      <button type="submit" name="insert" id="insert" class="btn btn-primary">Update</button>
    </form>
  </div>

  <?php
  if(isset($_POST['insert'])  )
  {
    echo "<pre>";
    print_r($_POST);

   //   exit;
    global $wpdb;
    $name=$_POST['name'];
     $time_section=time();
    $description=$_POST['description']; 
    $program_type=$_POST['program_type'];
    $_FILES['image']['name']= $time_section.'_'.$_FILES['image']['name'];
    $file_name=$_FILES['image']['name'] ? $_FILES['image']['name'] : $result1[0]->image;
    $count = $_POST['count'];
    $section = $_POST['Section'];
    $repeatation = $_POST['repeatation'];
    $sets = $_POST['sets'];
    $cnt =0;

    // delete program
    $table_name = $wpdb->prefix . 'program';
    $wpdb->delete(
            $table_name,
            array('id'=>$id)
        );
    
    // delete from program section
    $table_name1 = $wpdb->prefix . 'program_section';
    $wpdb->delete(
            $table_name1,
            array('program_id'=>$id)
        );

    // delete from prodram escer...
    $table_name2 = $wpdb->prefix . 'program_excercise';     
   $a= $wpdb->delete(
            $table_name2,
            array('program_id'=>$id)
        );
   //print_r($a) ;
  // exit;
      $wpdb->insert($table_name,
                  array(
                      'id' => $id,
                      'name' => $name,
                      'description' => $description,                  
                      'program_type' => $program_type,
                      'image' => $file_name,
                  )
              );
   
     $qry ="SELECT * FROM $table_name ORDER BY id DESC LIMIT 1";
     $result = $wpdb->get_results($qry);
      
     
    for ($x = 0; $x < count($section); $x++) {
     
    $wpdb->insert($table_name1,
                  array(
                      'section_name' => $section[$x],
                      'program_id' =>$id,
                  )
              );
     
       
        $qry1 ="SELECT * FROM $table_name1 ORDER BY id DESC LIMIT 1";
        $result1 = $wpdb->get_results($qry1);
        $excercise = $_POST['excercise'.$x];
        // echo "<br>--------------------------------<br>";
          echo "<pre>";
          echo '$_POST["excercise".$x]';
          print_r($_POST['excercise'.$x]);
          echo "sets =<pre>";
         print_r($sets);
         print_r($repeatation);
   //      echo "<br>countEx456 = ".count($excercise);
          echo "<br>";
         for ($i = 0; $i < count($excercise); $i++) {
            echo "sets[$cnt]=".$sets[$cnt];
          $wpdb->insert($table_name2,
                    array(
                        'program_section_id' => $result1[0]->id,
                        'excercise_id' =>$excercise[$i],
                        'sets'=>$sets[$cnt],
                        'repeatation'=>$repeatation[$cnt],
                        'program_id' =>$id,
                    )
                );
          $cnt=$cnt+1;
        }
   }
    
    
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $file_id = media_handle_upload( 'image', $post->ID );
        
        echo "<script>
          bootbox.alert({
              message:'Data Is Sucessfully Update!',
              size: 'small'
          });
         </script>";
         wp_redirect(admin_url('/admin.php?page=Program_Listing'));
    }
  }
