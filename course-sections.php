<?php 

$p_ty = 'section';


include("lib/config.php");

include("nav-all.php");
// include"nav.php";



/*



ALTER TABLE `lwnm`.`training_course` ADD COLUMN `section` INT(2) NOT NULL DEFAULT 0 AFTER `date`;

*/





?>

<style type="text/css">

  .checkbox label {

    font-size: 12px;

    line-height: 17px;

    padding-left: 10px;

}



</style>

<!-- Main Wrapper -->

<div id="wrapper">





    <div class="small-header transition animated fadeIn">

        <div class="hpanel">

            <div class="panel-body">

                <div id="hbreadcrumb" class="pull-right">

                </div>

                <h2 class="font-light m-b-xs">

                   <i class="pe pe-7s-folder"></i> Course Sections

                </h2>

            </div>

        </div>

    </div>





    <div class="content animate-panel">



        <div class="row">





            <div class="col-md-6 section-form-holder">

                <div class="hpanel email-compose">

                    <div class="panel-heading hbuilt">

                        <div class="p-xs h4 section-header">

                            New Section Form

                        </div>

                    </div>

                        <output id="form_message" class="form" style="padding: 0"></output>                    

                   <form id="sectionform" class="category__form form-horizontal">

                    <div class="panel-body">

                        <div class="p-xs">

                            <input name="_a" id="_a" type="hidden" value="new"/>

                            <input name="_h" id="_h" type="hidden" value="new"/>

                               <div class="col-sm-12">

                                <div class="form-group">

                                    <label class="col-sm-2 control-label text-left p-l-none">Name:</label>

                                    <div class="col-sm-10">

                                        <input type="text" class="form-control input-sm" id="c_title" name="c_title" placeholder="Enter A Section Title" required>



                                    <span class="help-block text-danger"></span>

                                  </div>

                                </div>

                                </div>

                                <div class="col-sm-12">

                                <div class="form-group">

                                    <label class="col-sm-2 control-label text-left p-l-none">Sort No:</label>

                                    <div class="col-sm-10">

                                    <?php

                                            $end = 25;

                                            echo '<select class="form-control input-sm" name="_sort" id="_sort" required>';

                                            for($i = 1; $i <= $end; $i++){

                                                echo "<option value='$i'> Section {$i}</option>";

                                            }

                                            echo '</select>';?>

                                    <span class="help-block text-danger"></span>

                                  </div>

                                </div>

                                </div>



                                <div class="col-sm-12">

                                <div class="form-group">

                                    <label class="col-sm-2 control-label text-left p-l-none">Course:</label>

                                    <div class="col-sm-10">

                                        <select class="form-control input-sm" name="_course" id="_course" required>

                                                 <?php echo getAllCourse();?>                        

                                          </select> 

                                    <span class="help-block text-danger"></span>

                                  </div>

                                </div>

                                </div>











                        </div>

                    </div>



                    <div class="panel-footer">

                        <div class="col-md-4 pull-right">

                            <button class="btn btn-info pull-right ladda-button" id="btn-submit"  data-style="expand-right"><i class="fa fa-check"></i> Submit</button>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                  </form>

                </div>

            </div>













            <div class="col-md-6 category-form-holder">

                <div class="hpanel email-compose">

                    <div class="panel-body" style="max-height: 400px; overflow-y: scroll;">

                        <div class="p-xs">



                                <div class="col-sm-12">

                                <div class="form-group">

                                    <label class="col-sm-4 control-label text-left p-l-none">Lesson list:</label>

                                    <div class="col-sm-12" id="lesson-holder">

                                  </div>

                                </div>

                                </div>

                        </div>

                    </div>

                    <div class="panel-footer">

                        <div class="clearfix"></div>

                    </div>

                  </form>

                </div>

            </div>











        </div>



    </div>







</div>



       

        

        

        <!-- /page content -->

<?php include"footer.php";?>

<script src="vendor/ladda/dist/spin.min.js"></script>

<script src="vendor/ladda/dist/ladda.min.js"></script>

<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>

<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>

<script src="vendor/summernote/dist/summernote.min.js"></script>



<!-- <script src="scripts/section.js"></script> -->





<script type="text/javascript">

    





$(document).ready(function(){

//alert('d');



<?php



$query = query("SELECT  c.id AS c_id, c.title AS c_title, l.id AS lessid, l.title AS lessons, l.lesson AS lesson_no FROM training_course AS c

LEFT JOIN training_lesson AS l ON c.id = l.course_id

GROUP BY l.id

ORDER BY c.id, l.lesson");

$javascript ="";

$current_cat = 'null';

while ($row = mysqli_fetch_array($query)) {

    $lesson_no = $row["lesson_no"];



  if ($row["c_id"] != $current_cat) {

    $current_cat_name = $row["c_title"];

      $c_id = $row["c_id"];

      if($current_cat == 'null'){

        $javascript .= "\nvar ".(string)$c_id." = [\n";

      }else{

        $javascript .= "];\n\nvar ".(string)$c_id." = [\n";

      }

    $current_cat = $c_id;

  }

        $javascript .= ' {display: "Less. '.$lesson_no.': '.$row["lessons"].'", value: "'.$row["lessid"].'"},';

}

        $javascript .= "];";





echo str_replace("},];", "}];", $javascript);

?>



/*

$("input[name=lesson]").on('chec, '.selector', function(event) {

  event.preventDefault();

});

*/





$("#_course").change(function() {

    var parent = $(this).val(); 

   console.log(parent);

switch(parent){ 

<?php

  $query = query("SELECT  id, title FROM training_course");

    while ($row = mysqli_fetch_array($query)) {

          $id = $row["id"];

          $title = $row["title"];

          echo "case '$id':

             list($id);

            break;\n";

        }

        ?> 

        default:

             $("#lesson-holder").html('');  

            break;

           }

               /*   list(parent);*/

});

//function to populate child select box

function list(array_list)

{

  console.log(array_list);

    $("#lesson-holder").html(""); //reset child options

    $(array_list).each(function (i) { //populate child options 

var _checkbox =  "<div class='checkbox'><label><input type='checkbox' name='lesson' value='"+array_list[i].value+"'>"+array_list[i].display+"</label></div>";        

    $("#lesson-holder").append(_checkbox);

    });

}



























function resettable(){

 $("table tr").removeClass('animated pulse');

 $("table tr").removeClass('animated bounce');

}



var cfh=$(".section-form-holder");









$('form#sectionform').on("submit",function(){



var _checked = $("input:checked").map(function() {

  return $(this).val();

 }).get().join();

 $(this).find("input[name=_h]").val(_checked);





/*

var products = $("input:checked",this).map(function() {

  return $(this).val();

 }).get().join();

 $(this).find("input[name=_h]").val(products);

 */



  var l = $( '#btn-submit' ).ladda();

 l.ladda( 'start' );



var _a = $("#_a").val();

var _t = $("#c_title").val();



var _att = (_a == 'new')?"Section Created!":"Section Updated!";

  $.ajax({

            url: 'lib/process-section.php',

            type: 'POST',

            data: $('#sectionform input[type=\'hidden\'], #sectionform input[type=\'text\'], #sectionform select'),

         //   data: $('#sectionform input[type=\'text\'], #sectionform textarea[name=\'c_code\']'),

          // data: $('#sectionform').serialize(),

            dataType: 'json',

            beforeSend: function (XMLHttpRequest) {

    //  alert('preloader_it');

                //preloader_it();

                $('#sectionform').fadeTo("slow", 0.33);

                $('#sectionform .has-error').removeClass('has-error');

                $('#sectionform .help-block').html('');

                $('#form_message').removeClass('alert-success').html('');

            },

            success: function( json, textStatus ) {

                if( json.error ) {

                 // Error messages

                    swal("Form Error", "kindly confirm that all fields are correct", "error");



                    if( json.error.title ) {

                        $('#sectionform input[name="c_title"]').parent().addClass('has-error');

                        $('#sectionform input[name="c_title"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.title );

                    }



                   if( json.error.section ) {

                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.section + '</div>');

                    }

                }



                if( json.success ) {

                                swal({

                                        title: _att,

                                        text: "",

                                        type: "success"

                                    },

                                    function () {

                                        if(_a == 'new'){

                                        $('#sectionform')[0].reset();

                                            $("tbody.categorybody").prepend(json.trdata);                                         

                                            $("tr.cat"+json.new_id).addClass('animated bounce');



                                            setTimeout(resettable, 1 * 1000);

                                        }else{

                                            

                                            $("tr.cat"+_a).addClass('animated pulse');

                                            $("tr.cat"+_a+" td.tdcourse").text(_t);

                                            $("button.del"+_a).data('name',_t);

                                            $("button.edt"+_a).data('name',_t);



                                            setTimeout(resettable, 1 * 1000);

                                            

                                        }

                                        

                                       // $(".note-editable").html(' ');

                                    });

                }

                

            },

        complete: function( XMLHttpRequest, textStatus ) {

               l.ladda('stop');

            $('#sectionform').fadeTo("fast", 1);

        }

        });

        



  return false;

});























var deleteContainer=$("output.delete");

//$('button.btn-delete').on("click",function(){



$('body').on('click','button.btn-delete', function(){



  var i=$(this).data("id");

  var n=$(this).data("name");



                    swal({

                        title: "Are you sure?",

                        text: "Your will not be able to recover "+n,

                        type: "warning",

                        showCancelButton: true,

                        confirmButtonColor: "#DD6B55",

                        confirmButtonText: "Yes, delete it!",

                        cancelButtonText: "No, cancel it!",

                        closeOnConfirm: true,

                        closeOnCancel: true },

                    function (isConfirm) {

                        if (isConfirm) {





 // var l = Ladda.create('.del'+i);

  var l = $( '.del'+i ).ladda();

            l.ladda( 'start' );



  var cf=$(".cat"+i);

  //alert(".picture"+i);//

    //if(confirm(' Are you sure you want to delete '+t+'? \n\n Note: these action can not be reverse')){

  var dataString='n='+n+'&i='+i+'&_a=delete';

   console.log(dataString);

 //return false;





   $.ajax({

    type:"POST",

    url:"lib/process-section.php",

    data:dataString,

    cache:false,

    dataType: 'json',

    beforeSend:function(){cf.addClass('error');},

   success: function( json, textStatus ) {

   //console.log(json);

       if( json.error ) {

                    $(cf).removeClass("error").addClass('warning');

                   // Error messages

                    if( json.error.delete ) {

                        swal("An Error Occured!", json.error.delete, "error");

                    }

                }

      if( json.success ) {

           //alert('successxxxxx');

                           $(cf).addClass('animated hinge').delay(850).fadeOut('slow');

               swal({

                        title: "Deleted!",

                        text: "Section has been deleted.",

                        type: "success",

                    },

                    function () {

                    });

               }



    },

    complete: function( XMLHttpRequest, textStatus ) {

                    l.ladda('stop');

                 }

    });





  }

}

);



  return false;

});









});



</script>