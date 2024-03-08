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
/*
SELECT c.id AS c_id, p.progress AS p_progress, p.lesson AS p_lesson, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary
              FROM $tbl_program AS p
              LEFT JOIN $tbl_course AS c ON p.course = c.id
              WHERE user='".$_SESSION['_q_user']['_id']."'
*/


$query = query("SELECT  l.id AS l_id, c.id AS c_id, l.title, l.duration, r.progress, r.lesson AS r_lesson, c.duration AS c_duration,
 c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary
              FROM training_record AS r
              LEFT JOIN training_course AS c ON r.course = c.id
              LEFT JOIN training_lesson AS l ON r.lesson = l.id
              WHERE user='".$_SESSION['_q_user']['_id']."' AND r.progress != 'd'
              ORDER BY r.start DESC
              LIMIT 1
              ");
       if(mysqli_num_rows($query)){
            while($rows=mysqli_fetch_array($query)){
             // print_r($rows);
                    $l_id         = $rows['l_id'];
                    $c_id         = $rows['c_id'];
                    $l_title      = $rows['title']; 
                    $c_title      = $rows['c_title']; 
                    $r_lesson     = $rows['r_lesson'];; 
                    $c_summary    = $rows['c_summary'];; 
                    $c_duration   = $rows['duration'];; 
                    $p_progress   = $rows['progress']; 

                    $_duration   = str_replace(":", ".", $c_duration) * 60; 

        $percent = $p_progress/$_duration;
        $percent_friendly = number_format( $percent * 100, 2 ); // change 2 to # of decimals

        $_stage = number_format( $p_progress/60, 2);
        $stage = str_replace(".", ":", $_stage );
        /*

                    echo"_stage $_stage <br>";
                    echo"stage $stage <br>";
                    echo"_duration $_duration <br>";
                    echo"p_progress $p_progress <br>";
                    echo"percent $percent <br>";
                    echo"percent_friendly $percent_friendly <br>";
                    */
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
                                <h4><a href="course-details.php?id=<?=$c_id?>"><?=$c_title?></a></h4>
                                <p><?=$c_summary?></p>



                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="project-label"><strong>Lesson Number</strong></div>
                                        <small> Lesson <?=$r_lesson?></small>
                                    </div>                                    
                                    <div class="col-sm-3 p-none">
                                        <div class="project-label"><strong>Lesson Duration</strong></div>
                                        <small><?=$c_duration?></small>
                                    </div>

                                    <div class="col-sm-4 p-r-none">
                                        <div class="project-label"><strong>Your Progress</strong></div>
                                        <small><?=$stage?> minutes</small>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4 project-info p-l-none">
                                <div class="project-action m-t-sm">
                                    <a class="btn btn-block btn-lg btn-success" href="lessonsession.php?play=resume&_l=<?=$l_id?>&cs=<?=$c_id?>"> RESUME LESSON</a>
                                </div>
                                <div class="project-value m-t-md">
                                    <h5 class="text-success" style="font-weight: normal;">
                                        <?=$l_title?>
                                    </h5>
                                </div>
                                <br>
                                <div class="project-people">
                                      <div class="project-label">YOUR LESSON PROGRESS</div>
                                        <div class="progress m-t-xs full progress-small">
                                            <div style="width: <?=$percent_friendly?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="12" role="progressbar" class=" progress-bar progress-bar-info">
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
