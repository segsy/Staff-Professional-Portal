<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav.php";
$_c  = isset($_GET['id'])?$_GET['id']:'';

 $isEnrolled = mysqli_num_rows(query("SELECT * FROM $tbl_program WHERE user='".$_SESSION['_q_user']['_id']."' AND course='$_c'"));
//echo "countdone $countdone";

$query = query("SELECT *, c.title AS c_title, c.summary AS c_summary, c.duration AS c_duration, c.description AS c_description, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id 
                WHERE c.id='".$_c."'");
while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $c_id            = $rows['id'];; 
        $c_title         = $rows['c_title'];; 
        $c_summary       = $rows['c_summary'];; 
        $c_duration      = $rows['c_duration'];; 
        $c_description   = $rows['c_description']; 
        $lessontotal   = ($rows['lessontotal'] > 0)?$rows['lessontotal'].' Lessons':'0 Lesson'; 
        }


?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li>
                            <span>Questions</span>
                        </li>
                        <li class="active">
                            <span>Inbox</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=$c_title?>
                </h2>
                <!-- <small>course information</small> -->
            </div>
        </div>
    </div>



    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-8">

                <div class="font-bold m-b-sm">
                     Course details
                </div>

                <div class="hpanel">
                    <div class="panel-body">

                        <h3 class="m-t-none">About the course </h3><br>
                        <?=$c_summary?><br>
                        <div class="article"><?=$c_description?></div>
                        



                        <div class="m-t-md">
                            <canvas id="lineOptions" height="60"></canvas>
                        </div>
                    </div>
                </div>


                <div class="font-bold fa-lg m-b-sm">
                     Curriculum
                </div>

                <div class="hpanel">

                    <div class="panel-body-removed">

<?php
//$query = query("SELECT * FROM $tbl_lesson WHERE course_id='".$_c."' ORDER BY lesson ASC");


$query = query("SELECT l.id, l.title, l.lesson, l.duration, l.type, r.progress, r.user, IF(r.user = '".$_SESSION['_q_user']['_id']."', TRUE, FALSE) as r_exist
FROM $tbl_lesson AS l
 LEFT JOIN $tbl_record AS r ON (l.id = r.lesson)
 WHERE l.course_id='".$_c."' AND (r.user='".$_SESSION['_q_user']['_id']."' OR r.user IS NULL)");


while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $id        = $rows['id'];; 
        $title     = $rows['title'];; 
        $lesson    = $rows['lesson'];; 
        $duration  = $rows['duration'];; 
        $type      = $rows['type']; 

        $r_exist      = $rows['r_exist']; 

        $r_done    = ($r_exist)?"<i class='fa fa-check-circle fa-lg text-info'></i>":"<i class='fa fa-circle fa-lg text-faint'></i>";
        $l         = ($isEnrolled)?"lessonsession.php?_l=$id&cs=$_c":"#";
        $ad        = ($isEnrolled)?"assignment-details.php?_l=$id&cs=$_c":"#";
        $_dstatus  = ($isEnrolled)?"":" void";
        $_rstatus  = ($r_exist)?" active":"";
        $typestyle  = ($type == 'l')?"Lesson $lesson":"Assignment";
        $typeLink   = ($type == 'l')?$l:$ad;

 ?>

                    <div class="hpanel filter-item<?=$_dstatus?><?=$_rstatus?>">
                        <a href="<?=$typeLink?>">
                            <div class="panel-body">
                                <div class="pull-right text-right">
                                    <h4><i class="pe pe-7s-clock fa-lg text-info"></i> <?=$duration?> <!-- -->
                                     </h4>
                                </div>
                                <h4 class="m-b-xs"><span class="col-md-2 text-left p-l-none"><?=$r_done?>  <?=$typestyle?>:</span> <?=$title?></h4>
                          </div>
                        </a>
                    </div>
<?php } ?>







                    </div>

                </div>
            </div>
            <div class="col-md-4">

                <div class="font-bold m-b-sm">
                     Details
                </div>

                <div class="hpanel stats">
                    <div class="panel-body">

                        <div>
                            <i class="pe-7s-display2 fa-4x"></i> 
                            <h1 class="m-xs text-success"><?=date('d F Y')?></h1>
                        </div>

                        <p>
                            <strong>Course</strong> will be available daily from 9pm for a week.
                        </p>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Lectures</small>
                                    <h4><?=$lessontotal?> <i class="pe pe-7s-culture text-success"></i></h4>
                                </div>
                                <div class="col-xs-6">
                                    <small class="stat-label">Duraton</small>
                                    <h4><?=$c_duration?> <i class="pe pe-7s-clock text-success"></i></h4>
                                </div>
                            </div>
                        </div>
                </div>

<?php  // add option to resume if it has started already
if(!$isEnrolled){
?>
                <div class="row">
                    <div class="col-md-12">


                        <div class="hpanel">
                            <div class="panel-body">
                                  <p class="small">Enrol now by clicking the enroll botton below and join other participants.</p>

                            <button class="btn btn-info btn-block btn-lg ladda-button" data-cs="<?=$_c?>"  data-style="expand-right"> <i class="pe pe-7s-notebook"></i> Enroll Now</button>


                        </div>

                    </div>
                </div>

            </div>
<?php } ?>





        </div>







    </div>


       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="vendor/readmore/readmore.min.js"></script>
<script src="scripts/enroll.js"></script>

 <script type="text/javascript">
$(document).ready(function(){
$('.article').readmore({
  speed: 400,
  moreLink: '<a href="#" class="article-readmore text-info m-t-md pull-right"><i class="pe pe-7s-more"></i> Full Details</a>',
  lessLink: '<a href="#" class="article-readmore text-info m-t-md pull-right"><i class="pe pe-7s-more"></i> Less Details</a>'
});
});
</script>
