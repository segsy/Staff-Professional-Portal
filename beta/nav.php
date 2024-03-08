<?php
include("lib/config.php");
//print_r($_SESSION);

if(!isset($_SESSION['_access'])){
  header("Location:login.php?status=unauthorize");
  }
if(!isset($_SESSION['_q_user']['_log_type'])){
  header("Location:login.php?status=logtype_unauthorize");
  }

include("lib/common.php");
include("lib/function.php");


?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title> Continuous Professional Development Portal</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->
    <link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <?php
    $_ptype = isset($p_ty)?$p_ty:'';

    if($_ptype == 'course' || $_ptype == 'reply' || $_ptype == 'contact' ){ ?>
    <link rel="stylesheet" href="vendor/summernote/dist/summernote.css" />
    <link rel="stylesheet" href="vendor/summernote/dist/summernote-bs3.css" />

    <?php } ?>   

    <?php if($_ptype == 'questions'){ ?>
    <link rel="stylesheet" href="vendor/select2-3.5.2/select2.css" />
    <link rel="stylesheet" href="vendor/select2-bootstrap/select2-bootstrap.css" />
 <?php } ?>   

    <link rel="stylesheet" href="vendor/offcanvas/css/bootstrap.offcanvas.css"/>

    <!-- App styles 
        <link rel="stylesheet" type="text/css" href="//rawgit.com/johndyer/mediaelement/master/build/mediaelementplayer.min.css">
    -->
    <link rel="stylesheet" href="vendor/mediaelement/mediaelementplayer.min.css"/>

    <link rel="stylesheet" href="vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css" />

     <link rel="stylesheet" href="vendor/ladda/dist/ladda-themeless.min.css" />
     <link rel="stylesheet" href="vendor/ladda/dist/ladda-themeless.min.css" />
     <link rel="stylesheet" href="vendor/sweetalert/lib/sweet-alert.css" />
     <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/reset-office.css">

    <link href="vendor/contextmenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css" />


<style type="text/css">
    .hbreadcrumb{display: none !important;}
marquee > *{
letter-spacing: 0.4px;
}
.subheader {
    background-color: #fffacd;
    height: 30px;
    cursor: pointer;
    padding: 4px 10px;
    border-bottom: 1px solid gainsboro;
}
.subheader p, .subheader span{
   display:inline-block;
}
.subheader a {
    color: red;
    margin: 0 5px;
    font-weight: 500;
}
.subheader span.spacer{
   display:inline-block;
   margin-right:120px; 
}

#menu, .fixed-navbar #wrapper {
    top: 84px;
    box-shadow: inset 6px 0px 14px 0px rgba(0, 0, 0, 0.1);/*  */
}

</style>
</head>
<body class="fixed-navbar fixed-sidebar dashboard">

<!-- Simple splash screen
<div class="splash"> <div class="splash-title"><h1>Ask The President</h1><p>ask the president questions </p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>-->
<!--[if lt IE 7]>
    <link rel="stylesheet" href="vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" />
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Header -->
<div id="header">

    <div id="logo" class="light-version">
              <!-- <img class="logo" alt="Dwily" src="images/logo-color.png"> -->
                <span> <i class="pe pe-7s-study"></i>  Continuous Professional Development Portal</span>
    </div>
    <nav role="navigation">
            <button type="button" class="navbar-toggle offcanvas-toggle pull-left" data-toggle="offcanvas" data-target="#menu">
               <i class="fa fa-bars"></i>
            </button>       
             <div class="small-logo">
                  <span> <i class="pe pe-7s-study"></i> Continuous Professional Development Portal</span>
              <!-- <img class="logo" alt="Dwily" src="images/logo-color.png"> -->
        </div>



        <div class="navbar-left">

        </div>


        <div class="mobile-menu">

        </div>
        <div class="navbar-right">
             <ul class="nav navbar-nav nav-links">
                <li><a href="today.php"> <i class="pe pe-7s-alarm fa-lg"></i> Today's Lesson </a></li>
                <li><a href="terms-conditions.php"> <i class="pe pe-7s-attention fa-lg"></i> Terms & Conditions </a></li>
                <li><a href="contact.php"> <i class="pe pe-7s-mail fa-lg"></i> Contact Us </a></li>
               <li><a href="?logout">Logout </a></li>
                <li><a href="#"> </a></li>
            </ul>
        </div>
    </nav>


    <div class="clearfix"></div>
    <div class="subheader">
        <div class="row">
            <div class="col-md-12">
            <marquee behavior="scroll"onmouseover="this.stop();" onmouseout="this.start();" direction="left">
                <?php 
                $query = query("SELECT * FROM training_news");
                $ticker= '';
                while($rows=mysqli_fetch_array($query)){
                        $ticker = $rows['content']; 
                     ?>
                            <?=html_entity_decode($ticker)?> <span class="spacer"></span>

                <?php }/* */?>

            </marquee>
            </div>
        </div>
    </div>


</div>






<!-- Navigation -->
<aside class="navbar-offcanvas navbar-offcanvas-touch" id="menu">
    <div id="navigation">
  
        <div class="profile-picture">
           <?php if($_SESSION['_q_user']['_log_type'] == 'staff'){?>
           <div class="profile-picture-holder">
            <a href="dashboard.php">
                <img src="<?=$_SESSION['_q_user']['_img']?>" class="img-circle m-b img-responsive" alt="<?= $_SESSION['_q_user']['_title'].' '.$_SESSION['_q_user']['_fname'];?>">
            </a>
            </div>

            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase"><?= $_SESSION['_q_user']['_title'].' '.$_SESSION['_q_user']['_fname'];?></span>
                <div>
                    <h5 class="font-extra-bold m-b-xs m-t-sm text-info"> <?= $_SESSION['_q_user']['_deptname']?></h5>
                    <h4><span class="label label-primary"><?= $_SESSION['_q_user']['_rank'];?></span></h4>

                    <small class="text-muted "><strong><?= $_SESSION['_q_user']['_designation'];?></strong></small>
                    <br>
                </div>
            </div>
            <?php } ?>
        </div>
  <!--  -->
        <ul class="nav" id="side-menu">

           <?php if($_SESSION['_q_user']['_log_type'] == 'staff'){?>
            <li> <a href="dashboard.php"><span class="nav-label"> Dashboard</span></a></li>
            <li> <a href="today.php"><span class="nav-label"> Lesson For Today</span></a></li>
            <li> <a href="my-enrollment.php"><span class="nav-label"> My Enrolment</span></a></li>
            <li> <a href="all-course.php"><span class="nav-label"> All Courses</span></a></li>
            <li> <a href="?logout"> <span class="nav-label"> Logout</span></a></li>
            <?php } ?>

           <?php if($_SESSION['_q_user']['_log_type'] == 'manager'){?>
            <!-- <li> <a href="dashboard.php"><span class="nav-label"> Dashboard</span></a></li> -->
              <li> <a href="todays-report.php"> <span class="nav-label"> Today's Report</span></a></li>
          <li> <a href="schedule-sections.php"> Lesson Schedule </a></li>

            <li>
                <a href="#"><span class="nav-label">Assignment</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level" aria-expanded="true">
                    <li><a href="assignment-new.php"> New Assignment</a></li>
                    <li><a href="assignment-all.php">All Assignment</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">News Ticker</span><span class="nav-label label label-danger pull-right">New</span> </a>
                <ul class="nav nav-second-level" aria-expanded="true">
                    <li><a href="news-new.php"> Add News</a></li>
                    <li><a href="news-all.php">All News</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><span class="nav-label">Section</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level" aria-expanded="true">
                    <li><a href="course-sections.php"> New Section</a></li>
                    <li><a href="section-all.php">All Section</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">Lesson</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level" aria-expanded="true">
                    <li><a href="lesson-new.php"> New Lesson</a></li>
                    <li><a href="lesson-all.php">All Lesson</a></li>
                    <li><a href="schedule-section.php">Scheduled Lesson</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">Slides</span><span class="nav-label label label-danger pull-right">New</span> </a>
                <ul class="nav nav-second-level" aria-expanded="true">
                    <li><a href="slide-new.php"> New Slide</a></li>
                    <li><a href="slide-all.php">All Slide</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><span class="nav-label">Course</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level" aria-expanded="true">
                    <li><a href="course-categories.php"> Categories</a></li>
                    <li><a href="course-all.php">All Course</a></li>
                    <li><a href="course-new.php"> New Course</a></li>
                    <li> <a href="enroll-course.php"> Subscribe Course</span></a></li>
                </ul>
            </li>

            <li> <a href="?logout"> <span class="nav-label"> Logout</span></a></li>
            
          <?php } ?>
          <?php if($_SESSION['_q_user']['_log_type'] == 'records'){?>
           <!-- <li> <a href="#dashboard.php"><span class="nav-label"> Dashboard</span></a></li> -->

            <li> <a href="dept-staff.php"> Quick Dept Report <span class="nav-label label label-danger pull-right">New</span></a></li>
            <li> <a href="top-ten.php"> Top Ten <span class="nav-label label label-danger pull-right">New</span></a></li>
            <li> <a href="daily-report.php?day=<?=date('Y-m-d')?>"> Daily Report <span class="nav-label label label-danger pull-right">New</span></a></li>
            <li> <a href="staff-record.php"> Staff Record <span class="nav-label label label-danger pull-right">New</span></a></li>
            <li> <a href="all-enrolment.php"> <span class="nav-label"> Enrolment Record</span></a></li>
            <!-- <li> <a href="login-record.php"> <span class="nav-label"> Login Record</span></a></li> -->
            <li> <a href="course-overview.php"> <span class="nav-label"> Course Overview</span></a></li>
            <!-- <li> <a href="enroll-course.php"> <span class="nav-label"> Course Subscription</span></a></li> -->
            <li> <a href="dept-record.php"> <span class="nav-label"> Dept. Enrolment</span></a></li>

            <li> <a href="?logout"> <span class="nav-label"> Logout</span></a></li>
          <?php } ?>
        </ul>
    </div>
</aside>





