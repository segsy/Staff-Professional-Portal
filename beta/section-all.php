<?php 
$p_ty = 'section';

include"nav.php";

/*

ALTER TABLE `lwnm`.`training_course` ADD COLUMN `section` INT(2) NOT NULL DEFAULT 0 AFTER `date`;


DROP FUNCTION IF EXISTS alphas; 
DELIMITER | 
CREATE FUNCTION alphas( str CHAR(32) ) RETURNS CHAR(16) 
BEGIN 
  DECLARE i, len SMALLINT DEFAULT 1; 
  DECLARE ret CHAR(32) DEFAULT ''; 
  DECLARE c CHAR(1); 
  SET len = CHAR_LENGTH( str ); 
  REPEAT 
    BEGIN 
      SET c = MID( str, i, 1 ); 
      IF c REGEXP '[[:alpha:]]' THEN 
        SET ret=CONCAT(ret,c); 
      END IF; 
      SET i = i + 1; 
    END; 
  UNTIL i > len END REPEAT; 
  RETURN ret; 
END | 
DELIMITER ; 
UPDATE training_enrollment SET course = alphas(course); 

*/


?>
<style type="text/css">
  .form-group {
    margin-bottom: 5px;
}
</style>
<!-- Main Wrapper -->
<div id="wrapper">


    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                   <a class="btn btn-info btn-outline" href="course-sections.php"><i class="pe pe-7s-plus"></i> Create New Section</a>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-folder"></i> All Course Sections
                </h2>
            </div>
        </div>
    </div>


    <div class="content animate-panel">

        <div class="row">
            
            <div class="col-md-12">


                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Course</th><!--  -->
                                <th class="column-title">Lessons</th><!--  -->
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody class="categorybody">

<?php
$query = query("SELECT COUNT(l.id) AS l_total, c.title AS cs_title, ct.id AS c_id, ct.sort, ct.title AS c_title, ct.date AS c_date FROM training_section AS ct 
                LEFT JOIN $tbl_course AS c ON ct.course = c.id
                LEFT JOIN $tbl_lesson AS l ON ct.id = l.section
                GROUP BY ct.id  ORDER BY ct.date DESC");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $course_title      = $rows['cs_title'];; 
        $c_date        = $rows['c_date'];; 
        $sort        = $rows['sort'];
        $l_total        = $rows['l_total'];

     ?>

                    <tr class="cat<?=$c_id?>">
                      <td class="stitle<?=$c_id?>"><?=$sort?>: <?=$c_title?> </td>
                      <td><?=substr($course_title, 0, 75)?>...</td> 
                      <td><?=$l_total?></td> 
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <button data-id="<?=$c_id?>" data-name="<?=$c_title?>" class="del<?=$c_id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> </button>
                        <button data-sort="<?=$sort?>" data-id="<?=$c_id?>" data-course="<?=$course_title?>" data-name="<?=$c_title?>" class="edt<?=$c_id?> btn btn-outline btn-info btn-edit"> <i class="pe pe-7s-pen fa-lg"></i> Edit </button><!--  -->
                      </div> 
                      </td><!--   -->
                    </tr>

<?php } ?>

                         
                        </tbody>
                      </table>






                    </div>

                </div>
            </div>






                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="color-line"></div>

                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <span class="ask_title">Edit Course Section</span>
                                    </h4>
                                </div>
                                <div class="modal-body modal-slim">
                                  <form id="sectionform" class="category__form form-horizontal">

                                      <input name="_a" id="_a" type="hidden" value="edit"/>
                                      <input name="_i" id="_i" type="hidden"/>
                                          <div class="col-sm-12">
                                          <div class="form-group">
                                              <label class="col-sm-3 control-label text-left p-l-none">Name:</label>
                                              <div class="col-sm-9 p-l-none">
                                                  <input type="text" class="form-control input-sm" id="c_title" name="c_title" placeholder="Enter A Section Title" required>
                                              <span class="help-block text-danger"></span>
                                            </div>
                                          </div>
                                          </div>
                                          <div class="col-sm-12">
                                          <div class="form-group">
                                              <label class="col-sm-3 control-label text-left p-l-none">Course:</label>
                                              <div class="col-sm-9 p-l-none">
                                                  <p class="form-control-static" id="e_course"></p>
                                              <span class="help-block text-danger"></span>
                                            </div>
                                          </div>
                                          </div>

      

                                          <div class="col-sm-12">
                                          <div class="form-group">
                                              <label class="col-sm-3 control-label text-left p-l-none">Sort:</label>
                                              <div class="col-sm-9 p-l-none">
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




                            <button class="btn btn-info pull-right ladda-button" id="btn-submit" type="submit" data-style="expand-right"><i class="fa fa-check"></i> Submit</button>
                            </form>

                            <div class="clearfix"></div>






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

<!-- <script src="scripts/section.js"></script> -->


<script type="text/javascript">
    


$(document).ready(function(){
//alert('d');

$('body').on('click','button.btn-edit',function(){
      $("#_i").val('');
      $("#c_title").val('');
      var p=$(this);
      var i=p.data("id");
      var n=p.data("name");
      var s=p.data("sort");
      var c=p.data("course");
      var modal = $('#editmodal');
          modal.find('#_i').val(i);
          modal.find('#c_title').val(n);
          modal.find('#e_course').text(c);
          modal.find('select#_sort').val(s);
          modal.modal('show');
}); 






$('form#sectionform').on("submit",function(){

  var l = $( '#btn-submit' ).ladda();
 l.ladda( 'start' );

var _i = $("#_i").val();
var _a = $("#_a").val();
var _t = $("#c_title").val();
var _s = $("#_sort").val();

var _att = (_a == 'new')?"Section Created!":"Section Updated!";
  $.ajax({
            url: 'lib/process-section.php',
            type: 'POST',
            data: $('#sectionform input, #sectionform select'),
         //   data: $('#sectionform input[type=\'text\'], #sectionform textarea[name=\'c_code\']'),
          // data: $('#sectionform').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
    //  alert('preloader_it');
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
                                       $(".stitle"+_i).text(_t);
                                       $('#editmodal').modal('hide');
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

/*





*/


});

</script>