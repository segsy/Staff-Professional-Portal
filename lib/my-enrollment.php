<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav.php";
?>
<style type="text/css">
    .hpanel.hgreen .panel-body {
    min-height: 249px;
}
</style>
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
                   <i class="pe pe-7s-display2"></i> My Enrolment
                </h2>
                <small>View courses i enroled for</small>
            </div>
        </div>
    </div>



    <div class="content animate-panel">


        <div class="row projects">


<?php 

$query = query("SELECT c.id AS c_id, p.user AS p_user, p.progress AS p_progress, p.lesson AS p_lesson, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary,
COUNT(l.id) AS lessontotal FROM training_program AS p
LEFT JOIN training_course AS c ON p.course = c.id
LEFT JOIN training_lesson AS l ON p.course = l.course_id
WHERE p.user='".$_SESSION['_q_user']['_id']."'
GROUP BY c.id");
/* 
SELECT c.id AS c_id, p.user AS p_user, p.progress AS p_progress, p.lesson AS p_lesson, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary,
COUNT(l.id) AS lessontotal FROM training_program AS p
LEFT JOIN training_course AS c ON p.course = c.id
LEFT JOIN training_lesson AS l ON p.course = l.course_id
WHERE p.user='".$_SESSION['_q_user']['_id']."'
HAVING p.user='".$_SESSION['_q_user']['_id']."'

SELECT c.id AS c_id, p.user AS p_user, p.progress AS p_progress, p.lesson AS p_lesson, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary,
COUNT(l.id) AS lessontotal FROM training_program AS p
LEFT JOIN training_course AS c ON p.course = c.id
LEFT JOIN training_lesson AS l ON p.course = l.course_id
WHERE p.lesson IS NOT NULL
HAVING p_user='100338';


*/            
       if(mysqli_num_rows($query)){
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $c_summary    = $rows['c_summary'];; 
        $c_duration   = $rows['c_duration'];; 
        $p_progress   = $rows['p_progress'];; 
        $lessontotal  = $rows['lessontotal']; 
?>

            <div class="col-lg-6 m-t-lg">
                  <div class="font-bold m-b-sm">
                    CURRENT ENROLLMENTS 
                </div>
                <div class="hpanel hgreen">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h4><a href="course-details.php?id=<?=$c_id?>"><?=$c_title?></a></h4>
                                <p><?=substr($c_summary, 0, 102)?>... </p>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="project-label"><strong>Duration</strong></div>
                                        <small><?=$c_duration?></small>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="project-label"><strong>Lesson</strong></div>
                                        <small><?=$lessontotal?> Lessons</small>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4 project-info p-l-none">
                                <a href="course-details.php?id=<?=$c_id?>">
                                    <img src="upload/<?=$c_id?>.jpg" alt="<?=$c_title?>" class="img-responsive">
                                  </a>  
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer"><div class="row">
                           <div class="col-md-4"> <span>My Progress:</span> </div>
                           <div class="col-md-8">                       
                           <div class="progress m-t-xs full progress-small">
 
                            <div style="width: <?=$p_progress?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="12" role="progressbar" class=" progress-bar progress-bar-info">
                            </div>

                        </div></div>
                        </div>
                    </div>
                </div>
            </div>

<?php }}else{ ?>


    <div class="col-lg-6 col-md-offset-3">
                 <div class="font-bold m-b-sm">
                     
                </div>
               <div class="hpanel hgreen">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="m-b-lg">Welcome </h4>
                            <div class="alert alert-info">
                            Welcome to the enrollment page. this is where you are to view your enrolled courses. <br>
Click on the <strong>All courses</strong> menu link to select the course you will love to take and enroll.<br> we believe you will surely be equipped after taken these courses. thank you.                             
                            </div>

                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>

<?php }?>




    </div>


       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
