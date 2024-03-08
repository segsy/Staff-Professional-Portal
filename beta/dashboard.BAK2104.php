<?php 
include"nav.php";
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
                   <i class="pe pe-7s-display2"></i> My Course
                </h2>
                <small>view and continue your classes</small>
            </div>
        </div>
    </div>



    <div class="content animate-panel">

        <div class="row projects m-b-xl m-t-xl">

      <div class="col-lg-4">
             <div class="font-bold m-b-sm">
                     MY ACCOUNT
                </div>
        <div class="hpanel hgreen">
            <div class="panel-body">
                 <img src="<?=$_SESSION['_q_user']['_img']?>" class="img-circle m-b m-t-md img-responsive profile-pix" alt="<?= $_SESSION['_q_user']['_title'].' '.$_SESSION['_q_user']['_fname'];?>">
               <h3><a href=""><?= $_SESSION['_q_user']['_title'].' '.$_SESSION['_q_user']['_fname'].' '.$_SESSION['_q_user']['_lname'];?></a></h3>
                <div class="text-muted font-bold m-b-xs"><?= $_SESSION['_q_user']['_deptname']?></div>
                <div class="text-muted font-bold m-b-xs"><?= $_SESSION['_q_user']['_designation']?></div>
            </div>
            <div class="panel-footer contact-footer">
             <strong class="text-info"> <?=$_SESSION['_q_user']['_rank']?> (<?=$_SESSION['_q_user']['_jobfamilyname']?>) </strong>

                <!--                <div class="row">

                    <div class="col-md-4 border-right">
                        <div class="contact-stat"><span>Course: </span> <strong>0</strong></div>
                    </div>
                    <div class="col-md-4 border-right">
                        <div class="contact-stat"><span>Lectures: </span> <strong>0</strong></div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-stat"><span>Attended: </span> <strong>0</strong></div>
                    </div>
                </div>
                 -->   
            </div>

        </div>
    </div>

<?php 

$query = query("SELECT c.id AS c_id, p.progress AS p_progress, p.lesson AS p_lesson, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary
              FROM $tbl_program AS p
              LEFT JOIN $tbl_course AS c ON p.course = c.id
              WHERE user='".$_SESSION['_q_user']['_id']."'
              ");
       if(mysqli_num_rows($query)){
            while($rows=mysqli_fetch_array($query)){
             // print_r($rows);
                    $c_id         = $rows['c_id'];; 
                    $c_title      = $rows['c_title'];; 
                    $p_lesson     = $rows['p_lesson'];; 
                    $c_summary    = $rows['c_summary'];; 
                    $c_duration   = $rows['c_duration'];; 
                    $p_progress   = $rows['p_progress']; 
            }

?>

    <div class="col-lg-8">
                 <div class="font-bold m-b-sm">
                     LATEST ACTIVITY
                </div>
               <div class="hpanel hgreen">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h4><a href="course-details.php?id=<?=$c_id?>">Continue <?=$c_title?>?</a></h4>
                                <p><?=$c_summary?></p>



                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="project-label"><strong>Duration</strong></div>
                                        <small><?=$c_duration?></small>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="project-label"><strong>Lessons</strong></div>
                                        <small>15 Lessons</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="project-label"><strong>Your Progress</strong></div>
                                        <small><?=$p_progress?>%</small>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4 project-info p-l-none">
                                <div class="project-action m-t-md">
                                    <a class="btn btn-block btn-lg btn-success" href="course-details.php?id=<?=$c_id?>"> RESUME LESSON</a>
                                </div>
                                <div class="project-value">
                                    <h3 class="text-success">
                                        6 March 2017
                                    </h3>
                                </div>
                                <br>
                                <div class="project-people">
                                      <div class="project-label">YOUR PROGRESS</div>
                                        <div class="progress m-t-xs full progress-small">
                                            <div style="width: <?=$p_progress?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="12" role="progressbar" class=" progress-bar progress-bar-info">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Welcome Back, You can continue with your previous lesson.
                    </div>
                </div>
            </div>

<?php }else{ ?>



    <div class="col-lg-6 col-md-offset-1">
                 <div class="font-bold m-b-sm">
                     WELCOME
                </div>
               <div class="hpanel hgreen">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="alert alert-success">
                               <strong>About The Continuous Professional Development Program.</strong><BR>
The Continuous Professional Development Program is a distinct proficiency   online training platform for the various Job Families in the BLW Staff Community. It is a training organized to improve staff skills in the area of their job. This program would predominantly be accessed online and would track the development rate of the respective staff members.
                             
                            </div>

                            </div>

                            <div class="col-sm-12">
                                <h4 class="m-t-lg m-b-sm">HOW TO ENROLL</h4>
                            <div class="alert alert-info">
                               Kindly Click on <strong>ALL COURSES</strong> menu link by the left side of this page to select the course for your Job family and receive practical applicable knowledge for your job family.
                             
                            </div>

                            </div>


                        </div>
                    </div>

                </div>
            </div>

<?php } ?>

      </div>



        <div class="row projects">





    </div>


       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
