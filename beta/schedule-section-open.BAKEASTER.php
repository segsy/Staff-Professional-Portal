<?php 
include"nav.php";
$_d   = isset( $_GET['d'] ) ? escape_s($_GET['d']) : '';
$_c   = isset( $_GET['i'] ) ? escape_s($_GET['i']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';

?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                </div>
                <h4 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=substr($_n, 0, 40)?>..... Section Schedule
                </h4>
            </div>
        </div>
    </div>













    <div class="content animate-panel">

        <div class="row">

            <div class="col-md-10">

                <div class="font-bold m-b-sm">
                    SECTION LIST
                </div>


        <div class="hpanel">

              <div class="panel-body">            


<?php
$query = query("SELECT s.title, s.sort, s.id, s.status as s_exist, COUNT(l.id) AS count
FROM training_section AS s
LEFT JOIN training_lesson AS l ON s.id =l.section
WHERE s.course = '$_c'
GROUP BY s.id
ORDER BY s.sort");
if(mysqli_num_rows($query)){
?>
                        <div class="alert alert-info">
                        <strong>Information</strong>
                        <p>A list of sections in <?=$_n?> course, you can shedule it or remove it from scheduled sections, serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        </div><br>

                        <table class="table table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Lessons </th>
                                <th class="column-title">Status </th>
                                <th class="column-title">Action </th>
                              </tr>
                            </thead>

                            <tbody>


<?php
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $id    = $rows['id']; 
        $name    = $rows['title']; 
        $sort    = $rows['sort']; 
        $count    = $rows['count']; 
        $e_exist = $rows['s_exist']; 

        $e_done    = ($e_exist)?"<span class='label label-success'> <i class='fa fa-check-circle fa-lg'></i> Scheduled</span>":"<span class='label label-default'> <i class='fa fa-warning'></i> No Yet</span>";

        $action    = ($e_exist)?"<button data-course='$_c' data-id='$id' data-name='$name' data-status='$e_exist' data-style='zoom-out' class='btn-subscribe btn btn-outline btn-sm btn-warning ladda-button'> Remove Schedule</button>":"<button data-course='$_c' data-id='$id' data-name='$name' data-status='$e_exist' data-style='zoom-out' class='btn-subscribe btn btn-sm btn-info'> Schedule Now!</button>";
     ?>
                         
                   <tr>
                      <td><?="Section ".$sort.": ".$name?></td>
                      <td><?=$count?></td>
                      <td><?=$e_done?></td>
                      <td><?=$action?>
 </td>
                    </tr>
<?php } ?>
                        </tbody>
                      </table>
<?php } ?>

                </div>
               </div>











            </div>











        </div>

    </div>



       
        
        
        
<?php include"footer.php";?>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>

<!-- <script src="scripts/table-enrollment.js"></script>  -->

<script language="javascript">

  var cn = "<?=$_n?>";



$(document).ready(function(){
//alert('d');
var deleteContainer=$("output.delete");

$('button.btn-subscribe').on("click",function(){

  var i=$(this).data("id");
  var n=$(this).data("name");
  var t=$(this).data("status");
  var c=$(this).data("course");

var sttitle = (t == 0)?"You want to Schedule "+n+" Now?":"You want to remove "+n+" from "+cn+" schedules";
var sttext = (t == 0)?"Schedule Now!":"Remove From Scheduled Sections!";
var stcolor = (t == 0)?"#3E8BEA":"#DD6B55";
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
  var l = $( '.del'+i ).ladda();
            l.ladda( 'start' );

  var cf=$(".tr"+i);
  //alert(".picture"+i);//
    //if(confirm(' Are you sure you want to delete '+t+'? \n\n Note: these action can not be reverse')){
  var dataString='n='+n+'&c='+c+'&d='+i+'&s='+t+'&_a=schedule';
   console.log(dataString);
 //return false;


   $.ajax({
    type:"POST",
    url: 'lib/process-section.php',
   // url:"lib/process-course-subscription.php",
    data:dataString,
    cache:false,
    dataType: 'json',
    beforeSend:function(){cf.addClass('error');},
   success: function( json, textStatus ) {
   //console.log(json);
       if( json.error ) {
                    $(cf).removeClass("error").addClass('warning');
                   // Error messages
                    if( json.error.section ) {
                        swal("An Error Occured!", json.error.section, "error");
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