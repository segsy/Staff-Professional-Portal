<?php 
include"nav.php";
$_l  = isset($_GET['_l'])?escape_s($_GET['_l']):'';
$cs  = isset($_GET['cs'])?escape_s($_GET['cs']):'';
 $isEnrolled = mysqli_num_rows(query("SELECT * FROM $tbl_program WHERE user='".$_SESSION['_q_user']['_id']."' AND course='$cs'"));
 echo ($isEnrolled)?"":"<script>window.location='course-details.php?id=$cs'</script>";

  $course_enabled = mysqli_num_rows(query("SELECT * FROM $tbl_course WHERE id='".$cs."' AND status='1'"));
if(!$course_enabled){echo "<script>window.location='all-course.php'</script>";}

//echo "course_enabled $course_enabled";


$query = query("SELECT * FROM $tbl_lesson WHERE status = '1' AND id = '".$_l."' ");
if(!mysqli_num_rows($query)){
 echo "<script>window.location='course-details.php?id=$cs'</script>";
 die();
}
while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/
        $title     = $rows['title'];; 
        $lesson    = $rows['lesson'];; 
        $duration  = $rows['duration'];; 
        $type      = $rows['type']; 
        $path      = $rows['path']; 
        $poster    = $rows['poster']; 
        $summary    = $rows['summary']; 
        $pathreplace  = str_replace("dropbox.com", "dl.dropboxusercontent.com", $path); 
        $pathreplace  = str_replace("www.", "", $pathreplace); 
}


 $resume_query = query("SELECT progress FROM training_record WHERE user='".$_SESSION['_q_user']['_id']."' AND lesson='$_l' AND course='$cs' AND progress !='done'");
      if(mysqli_num_rows($resume_query) > 0){ 
      while($row=mysqli_fetch_array($resume_query)){
        $_progress = isset($row['progress'])?$row['progress']:false;
        echo ($_progress)?"<script> var savedTime = $_progress</script>":"";
      }
  }else{
         echo "<script> var savedTime = false;</script>";
 }


 $prev_post = query("SELECT id AS prev_id FROM $tbl_lesson WHERE status = '1' AND  id < '$_l' AND course_id = '$cs' ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($prev_post) > 0){ 
      while($ind=mysqli_fetch_array($prev_post)){
        $prev_id = isset($ind['prev_id'])?$ind['prev_id']:false;
        echo ($prev_id)?"<script> var _pv = 'lessonsession.php?_l=$prev_id&cs=$cs'</script>":'';
               $prev_q_id = ($prev_id)?"<a href='lessonsession.php?_l=".$prev_id."&cs=".$cs."' class='pull-left btn btn-sm btn-info disable'> <i class='fa fa-chevron-left'></i> Prev </a>":"<a href='#' class='pull-left btn btn-sm btn-info disable'><i class='fa fa-chevron-left'></i> Prev </a>";
      }
  }else{
                   $prev_q_id = "<a href='#' class='pull-left btn btn-default btn-sm' disabled='disabled'><i class='fa fa-chevron-left'></i> Prev </a>";
         echo "<script> var _pv = false;</script>";
 }



 $next_post = query("SELECT id AS next_id FROM $tbl_lesson WHERE  status = '1' AND id > '$_l' AND course_id = '$cs' ORDER BY id LIMIT 1");
      if(mysqli_num_rows($next_post) > 0){ 
      while($ind=mysqli_fetch_array($next_post)){
       $next_id = isset($ind['next_id'])?$ind['next_id']:false;
        echo ($next_id)?"<script> var _nx = 'lessonsession.php?_l=$next_id&cs=$cs'</script>":'';
               $next_q_id = ($next_id)?"<a href='lessonsession.php?_l=".$next_id."&cs=".$cs."' class='btn btn-sm btn-info pull-right'> Next <i class='fa fa-chevron-right'></i> </a>":"<a href='#' class='btn btn-sm btn-info pull-right'> Next <i class='fa fa-chevron-right'></i> </a>";
      }
  }else{
               $next_q_id = "<a href='#' class='btn btn-default btn-sm pull-right' disabled='disabled'> Next <i class='fa fa-chevron-right'></i> </a>";
              echo "<script> var _nx = false;</script>";
 }
?>
<style type="text/css">
.filter-item.disabled .panel-body {
    background-color: beige; /*beige;*/
        cursor: no-drop;
}
.progress {
    height: 15px;
    border-radius: 10px;
}
.progress-bar {
    background-color: deeppink;
    color: #fff;
    font-size: 9px;
    line-height: 14px;
    font-weight: bold;
}
iframe #ChromelessStatusBar.Options-Small14, iframe #ChromelessStatusBar.RightDock {
  display: none;
}

.cui-toolbar-buttondock.alignright {
  display: none;

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
                <h2 class="font-light m-b-xs text-center">
                   <?=$prev_q_id?> <i class="pe pe-7s-display2 fa-lg text-danger"></i> Slide: <?=$title?> <?=$next_q_id?>
                </h2>
                <!-- <small>course information</small> -->
            </div>
        </div>
    </div>


    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-9">

                <div class="hpanel">
                    <div class="panel-body">
                                                <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9" >
                              <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?=$pathreplace?>' width='100%' height='600px' frameborder='0' id='slidecontainer'></iframe>
                            </div>

                          

                    </div>
                </div>


               <div class="font-bold m-b-sm">
                     About Lesson
                </div>

                <div class="hpanel">
                    <div class="panel-body">
                    <?=$summary?>
                    </div>
                </div>

<?php
 $next_post = query("SELECT * FROM $tbl_lesson WHERE course_id='$cs' AND id > '$_l' ORDER BY lesson ASC");
//echo"$count";
      if(mysqli_num_rows($next_post) > 0){ 
        ?>
               <div class="font-bold m-b-sm">
                     Next Lesson
                </div>

                 <div class="hpanel">


                    <div class="panel-body-removed">

<?php
      while($rows=mysqli_fetch_array($next_post)){
        $n_next_id        = $rows['id'];; 
        $n_title     = $rows['title'];; 
        $n_lesson    = $rows['lesson'];; 
        $n_duration  = $rows['duration'];; 
        $n_type      = $rows['type']; 
        $n_status      = $rows['status']; 


        $l         = ($n_status == '0') ?'#void' : "lessonsession.php?_l=$n_next_id&cs=$cs";
        $cl        = ($n_status == '0') ?'hpanel filter-item disabled' : "hpanel filter-item";
 //       $ad        = ($isEnrolled)?"assignment-details.php?_l=$id&cs=$_c":"#";
        $ad        = ($n_status == '0') ?'#void' : "assignment-details.php?_l=$n_next_id&cs=$cs";

        $typestyle  = ($n_type == 'l')?"Lesson $lesson":"Assignment";
        $typeLink   = ($n_type == 'l')?$l:$ad;


 ?>

                    <div class="<?=$cl?>">
                        <a href="<?=$typeLink?>">
                            <div class="panel-body">
                                <div class="pull-right text-right">
                                    <h4><?=$n_duration?> <!-- -->
                                    <i class="pe pe-7s-clock fa-lg text-info"></i> </h4>
                                </div>
                                <h4 class="m-b-xs"><span class="col-md-2 text-left p-l-none">Lesson <?=$n_lesson?>:</span> <?=$n_title?></h4>
                          </div>
                        </a>
                    </div>
<?php } ?>




                </div>
            </div>
<?php }?>


                    </div>





            <div class="col-md-3">

                <div class="hpanel stats">
                    <div class="panel-body">
                          <h3 class="text-success"> <i class="pe pe-7s-note2"></i> Information</h3>
                         <p class="small"><strong><?=ucwords($title)?></strong></p><br>
                           <div class="table-responsive course-table">
                                <table class="table table-condensed">
                                    <tbody>
                                    <tr>
                                        <td>Lessons</td>
                                        <td><strong> <?=$lesson?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Length</td>
                                        <td><strong><?=$duration?></strong> </td>
                                    </tr>
                                    </tbody>
                                </table>
                             </div>
                            <a class="btn btn-outline btn-success btn-block" href="course-details.php?id=<?=$cs?>"> <i class="pe pe-7s-back"></i> Back To Course</a>
                        </div>
                    </div>



                <div class="hpanel stats">
                    <div class="panel-body">
                          <h3 class="text-info"> <i class="pe pe-7s-mail-open-file"></i> Feedback</h3>
                          <p class="small">Have any information you like to share with us concerning this course? kindly leave a Feedback</p><br>
                            <a class="btn btn-primary2 btn-block" href="feedback.php?_l=<?=$_l?>&cs=<?=$cs?>"> <i class="fa fa-smile-o fa-lg"></i> Leave Feedback</a>
                        </div>
                    </div>




                </div>



            </div>


        </div>








    </div>


       

<!--<script src="//cdn.jsdelivr.net/mediaelement/latest/mediaelement-and-player.min.js"></script>               -->
 
        <!-- /page content -->
<?php include"footer.php";?>
<script type="text/javascript">

$(document).ready(function () {
});
</script>
    <script src="vendor/contextmenu/dist/jquery.contextMenu.min.js" type="text/javascript"></script>
    <script src="vendor/contextmenu/dist/jquery.ui.position.min.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function () {
  
        $.contextMenu({
            selector: 'body', 
            callback: function(key, options) {
                var m = "clicked: " + key;
                window.console && console.log(m) || alert(m); 
            },
            items: {
                   dashboard: {name: "Dashboard", callback: function(key, opt){ window.location='dashboard.php'; }},
                   enrollment: {name: "My Enrollment", callback: function(key, opt){ window.location='my-enrollment.php'; }},
                   courses: {name: "All Courses", callback: function(key, opt){ window.location='all-course.php'; }},
                   logout: {name: "Logout", callback: function(key, opt){ window.location='?logout'; }}
            }
        });


    });



</script>