<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav.php";
?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="font-light m-b-xs">
                           <i class="pe pe-7s-alarm"></i> Lessons For Today
                        </h2>
                        <!-- <small>view and enroll for a course</small> -->
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <h4><span class="label label-primary"><?= $_SESSION['_q_user']['_jobfamilyname'];?> Professional Job Family</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="content animate-panel">


<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
                <div class="panel-tools">
                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    <a class="closebox"><i class="fa fa-times"></i></a>
                </div>
                Available Lesson
            </div>
            <div class="panel-body">

<?php
//$query = query("SELECT * FROM $tbl_lesson WHERE course_id='".$_c."' ORDER BY lesson ASC");

// ALTER TABLE `lwnm`.`training_lesson` ADD COLUMN `schedule` DATETIME NOT NULL DEFAULT 0 AFTER `section`;

$query = query("SELECT cs.title AS cstitle, cs.id AS csid, ls.id AS lsid, ls.lesson, ls.title, ls.duration, ls.type, ls.schedule FROM training_course AS cs
LEFT JOIN training_lesson AS ls ON cs.id = ls.course_id
LEFT JOIN training_program AS pr ON cs.id = pr.course
WHERE pr.user = '".$_SESSION['_q_user']['_id']."' AND ls.status='1' AND DATE(schedule) = DATE(NOW())");

/*
SELECT * FROM events WHERE event_date >= DATE(NOW())
SELECT * FROM events WHERE event_date >= DATE(CURRENT_TIMESTAMP)
SELECT * FROM events WHERE event_date >= CURRENT_DATE()
SELECT * FROM events WHERE event_date >= CURRDATE()
*/

/*
$query = query("SELECT s.id AS session, s.sort,  l.id, l.title, l.lesson, l.duration, l.type, r.progress, r.user,
IF(s.title IS NULL, 'others', s.title) AS session_name,
IF(r.user = '".$_SESSION['_q_user']['_id']."', TRUE, FALSE) AS r_exist
 FROM training_lesson AS l
 LEFT JOIN training_record AS r ON l.id = r.lesson AND (r.user='".$_SESSION['_q_user']['_id']."' OR r.user IS NULL)
 LEFT JOIN training_section AS s ON l.section = s.id
 WHERE course_id='".$_c."' AND s.status='1'
GROUP BY l.id 
ORDER BY s.sort, l.id");
*/
$num_rows = mysqli_num_rows($query);

if( $num_rows ){
    ?>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="40%">Course</th>
                        <th width="60%">Lesson</th>

                    </tr>
                    </thead>
                    <tbody>

    <?php
$current_cs = 'null';
$tpl ="";

while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $csid      = $rows['csid']; 
        $lsid      = $rows['lsid']; 
        $title     = $rows['title']; 
        $lesson    = $rows['lesson']; 
       // $sort    = $rows['sort'];; 
        //$session  = $rows['session'];; 
        //$session_name  = $rows['session_name'];; 
       $duration  = $rows['duration'];; 
        $type      = $rows['type']; 

        //$r_exist      = $rows['r_exist']; 

       // $r_done    = ($r_exist)?"<i class='fa fa-check-circle fa-lg text-info'></i>":"<i class='fa fa-circle fa-lg text-faint'></i>";
         $csl       = "course-details.php?id=$csid";
         $l         = "lessonsession.php?_l=$lsid&cs=$csid";
        $ad         = "assignment-details.php?_l=$lsid&cs=$csid";
        //$_dstatus  = ($isEnrolled)?"":" void";
       // $_rstatus  = ($r_exist)?" active":"";
       // $typestyle  = ($type == 'l')?"Lesson $lesson":"Assignment";
         $typeLink   = ($type == 'l')?$l:$ad;


  if ($csid != $current_cs) {
           $cstitle      = $rows['cstitle']; 
// $current_cat_name = $rows["session_name"];
      //$c_id = $rows["session"];

      if($current_cs == 'null'){

                echo "<tr>
                        <td><a href=\"$csl\">".(string)$cstitle."</a></td>
                        <td>
                                 <table cellpadding=\"1\" cellspacing=\"1\" class=\"table\">
                                    <thead>
                                    <tr>
                                        <th>Lesson</th>
                                        <th>Duration</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
      }else{
        echo "</tbody>
                    </table>
                        </td>
                    </tr>
                    <tr>
                        <td><a href=\"$csl\">".(string)$cstitle."</a></td>
                        <td>
                                 <table cellpadding=\"1\" cellspacing=\"1\" class=\"table\">
                                    <thead>
                                    <tr>
                                        <th>Lesson</th>
                                        <th>Duration</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
        }
    $current_cs = $csid;
  }
       echo '   <tr>
                    <td><a href="'.$typeLink.'"> <i class="pe pe-7s-link"></i> '.$title.'</a></td>
                    <td>'.$duration.'</td>
                </tr>';
} ?>


                    </tbody>
                </table>
</td>
                    </tr>
                   <!-- </div>
                    </div>
                    </div> Lessons comming soon -->
</tbody>
                    </table>

    </div> 
    <?php }else{?> 

 <div class="alert alert-info">
 <strong>No lesson has been schedule for today, please check back later </strong>
   </div>



<?php } ?>


            </div>
            <div class="panel-footer">
                <?=$num_rows?> lessons are available today
            </div>
        </div>
</div>





       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
