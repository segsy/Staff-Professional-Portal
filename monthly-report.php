<?php 

include("../lib/config.php");
//require_once('connect.php');

	    include"nav2.php";
/*if (!empty($_POST['from']) && !empty($_POST['to'])) {
   $from = $_POST['from'];
    $to  = $_POST['to'];*/
    /*$monthlyreport = query ("SELECT MONTHNAME(date) AS Month,title,lesson AS lessoninfo AND AS format_date from training_lesson LEFT JOIN training_course AS course_id= $id WHERE DATE(schedule) = CURDATE() AND date BETWEEN  '$from' AND '$to' AND course_id = $id GROUP BY c.title ");
     $count_monthlylesson_schedule =mysqli_num_rows ($monthlyreport);*/

$from = trim(mysqli_real_escape_string($dbCon,$_POST['from']));
$to = trim(mysqli_real_escape_string($dbCon,$_POST['to']));
$query_lesson_schedule = query("SELECT c.title AS c_title, l.lesson, l.title AS lessoninfo FROM training_lesson AS l LEFT JOIN training_course AS c on l.course_id = c.id  WHERE DATE(l.schedule) = '$_day' ORDER BY c.title");
$count_lesson_schedule= mysqli_num_rows($query_lesson_schedule);

$query_register = query("SELECT title, designation, CONCAT(firstname, ' ', lastname) AS fullname, deptname, DATE_FORMAT(date, '%b %e, %y - %l:%i %p') AS format_date FROM training_user WHERE DATE(date) = '$_day'   ORDER BY date DESC");
$count_register = mysqli_num_rows($query_register);

$query_login = query("SELECT u.title, u.designation, CONCAT(u.firstname, ' ', u.lastname) AS fullname, u.deptname, DATE_FORMAT(l.date, '%b %e, %y - %l:%i %p') AS format_date FROM training_login AS l
LEFT JOIN training_user AS u ON l.user = u.id
WHERE DATE(l.date) = '$_day'   ORDER BY l.date DESC");
$count_login= mysqli_num_rows($query_login);

$query_enrollment = query("SELECT *, c.title AS c_title, DATE_FORMAT(p.date, '%b %e, %y - %l:%i %p') AS format_date FROM training_program AS p
  LEFT JOIN training_course AS c ON p.course = c.id  LEFT JOIN training_user AS u ON p.user = u.id  WHERE DATE(p.date) = '$_day' ORDER BY p.date DESC");
$count_enrollment= mysqli_num_rows($query_enrollment);


$query_lesson_attended = query("SELECT * FROM training_record WHERE DATE(date) = '$_day' GROUP BY lesson");
$count_lesson_attended= mysqli_num_rows($query_lesson_attended);

$query_all_lesson_attendance = query("SELECT u.title AS u_title, CONCAT(u.firstname, ' ', u.lastname) AS fullname, u.deptname,
    c.title AS c_title, CONCAT('Lesson ', l.lesson, ' : ', l.title) AS lessoninfo, DATE_FORMAT(r.date, '%l:%i %p') AS format_date, l.duration, r.progress
     FROM training_record AS r
      LEFT JOIN training_course AS c ON r.course = c.id
      LEFT JOIN training_lesson AS l ON r.lesson = l.id
      LEFT JOIN training_user AS u ON r.user = u.id
    WHERE DATE(r.date) = '$_day'
       ORDER BY r.date DESC");
$count_all_lesson_attendance= mysqli_num_rows($query_all_lesson_attendance);




?>
<style type="text/css">
.modal-title {
    font-size: 24px;
    font-weight: 300;
}
.datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
    background: 0 0;
    color: gainsboro;
    cursor: default;
}

</style>
<!-- Main Wrapper date('Y', strtotime('0000-00-00 00:00:00')); -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <span class="text-info"><?=date('l, j F, Y', strtotime($from))  ?>      Till  <?=date('l, j F, Y', strtotime($to))?></span> Report
                   <button type="button" class="btn btn-primary2 pull-right" data-toggle="modal" data-target="#myModal"> <i class="pe pe-7s-date"></i> Choose A Date</button>


                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title"> <i class="pe pe-7s-date"></i> Pick A Date</h4>
                                    <!--<small class="font-bold">View report of a particular date.</small> -->
                                </div>
                                <div class="modal-body">
                                    <div id="datepicker" data-date="<?=$_day?>"></div>
                                    <input type="hidden" id="from" name="from" value="<?=$from?>" />
                                </div>
                                <div class="modal-body">
                                    <div id="datepicker2" data-date="<?=$to?>"></div>
                                    <input type="hidden" id="to" name="to" value="<?=$to?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"> <i class="pe pe-7s-close fa-lg"></i> Cancel</button>
                                    <button type="button" class="btn btn-info btn-sm" id="gotorecord" data-dismiss="modal"> <i class="pe pe-7s-graph3 fa-lg"></i> Go To Record</button>
                                </div>
                            </div>
                        </div>
                    </div>




                </h2>
            </div>
        </div>
    </div>




    <div class="content animate-panel">





<?php


// PIE CHART & PROGRESS BAR TABLE DATA
$query = query("SELECT COUNT(r.id) AS r_total, SUM(r.progress  = 'd' ) AS r_completed,  SUM(r.progress  != 'd' ) AS r_inprogress
 FROM training_record AS r
 WHERE DATE(date) = CURDATE()");
$_percent = 0;
if(mysqli_num_rows($query)){
  //echo(mysqli_num_rows($query));
while($rows=mysqli_fetch_array($query)){
        $p_total    = ($rows['r_total'])?$rows['r_total']:0; 
        $_completed = ($rows['r_completed'])?$rows['r_completed']:0; 
        $_inprogress  = ($rows['r_inprogress'])?$rows['r_inprogress']:0;
        $_aa = ($p_total)?$_completed/$p_total:0;
       // echo "_aa: $_aa, p_total: $p_total,  _completed: $_completed, _inprogress: $_inprogress ";
        //$_percent = number_format( ($_completed/$p_total) * 100, 1 ); // change 2 to # of decimals
        $_percent = number_format( $_aa * 100, 1 ); // change 2 to # of decimals
        // $_percent = ''; // change 2 to # of decimals

      }
}

      ?>

        <div class="row">
<!--
            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>PROGRESS CHART</h4>
                        </div>

                          <div class="flot-chart m-b-sm m-t-md">
                            <div class="flot-chart-content m-b-sm" id="flot-pie-chart" style="height: 150px"></div>
                         <div class="clearfix"></div>
                         </div>

                    </div>
                    <div class="panel-footer">
                        Progress diagram
                    </div>
                </div>
            </div>
-->




            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>LESSON ATTENDANCE</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-way fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="m-b-sm"><?=number_format($count_all_lesson_attendance)?></h3>
                              <span class="font-bold no-margins text-info">
                                  A total number of <?=number_format($count_lesson_attended)?> lessons/classes were attended with a total of <?=number_format($count_all_lesson_attendance)?> in attendance on CPDP today
                              </span><br>
                    </div>
                    </div>
                    <div class="panel-footer">
                        Based on lesson attendance sheet
                    </div>
                </div>
            </div>



            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>STAFFS LOGINS</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-lock fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="m-b-sm"><?=number_format($count_login)?></h3>
                              <span class="font-bold no-margins text-info">
                                  A total number of <?=number_format($count_login)?> staffs login to CPDP this month
                              </span><br>
                    </div>

                    </div>
                    <div class="panel-footer">
                        Based on staff login records
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="hpanel">
                    <div class="panel-body text-left h-200">
                            <div class="stats-title pull-left">
                            <h4>LESSON SCHEDULED</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-graph1 fa-4x"></i>
                        </div>                                            

                        <div class="m-t-xl">
                            <h3 class="m-b-sm"><?=number_format($count_lesson_schedule)?></h3>
                              <span class="font-bold no-margins text-info">
                                  A total number of <?=number_format($count_lesson_schedule)?> lessons were scheduled for this month
                              </span><br>
                    </div>
                    </div>
                    <div class="panel-footer">
                        Based on lesson scdeule records
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>ENROLMENT THIS MONTH</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-display2 fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="m-b-md"><?=number_format($count_enrollment)?></h3>
                            <span class="font-bold no-margins text-info">
                                  A total number of <?=number_format($count_enrollment)?> course enrolment on CPDP this month
                            </span>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Based on no of staffs enroled this month
                    </div>
                </div>
            </div>







        </div>













      
        <div class="row">

            <div class="col-md-12">







                <div class="font-bold m-b-md m-t-lg">
                    DATA SHEET
                </div>


        <div class="hpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-register"><i class="fa fa-lock"></i> Staff Register <span class="text-danger">(<?=$count_register?>)</span></a></li>
                <li><a data-toggle="tab" href="#tab-login"><i class="fa fa-lock"></i> Staff Login <span class="text-danger">(<?=$count_login?>)</span></a></li>
                <li><a data-toggle="tab" href="#tab-enrolment"><i class="fa fa-check"></i> Enrolment  <span class="text-danger">(<?=$count_enrollment?>)</span></a></li>
                <li><a data-toggle="tab" href="#tab-schedule"><i class="fa fa-check"></i> Lesson scheduled  <span class="text-danger">(<?=$count_lesson_schedule?>)</span></a></li>
                <li><a data-toggle="tab" href="#tab-attendance"><i class="fa fa-check"></i> Lesson Attendance  <span class="text-danger">(<?=$count_all_lesson_attendance?>)</span></a></li>
            </ul>

            <div class="tab-content">


                      <div id="tab-register" class="tab-pane active">
                          <div class="panel-body">

                                        <?php
                                        if($count_register){
                                        ?>

                                                  <table class="table table-striped table-bordered">
                                                      <thead>
                                                        <tr class="headings">
                                                          <th class="column-title">Title </th>
                                                          <th class="column-title">Name </th>
                                                          <th class="column-title">Department </th>
                                                          <th class="column-title">Course Enrolment</th>
                                                          <th class="column-title">Date </th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php
                                                            while($rows=mysqli_fetch_array($query_register)){
                                                                    $title        = $rows['title']; 
                                                                    $fullname    = $rows['fullname'];  
                                                                    $date    = $rows['format_date'];
                                                                    $designation    = $rows['designation'];
                                                                    $deptname    = $rows['deptname'];
                                                                 ?>
                                                                                <tr>
                                                                                  <td><?=changeTitle($title)?></td>
                                                                                  <td><?=$fullname?></td>
                                                                                  <td><?=abbrevDept($deptname)?></td>
                                                                                  <td><?=$designation?></td>
                                                                                  <td><?=$date?></td>
                                                                                </tr>
                                                            <?php } ?>
                                                  </tbody>
                                                </table>
                                              <?php }else{?>
                                                              <div class="font-bold fa-lg m-b-sm">
                                                                   Staff List
                                                              </div>
                                                              <div class="hpanel">
                                                                  <div class="panel-body">
                                                                  </div>
                                                              </div>
                                              <?php } ?>


                          </div>
                       </div>









                      <div id="tab-login" class="tab-pane">
                          <div class="panel-body">

                                        <?php
                                        if($count_login){
                                        ?>

                                                  <table class="table table-striped table-bordered">
                                                      <thead>
                                                        <tr class="headings">
                                                          <th class="column-title">Title </th>
                                                          <th class="column-title">Name </th>
                                                          <th class="column-title">Department </th>
                                                          <th class="column-title">Course Enrolment</th>
                                                          <th class="column-title">Date </th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php
                                                            while($rows=mysqli_fetch_array($query_login)){
                                                                    $title        = $rows['title']; 
                                                                    $fullname    = $rows['fullname'];  
                                                                    $date    = $rows['format_date'];
                                                                    $designation    = $rows['designation'];
                                                                    $deptname    = $rows['deptname'];
                                                                 ?>
                                                                                <tr>
                                                                                  <td><?=changeTitle($title)?></td>
                                                                                  <td><?=$fullname?></td>
                                                                                  <td><?=abbrevDept($deptname)?></td>
                                                                                  <td><?=$designation?></td>
                                                                                  <td><?=$date?></td>
                                                                                </tr>
                                                            <?php } ?>
                                                  </tbody>
                                                </table>
                                              <?php }else{?>
                                                              <div class="font-bold fa-lg m-b-sm">
                                                                   Staff List
                                                              </div>
                                                              <div class="hpanel">
                                                                  <div class="panel-body">
                                                                  </div>
                                                              </div>
                                              <?php } ?>


                          </div>
                       </div>




                      <div id="tab-enrolment" class="tab-pane">
                          <div class="panel-body">

                                      <?php
                                              if($count_enrollment){
                                              ?>
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                              <tr class="headings">
                                                                <th class="column-title">Title </th>
                                                                <th class="column-title">Name </th>
                                                                <th class="column-title">Department </th>
                                                                <th class="column-title">Course Enrolment</th>
                                                                <th class="column-title">Date </th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <?php
                                                                  while($rows=mysqli_fetch_array($query_enrollment)){
                                                                          $u_title        = $rows['title']; 
                                                                          $u_firstname    = $rows['firstname']; 
                                                                          $u_lastname     = $rows['lastname']; 
                                                                          $c_title       = $rows['c_title']; 
                                                                          $jobfamilyname  = $rows['jobfamilyname'];
                                                                          $date    = $rows['format_date'];
                                                                          $designation    = $rows['designation'];
                                                                          $deptname    = $rows['deptname'];
                                                                          $email    = $rows['email'];
                                                                       ?>
                                                                                      <tr>
                                                                                        <td><?=changeTitle($u_title)?></td>
                                                                                        <td><?=$u_firstname?> <?=$u_lastname?></td>
                                                                                        <td><?=abbrevDept($deptname)?></td>
                                                                                        <td><?=$c_title?></td>
                                                                                        <td><?=$date?></td>
                                                                                      </tr>
                                                                  <?php } ?>
                                                        </tbody>
                                                      </table>
                                                    <?php }else{?>
                                                                    <div class="font-bold fa-lg m-b-sm">
                                                                         Staff List
                                                                    </div>
                                                                    <div class="hpanel">
                                                                        <div class="panel-body">
                                                                        </div>
                                                                    </div>
                                                    <?php } ?>


                      </div>
                     </div>


                      <div id="tab-schedule" class="tab-pane">
                          <div class="panel-body">

                               <?php
                                            if($count_lesson_schedule){
                                            ?>
                                                      <table class="table table-striped table-bordered">
                                                          <thead>
                                                            <tr class="headings">
                                                              <th class="column-title">Course </th>
                                                              <th class="column-title">Lesson No </th>
                                                              <th class="column-title">Title </th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                                <?php
                                                                while($rows=mysqli_fetch_array($query_lesson_schedule)){
                                                                        $c_title        = $rows['c_title']; 
                                                                        $lessoninfo    = $rows['lessoninfo'];  
                                                                        $lesson    = $rows['lesson'];

                                                                     ?>
                                                                                    <tr>
                                                                                      <td><?=$c_title?></td>
                                                                                      <td>Lesson <?=$lesson?></td>
                                                                                      <td><?=$lessoninfo?></td>
                                                                                    </tr>
                                                                <?php } ?>
                                                      </tbody>
                                                    </table>
                                                  <?php }else{?>
                                                                  <div class="font-bold fa-lg m-b-sm">
                                                                       Staff List
                                                                  </div>
                                                                  <div class="hpanel">
                                                                      <div class="panel-body">
                                                                      </div>
                                                                  </div>
                                                  <?php } ?>


                      </div>
                     </div>


                      <div id="tab-attendance" class="tab-pane">
                          <div class="panel-body">



                                      <?php
                                      if($count_all_lesson_attendance){
                                      ?>

                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                      <tr class="headings">
                                                        <th class="column-title">Title </th>
                                                        <th class="column-title">Name </th>
                                                        <th class="column-title">Dept </th>
                                                        <th class="column-title">Lesson Attended </th>
                                                        <th class="column-title">Course</th>
                                                        <th class="column-title">Status </th>
                                                        <th class="column-title">Date </th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                          <?php
                                                          while($rows=mysqli_fetch_array($query_all_lesson_attendance)){
                                                                  $u_title        = $rows['u_title']; 
                                                                  $fullname    = $rows['fullname']; 
                                                                  $c_title       = $rows['c_title']; 
                                                                  $lessoninfo  = $rows['lessoninfo'];
                                                                  $date    = $rows['format_date'];
                                                                  $deptname    = $rows['deptname'];
                                                                  $progress    = $rows['progress'];
                                                                  $duration    = $rows['duration'];





                                                                  switch ($progress) {
                                                                    case 'd':
                                                                       $status = "<span class='label label-info'>completed<span>";
                                                                      break;
                                                                    
                                                                    default:
                                                                        $_duration   = str_replace(":", ".", $duration) * 60; 
                                                                        $percent = $progress/$_duration;
                                                                        $percent_friendly = number_format( $percent * 100); // change 2 to # of decimals
                                                                        $status = "<span class='label label-warning'>$percent_friendly% done<span>";
                                                                      break;
                                                                  }
                                                               ?>
                                                                              <tr>
                                                                                <td><?=changeTitle($u_title)?></td>
                                                                                <td><?=$fullname?></td>
                                                                                <td><?=abbrevDept($deptname)?></td>
                                                                                <td><?=$lessoninfo?></td>
                                                                                <td><?=$c_title?></td>
                                                                                <td><?=$status?></td>
                                                                                <td><?=$date?></td>
                                                                              </tr>
                                                          <?php } ?>
                                                </tbody>
                                              </table>

                                            <?php }else{?>
                                                            <div class="font-bold fa-lg m-b-sm">
                                                                 Staff List
                                                            </div>
                                                            <div class="hpanel">
                                                                <div class="panel-body">
                                                                </div>
                                                            </div>
                                            <?php } ?>


                      </div>
                     </div>









            </div>


        </div>

    </div>
</div>


       
        


       
        
        
        
<?php include"footer.php";?>
<script src="../vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="../vendor/ladda/dist/spin.min.js"></script>
<script src="../vendor/peity/jquery.peity.min.js"></script>
<script src="../vendor/ladda/dist/ladda.min.js"></script>
<script src="../vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="../vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script language="javascript">
$(function () {
  
            $('#datepicker').datepicker({startDate: '2017-04-18', format:'yyyy-mm-dd', zIndexOffset: 20, todayHighlight:true});

            $("#datepicker").on("changeDate", function(event) {
                $("#record_date").val(
                        $("#datepicker").datepicker('getFormattedDate')
                )
            });
    $('#datepicker2').datepicker({endDate: '2025-10-18', format:'yyyy-mm-dd', zIndexOffset: 20, todayHighlight:true});
    $("#datepicker2").on("changeDate", function(event) {
        $("#next_date").val(
            $("#datepicker2").datepicker('getFormattedDate')
        )
    });



    $("#gotorecord").click(function(event) {
              var gt = $("#record_date").val();
              var ft = $("#next_date").val();
             window.location = 'monthly-report.php?day?next='+gt+ft;
             //  console.log('daily-report.php?day='+gt);
              /* Act on the event */
            });




      $("span.pie").peity("pie", {
        fill: ["#62cb31", "#edf0f5"]
    });
});
</script>
<script src="../scripts/table-core.js"></script><!--   -->
