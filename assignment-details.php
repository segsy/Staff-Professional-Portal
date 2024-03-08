<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 

// include"nav.php";

$_l  = isset($_GET['_l'])?$_GET['_l']:'';

$cs  = isset($_GET['cs'])?$_GET['cs']:'';

 $isEnrolled = mysqli_num_rows(query("SELECT * FROM $tbl_program WHERE user='".$_SESSION['_q_user']['_id']."' AND course='$cs'"));

 echo ($isEnrolled)?"":"<script>window.location='course-details.php?id=$cs'</script>";



$query = query("SELECT a.content, a.id AS a_id, l.type AS l_type, l.path AS l_path, l.poster AS l_poster, l.title AS l_title, l.lesson AS l_lesson, l.summary AS l_summary , l.duration AS l_duration FROM $tbl_lesson AS l

LEFT JOIN $tbl_answer AS a ON l.id = a.assignment

  WHERE l.id='".$_l."'");



/*

$query = query("SELECT *, l.title AS l_title, l.lesson AS l_lesson, l.duration AS l_duration FROM $tbl_lesson AS l

  LEFT JOIN $tbl_answer AS a ON l.id = a.assignment

  WHERE l.id='".$_l."'");

SELECT a.content, a.id AS a_id, l.type AS l_type, l.path AS l_path, l.poster AS l_poster, l.title AS l_title, l.lesson AS l_lesson, l.duration AS l_duration FROM lwnm.training_lesson AS l

LEFT JOIN lwnm.training_answer AS a ON l.id = a.assignment

  WHERE l.id='5'

$query = query("SELECT * FROM $tbl_lesson WHERE type='a' AND id='".$_l."'");

*/



while($rows=mysqli_fetch_array($query)){

    /*lwnm

    print_r($rows);

    */

        $ass_id     = $rows['a_id'];; 

        $title     = $rows['l_title'];; 

        $lesson    = $rows['l_lesson'];; 

        $duration  = $rows['l_duration'];; 

        $type      = $rows['l_type']; 

        $path      = $rows['l_path']; 

        $poster    = $rows['l_poster']; 

        $summary    = $rows['l_summary']; 

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

                   <i class="pe pe-7s-radio"></i> Assignment: <?=$title?>

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

                              <source src='<?=str_replace("dropbox.com", "dl.dropboxusercontent.com", $path)?>' type='video/mp4'>



                            </video>

                            </div>



                    </div>

                </div>





               <div class="font-bold m-b-sm">

                     Assignment Instructions

                </div>



                <div class="hpanel">

                    <div class="panel-body">

                    <?=nl2br($summary)?>

                    </div>

                </div>







                    </div>











            <div class="col-md-3">

                <div class="hpanel stats">

                  <div class="panel-heading hbuilt">

                        <div class="p-xs h4">

                            Submit Your Answer

                        </div>

                    </div>

                    <div class="panel-body">



 

                                  <p class="small"><?=$title?></p><br>



                                  <?php if(!$ass_id){?>





                                               <output id="form_message" class="form" style="padding: 0"></output>                    





                              <form id="assignform" class="course__form form-horizontal" enctype="multipart/form-data">



                                  <input name="_a" type="hidden" value="new"/>

                                  <input name="_i" type="hidden" value="<?=$_l?>"/>





                                <div class="col-sm-12">

                                <div class="form-group">

                                    <label class="col-sm-12 p-none control-label" style="text-align: left;margin-bottom: 10px;"> Upload Answer</label>

                                 <div class="col-sm-12 p-none">

                                        <input type="file" class="form-control input-sm" name="a_file" id="a_file" required>

                                        <small class="help-block text-warning">Doc format supported: pdf, .doc, .docx</small>

                                </div>



                                </div>

                                </div>









                            <button class="btn btn-info btn-lg btn-block ladda-button" id="upload_answer" data-style="zoom-out"> <i class="pe pe-7s-upload"></i> Upload</button>



                            </form>



                            <?php } ?>





                        </div>



                    </div>

                </div>







            </div>





        </div>

















    </div>





       



<!--<script src="//cdn.jsdelivr.net/mediaelement/latest/mediaelement-and-player.min.js"></script>               -->

 

        <!-- /page content -->

<?php include"footer.php";?>

<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>

<script src="vendor/ladda/dist/spin.min.js"></script>

<script src="vendor/ladda/dist/ladda.min.js"></script>

<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>    

<script src="vendor/contextmenu/dist/jquery.contextMenu.min.js" type="text/javascript"></script>

    <script src="vendor/contextmenu/dist/jquery.ui.position.min.js" type="text/javascript"></script>



    <script src="scripts/assignment-details.js"></script>



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

/*

        $('body').on('click', function(e){

            console.log('clicked', this);

        });    

*/

// var viPlayer = new MediaElementPlayer('video', {



$('video').mediaelementplayer({

    showPosterWhenEnded: true,

 //   showPosterWhenPaused: true,





    success: function(mediaElement, domObject) {

        mediaElement.addEventListener('loadeddata', function() {

            console.log('addEventListener - loadeddata with '+mediaElement.duration.toFixed(3));  





var _mediaticker = setInterval(function() {

    //console.log('mediaElement currentTime'+mediaElement.currentTime.toFixed(2));

          console.log('start mediaticker');

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

        console.log('Error setting media!');

       /* setTimeout(function(){

          clearInterval(_mediaticker); // The setInterval it cleared and doesn't run anymore.

        console.log('clear mediaticker');

      },30.6 * 1000);

      */



                 



    }



});





    });



</script>