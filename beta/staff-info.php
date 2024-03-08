<?php 
include"nav.php";
$_i   = isset( $_GET['id'] ) ? escape_s($_GET['id']) : '';
//$_c   = isset( $_GET['c'] ) ? escape_s($_GET['c']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';



$query_staff = query("SELECT id, title, CONCAT(firstname, ' ', lastname) AS fullname, rank, deptname, designation, jobfamilyname, email,  maritalstatus, gender, nationality,img, DATE_FORMAT(date, '%b %e, %y - %l:%i %p') AS format_date FROM training_user WHERE id = '$_i'");
while($row=mysqli_fetch_array($query_staff)){

        $_title   =$row['title']; 
        $_email   =$row['email']; 
        $_fullname   =$row['fullname']; 
        $_deptname    =$row['deptname']; 
        $_format_date    =$row['format_date']; 
        $_jobfamilyname    =$row['jobfamilyname']; 
        $_img    =$row['img']; 
        $_designation    =$row['designation']; 
        $_rank    =$row['rank']; 
        $_maritalstatus    =$row['maritalstatus']; 
        $_gender    =$row['gender']; 
        $_nationality    =$row['nationality']; 
      }


$query_enrollment = query("SELECT c.title, duration, progress, lesson, 
  DATE_FORMAT(p.date, '%b %e, %y - %l:%i %p') AS format_date
FROM training_program AS p
  LEFT JOIN training_course AS c ON p.course = c.id
  WHERE p.user = '$_i'
  ORDER BY p.date DESC");
$count_enrollment= mysqli_num_rows($query_enrollment);


$query_lesson_attended = query("SELECT * FROM training_record WHERE user = '$_i'  ");
$count_lesson_attended= mysqli_num_rows($query_lesson_attended);






//$query_login_last = query("SELECT DATE_FORMAT(date, '%b %e, %Y <small><i class=pe-7s-clock></i> at %l:%i %p </small>') AS format_date,
$query_login_last = query("SELECT  DATE_FORMAT(date, '%b %e, %Y') AS format_day, DATE_FORMAT(date, '%l:%i %p') AS format_time,
TIMEDIFF(last, date) AS time_spent
FROM training_login WHERE user = '$_i'
ORDER BY date DESC
LIMIT 1");
  $time_spent = "0";$format_time = "No record";$format_day    ="No record";
while($row=mysqli_fetch_array($query_login_last)){
        $time_spent      = $row['time_spent']; 
       // $format_date    = $row['format_date']; 
        $format_day    = $row['format_day']; 
        $format_time    = $row['format_time']; 
      }


$query = query("SELECT  SUM(l.status = '1') AS less_scheduled, SUM(r.progress = 'd') AS less_completed FROM training_program t
 LEFT JOIN training_record r ON t.user = r.user
 LEFT JOIN training_lesson l ON t.course = l.course_id
WHERE t.user = '$_i' AND r.user = '$_i'
GROUP BY l.id
limit 1");
while($rows=mysqli_fetch_array($query)){
        $less_scheduled      = $rows['less_scheduled']; 
        $less_completed    = $rows['less_completed']; 
        $less_percent = number_format( ($less_completed/$less_scheduled) * 100, 2 ); // change 2 to # of decimals
      }


$query_fst_enrollment = query("SELECT DAYOFMONTH(p.date) AS f_day
FROM training_program AS p
  WHERE p.user = '$_i'
  ORDER BY p.date DESC
  LIMIT 1");
while($rows=mysqli_fetch_array($query_fst_enrollment)){
        $f_day      = $rows['f_day']; 
      }

/*
;
echo "$f_day";
*/
$query_all_lesson_attendance = query("SELECT c.title AS c_title, CONCAT('Lesson ', l.lesson, ' : ', l.title) AS lessoninfo, 
  DATE_FORMAT(r.date, '%b %e, %y @ %l:%i %p') AS format_date, l.duration, r.progress
     FROM training_record AS r
      LEFT JOIN training_course AS c ON r.course = c.id
      LEFT JOIN training_lesson AS l ON r.lesson = l.id
    WHERE r.user = '$_i'
       ORDER BY r.date DESC");
$count_all_lesson_attendance= mysqli_num_rows($query_all_lesson_attendance);



$line = 0;
/*
$dataset0 = array(
            0 => 0,
            1 => 0
       );
$dataset1 = array(
            0 => 0,
            1 => 0
       );
       */
$dataset1 = array();
$dataset0 = array();

$chartquery = query("SELECT COUNT(id) AS completed, DAYOFMONTH(r.date) AS date_day FROM training_record r
WHERE r.user = '$_i' AND progress = 'd'
GROUP BY DAY(date)");
/*
while($rows=mysqli_fetch_array($chartquery)){
        $line++;
        $date_day     = $rows['date_day']; 
        $date_name    = $rows['date_name'];
        $attendance   = $rows['attendance'];

        echo "$line : $attendance \n"; // change 2 to # of decimals
}
*/
    $dataset1[] = array( (int)$f_day, (int)2 );
    $dataset0[] = array( (int)$f_day, (int)0 );
while ($row = mysqli_fetch_assoc($chartquery)) { //or whatever
  $numb = $line++;
    $dataset1[] = array( (int)$row['date_day'], (int)$row['completed'] + 2 );
    $dataset0[] = array( (int)$row['date_day'], (int)$row['completed'] );
}
//print_r($dataset0);
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
                <h4 class="font-light m-b-xs">
                   <i class="pe pe-7s-user"></i> Staff Record
                </h4>
            </div>
        </div>
    </div>













    <div class="content animate-panel">

        <div class="row">



    <div class="col-lg-4">

                <div class="font-bold m-b-sm">
                    STAFF PROFILE
                </div>

        <div class="hpanel hgreen contact-panel">
            <div class="panel-body">
                <span class="label label-success pull-right"><?=$_rank?></span>
                <img alt="logo" class="img-circle m-b" src="<?=$_img?>">
                <h3><a href=""> <?=$_title?> <?=$_fullname?> </a></h3>
                <div class="text-muted font-bold m-b-xs m-t-sm"><?=$_designation?>, <?=$_jobfamilyname?></div>
                <div class="font-bold m-b-xs text-info"><?=$_deptname?> </div>
                 <p><?=$_email?></p>
               <!-- -->
            </div>
            <div class="panel-footer contact-footer">
                <div class="row">
                    <div class="col-md-4 border-right"> <div class="contact-stat"><span>Lesson: </span> <strong><?=$less_completed?></strong></div> </div>
                    <div class="col-md-4 border-right"> <div class="contact-stat"><span>Messages: </span> <strong>300</strong></div> </div>
                    <div class="col-md-4"> <div class="contact-stat"><span>Views: </span> <strong>400</strong></div> </div>
                </div>
            </div>
        </div>
    </div>



            <div class="col-md-8">

                <div class="font-bold m-b-sm">
                    ATTENDANCE CHART
                </div>

                <div class="hpanel">
                    <div class="panel-body">

                        <small>
                            daily staff attendance record
                        </small>



                        <div class="m-t-md">
                              <div class="flot-chart" style="height: 230px">
                                  <div class="flot-chart-content" id="flot-line-chart"></div>
                               </div>
                        </div>
                    </div>
                </div>


     </div>






        </div>





        <div class="row">

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
                            <h3 class="font-bold m-b-md text-info"><?=number_format($count_lesson_attended)?> Lessons</h3>
                              <span class="no-margins">
                                  Attended a total number of <?=number_format($count_lesson_attended)?> lessons/classes since user registered on the portal
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
                            <h4>LAST LOGIN</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-lock fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="font-bold m-b-md text-info"><?=$format_day?> <br><small><i class=pe-7s-clock></i> <?=$format_time?></small></h3>
                              <span class="no-margins">
                                  Spent a total time of <?=$time_spent?> on the portal
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
                            <h4>LESSON PROGRESS</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-graph1 fa-4x"></i>
                        </div>                                            

                        <div class="m-t-xl">
                            <h3 class="font-bold m-b-md text-info"><?=$less_percent?>%</h3>

                            <div class="progress m-t-xs full progress-small">
                                <div style="width: <?=$less_percent?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="55" role="progressbar" class=" progress-bar progress-bar-info">
                                    <span class="sr-only"><?=$less_percent?>% Complete (success)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stats-label">Completed</small>
                                    <h4><?=$less_completed?></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stats-label">Total Lesson</small>
                                    <h4><?=$less_scheduled?></h4>
                                </div>
                            </div>
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
                            <h4>COURSE ENROLMENT</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-display2 fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="font-bold m-b-md text-info"><?=number_format($count_enrollment)?> Course</h3>
                            <span class="no-margins">
                                  A total number of <?=number_format($count_enrollment)?> course enrolment on CPDP today
                            </span>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Based on no of staffs enroled today
                    </div>
                </div>
            </div>







        </div>


      
        <div class="row">



            <div class="col-lg-12">




                <div class="font-bold m-b-sm">
                    ENROLLMENT LIST
                </div>


        <div class="hpanel">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-check"></i> Enrolment  <span class="text-danger">(<?=$count_enrollment?>)</span></a></li>
              <li><a data-toggle="tab" href="#tab-attendance"><i class="fa fa-database"></i> Lesson Record  <span class="text-danger">(<?=$count_all_lesson_attendance?>)</span></a></li>
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">


                                      <?php
                                              if($count_enrollment){
                                              ?>
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                              <tr class="headings">
                                                                <th class="column-title">Course </th>
                                                                <th class="column-title">Total Lesson </th>
                                                                <th class="column-title">Duration </th>
                                                                <th class="column-title">Progress</th>
                                                                <th class="column-title">Date </th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <?php
                                                                  while($rows=mysqli_fetch_array($query_enrollment)){
                                                                          $title      = $rows['title']; 
                                                                          $duration    = $rows['duration']; 
                                                                          $lesson     = $rows['lesson']; 
                                                                          $date    = $rows['format_date'];
                                                                          $progress    = $rows['progress'];

                                                                  switch ($progress) {
                                                                    case 'd':
                                                                       $status = "<span class='label label-info'>completed<span>";
                                                                      break;
                                                                    
                                                                    default:
                                                                        $status = "<span class='label label-warning'>$progress% done<span>";
                                                                      break;
                                                                  }
                                                                                                                                         ?>
                                                                                      <tr>
                                                                                        <td><?=$title?></td>
                                                                                        <td><?=$lesson?></td>
                                                                                        <td><?=$duration?></td>
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



                      <div id="tab-attendance" class="tab-pane">
                          <div class="panel-body">



                                      <?php
                                      if($count_all_lesson_attendance){
                                      ?>

                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                      <tr class="headings">
                                                        <th class="column-title">Course</th>
                                                        <th class="column-title">Lesson Attended </th>
                                                        <th class="column-title">Status </th>
                                                        <th class="column-title">Date </th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                          <?php
                                                          while($rows=mysqli_fetch_array($query_all_lesson_attendance)){
                                                                  $c_title       = $rows['c_title']; 
                                                                  $lessoninfo    = $rows['lessoninfo'];
                                                                  $date         = $rows['format_date'];
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
                                                                                <td><?=$c_title?></td>
                                                                                <td><?=$lessoninfo?></td>
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
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>

<script src="vendor/peity/jquery.peity.min.js"></script>
<script src="vendor/jquery-flot/jquery.flot.js"></script>
<script src="vendor/jquery-flot/jquery.flot.resize.js"></script>
<script src="vendor/jquery.flot.spline/index.js"></script>

<!--  
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
 -->
<script src="vendor/highcharts/highcharts.js"></script>
<script src="vendor/highcharts/exporting.js"></script>
<script language="javascript">

$(function () {
  
      $("span.pie").peity("pie", {
        fill: ["#62cb31", "#edf0f5"]
    });

      var dataset1 = <?php echo json_encode($dataset1); ?>;
      var dataset0 = <?php echo json_encode($dataset0); ?>;

        /**
         * Flot charts data and options
         */
        //var data1 = [ [0, 55], [1, 48], [2, 40], [3, 36], [4, 40], [5, 60], [6, 50], [7, 51] ];
        //var data2 = [ [0, 56], [1, 49], [2, 41], [3, 38], [4, 46], [5, 67], [6, 57], [7, 59] ];
        var data1 = dataset0;
        var data2 = dataset1;

        var chartUsersOptions = {
            series: {
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
            },
            grid: {
                tickColor: "#f0f0f0",
                borderWidth: 1,
                borderColor: 'f0f0f0',
                color: '#6a6c6f'
            },
            colors: [ "#3E8BEA", "#efefef"],
        };

        $.plot($("#flot-line-chart"), [data1, data2], chartUsersOptions);


});
</script>