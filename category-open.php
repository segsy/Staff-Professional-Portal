<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav.php";
$_i   = isset( $_GET['i'] ) ? escape_s($_GET['i']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';

?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">
                            <span>Add A New COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=$_GET['n']?> Courses
                </h2>
                <small>view and manage all course</small>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


                <div class="font-bold fa-lg m-b-sm">
                     Curriculum
                </div>

                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Lesson </th>
                                <th class="column-title">Assign. </th>
                                <th class="column-title">Status </th>
                                <!--<th class="column-title">Date</th> -->
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php
/*
ALTER TABLE `lwnm`.`training_course` ADD COLUMN `status` INT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `category`;
*/
$query = query("SELECT c.id AS c_id, c.status AS c_status, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, DATE_FORMAT(c.date, '%a, %b %y') AS c_date, SUM(l.type  = 'l' ) AS lessontotal,  SUM(l.type  = 'a' ) AS assigtotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                WHERE c.category = '$_i'
                GROUP BY c.id");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];
        $c_title      = $rows['c_title']; 
        $c_status     = $rows['c_status']; 
        $c_duration   = str_replace('hours', 'hrs', strtolower($rows['c_duration']));//$rows['c_duration'];
        $c_date        = $rows['c_date'];; 
        $lessontotal   = ($rows['lessontotal'] !=null)?$rows['lessontotal']:0; 
        $assigtotal    = ($rows['assigtotal'] !=null)?$rows['assigtotal']:0; 

        $statusstyle    = ($c_status)?"<span class='label label-success'> <i class='fa fa-check-circle fa-lg'></i> Enabled</span>":"<span class='label label-warning'> <i class='fa fa-warning'></i> Disabled</span>";

        $statusaction  = ($c_status)?"<button data-id='$c_id' data-type='disable' data-name='$c_title' data-status='$c_status' data-style='zoom-out' class='status<?=$c_id?> btn-disable btn btn-outline btn-sm btn-warning ladda-button'>  <i class='pe pe-7s-power fa-lg'></i> Disable</button>":"<button data-id='$c_id' data-type='enable' data-name='$c_title' data-status='$c_status' data-style='zoom-out' class='status<?=$c_id?> btn-disable btn btn-outline btn-sm btn-warning ladda-button'>  <i class='pe pe-7s-sun fa-lg'></i> Enable</button>";

     ?>

                    <tr class="tr<?=$c_id?>">
                      <td><?=substr($c_title, 0, 60)?>....</td>
                      <td><?=$lessontotal?></td>
                      <td><?=$assigtotal?></td>
                      <td><?=$statusstyle?></td>
                      <!--<td><?=$c_date?></td> -->
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <button data-id="<?=$c_id?>" data-type="course" data-name="<?=$c_title?>" class="del<?=$c_id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> </button>
                        <a href="course-edit.php?i=<?=$c_id?>" data-c-name="<?=$c_title?>" class="btn btn-outline btn-info">
                        <i class="pe pe-7s-pen fa-lg"></i></a>
                        <?=$statusaction?>
                     <a href="course-assignment.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-success">
                        Assignm. </a>                     
                        <a href="course-open.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-primary2">
                        Lesson </a>                          
                        </div> 
                      </td><!--   -->
                    </tr>

<?php } ?>

                         
                        </tbody>
                      </table>






                    </div>

                </div>
            </div>




    </div>


       
        
        
        
<?php include"footer.php";?>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="scripts/table-core.js"></script><!--   -->




<script language="javascript">

  var cn = "<?=$_n?>";



$(document).ready(function(){
//alert('d');
var deleteContainer=$("output.delete");

$('button.btn-disable').on("click",function(){

  var i=$(this).data("id");
  var n=$(this).data("name");
  var s=$(this).data("status");
  var t=$(this).data("type");

var sttitle = (s == 0)?"You want to enable "+n:"You want to disable "+n;
var sttext = (s == 0)?"Enable!":"Disable!";
var stcolor = (s == 0)?"#3E8BEA":"#DD6B55";
                    swal({
                        title: "Are you sure?",
                        text: sttitle,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: stcolor,
                        confirmButtonText: sttext,
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {


 // var l = Ladda.create('.del'+i);
  var l = $( '.status'+i ).ladda();
            l.ladda( 'start' );

  var cf=$(".tr"+i);
  //alert(".picture"+i);//
    //if(confirm(' Are you sure you want to delete '+t+'? \n\n Note: these action can not be reverse')){
  var dataString='i='+i+'&s='+s+'&t='+t;
   console.log(dataString);
 //return false;


   $.ajax({
    type:"POST",
    url:"lib/process-course-status.php",
    data:dataString,
    cache:false,
    dataType: 'json',
    beforeSend:function(){cf.addClass('error');},
   success: function( json, textStatus ) {
   //console.log(json);
       if( json.error ) {
                    $(cf).removeClass("error").addClass('warning');
                   // Error messages
                    if( json.error.enroll ) {
                        swal("An Error Occured!", json.error.enroll, "error");
                    }
                }
      if( json.success ) {
            window.location.reload();
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