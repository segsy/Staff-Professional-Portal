<?php 
include"nav.php";
$_l  = isset($_GET['_l'])?$_GET['_l']:'';
$cs  = isset($_GET['cs'])?$_GET['cs']:'';
 $isEnrolled = mysqli_num_rows(query("SELECT * FROM $tbl_program WHERE user='".$_SESSION['_q_user']['_id']."' AND course='$cs'"));
 echo ($isEnrolled)?"":"<script>window.location='course-details.php?id=$cs'</script>";

  $course_enabled = mysqli_num_rows(query("SELECT * FROM $tbl_course WHERE id='".$cs."' AND status='1'"));
if(!$course_enabled){echo "<script>window.location='all-course.php'</script>";}

//echo "course_enabled $course_enabled";


$query = query("SELECT * FROM $tbl_lesson WHERE id='".$_l."'");
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
                   <i class="pe pe-7s-radio"></i> Lesson <?=$lesson?>: <?=$title?>
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
                            <div class="embed-responsive embed-responsive-16by9">
                            <video id='lesson-player' class='mejs-player embed-responsive-item' preload='none' width='100%' height='100%' poster='<?=$poster?>'>
                              <source src='<?=$pathreplace?>' type='video/mp4'>

                            </video>
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
        $next_id        = $rows['id'];; 
        $title     = $rows['title'];; 
        $lesson    = $rows['lesson'];; 
        $duration  = $rows['duration'];; 
        $type      = $rows['type']; 

 ?>

                    <div class="hpanel filter-item">
                        <a href="lessonsession.php?cs=<?=$cs?>&_l=<?=$next_id?>">
                            <div class="panel-body">
                                <div class="pull-right text-right">
                                    <h4><?=$duration?> <!-- -->
                                    <i class="pe pe-7s-clock fa-lg text-info"></i> </h4>
                                </div>
                                <h4 class="m-b-xs"><span class="col-md-2 text-left p-l-none">Lesson <?=$lesson?>:</span> <?=$title?></h4>
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

 
                                  <p class="small"><?=$title?></p><br>

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
                                    </tr><!--
                                    <tr>
                                        <td>Progress</td>
                                        <td><strong>076 1743 8649</strong></td>
                                    </tr>-->

                                    </tbody>
                                </table>
                    </div>

                            <a class="btn btn-success btn-block" href="course-details.php?id=<?=$cs?>"> <i class="pe pe-7s-back"></i> Back To Course</a>


                        </div>

                    </div>
                </div>



            </div>


        </div>








    </div>


       

<!--<script src="//cdn.jsdelivr.net/mediaelement/latest/mediaelement-and-player.min.js"></script>               -->
 
        <!-- /page content -->
<?php include"footer.php";?>
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


$('video').mediaelementplayer({
    showPosterWhenEnded: true,
 //   showPosterWhenPaused: true,


    success: function(mediaElement, domObject) {
        mediaElement.addEventListener('loadeddata', function() {
            console.log('addEventListener - loadeddata with '+mediaElement.duration.toFixed(3));           


var _mediaticker = setInterval(function() {
    //console.log('mediaElement currentTime'+mediaElement.currentTime.toFixed(2));
               $.ajax({
                   type: "POST",
                   url: "lib/process-player.php",
                   data: "a_=2&l=<?=$_l?>&cs=<?=$cs?>&p="+mediaElement.currentTime.toFixed(3)+"&t="+mediaElement.duration.toFixed(3),
                   success: function(msg){}
                 });

}, 30 * 1000); // 60 * 1000 milsec


        }, false);
        mediaElement.addEventListener('playing', function () {
            console.log("event triggered after play method");
               $.ajax({
                   type: "POST",
                   url: "lib/process-player.php",
                   data: "a_=1&l=<?=$_l?>&cs=<?=$cs?>&p="+mediaElement.currentTime.toFixed(3),
                   success: function(msg){}
                 });            
        }, false);



        mediaElement.addEventListener('pause', function () {
            console.log("Pause event triggered");
              console.log("Progresss "+mediaElement.currentTime.toFixed(3));

               $.ajax({
                   type: "POST",
                   url: "lib/process-player.php",
                   data: "a_=2&l=<?=$_l?>&cs=<?=$cs?>&p="+mediaElement.currentTime.toFixed(3)+"&t="+mediaElement.duration.toFixed(3),
                   success: function(msg){}
                 });

      }, false);
        mediaElement.addEventListener('ended', function () {
         clearInterval(_mediaticker); // The setInterval it cleared and doesn't run anymore.
           console.log("Lesson comes to an end event triggered");

               $.ajax({
                   type: "POST",
                   url: "lib/process-player.php",
                   data: "a_=3&l=<?=$_l?>&cs=<?=$cs?>",
                   success: function(msg){}
                 });
                            
        }, false);
       mediaElement.addEventListener('timeupdate', function(e) {
        //    console.log("Progresss "+mediaElement.currentTime);
        }, false);

    },
    error: function() {
       // alert('Error setting media!');
    }

});


    });

</script>