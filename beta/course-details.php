<?php 
include"nav.php";
$_c  = isset($_GET['id'])?escape_s($_GET['id']):'';

 $isEnrolled = mysqli_num_rows(query("SELECT * FROM $tbl_program WHERE user='".$_SESSION['_q_user']['_id']."' AND course='$_c'"));
//echo "countdone $countdone";

$query = query("SELECT *, c.title AS c_title, c.summary AS c_summary, c.duration AS c_duration, c.description AS c_description, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id 
                WHERE c.id='".$_c."' AND  c.status = '1'"); 
while($rows=mysqli_fetch_array($query)){
  /*   print_r($rows);
   */

        $c_id            = $rows['id'];; 
        $c_title         = $rows['c_title'];; 
        $c_summary       = $rows['c_summary'];; 
        $c_duration      = $rows['c_duration'];; 
        $c_description   = $rows['c_description']; 
        $lessontotal   = ($rows['lessontotal'] > 0)?$rows['lessontotal'].' Lessons':'0 Lesson'; 
        }
if(!$c_id){echo "<script>window.location='all-course.php'</script>";}



function courseLessonDone($type, $exist)
{
      $t = '';
  switch ($type) {
    case 'a':
        $d = ($exist)?"<i class='fa fa-check fa-lg text-info'></i>":"<i class='fa fa-youtube-play fa-lg text-faint'></i>";
      break;
    case 'l':
        $d = ($exist)?"<i class='fa fa-check fa-lg text-info'></i>":"<i class='fa fa-youtube-play fa-lg text-faint'></i>";
      break;
    case 's':
        $d = ($exist)?"<i class='fa fa-check fa-lg text-info'></i>":"<i class='pe pe-7s-display1 fa-lg text-faint' style='font-size: 1.6em; color: black; margin-top: -4px;margin-right: 5px;'></i>";
      break;
  }
  return $d;
}


function courseLessonType($type, $sort)
{
  # code... ":"
      $t = '';
  switch ($type) {
    case 'a':
      $t = 'Assignment';
      break;
    case 'l':
      $t = 'Lesson '.$sort;
      break;
    case 's':
      $t = 'Presentation';
      break;
  }
  return $t;
}
      //  $_rstatus  = ($r_exist)?" active":"";

function courseLessonLink($type, $isEnrolled, $status, $id, $_c)
{
        $l         = ($isEnrolled)?($status == '0' ?'#void' : "lessonsession.php?_l=$id&cs=$_c" ):"#";
//       $ad        = ($isEnrolled)?"assignment-details.php?_l=$id&cs=$_c":"#";
        $ad        = ($isEnrolled)?($status == '0' ?'#void' : "assignment-details.php?_l=$id&cs=$_c"):"#";

        $sl        = ($isEnrolled)?($status == '0' ?'#void' : "slide-details.php?_l=$id&cs=$_c"):"#";

      //  $_dstatus  = ($isEnrolled)?($status == '0' ? '#void' : ''):" void";

       // $typeLink   = ($type == 'l')?$l:$ad;
  # code...
      $t = '';
  switch ($type) {
    case 'a':
      $t = $ad;
      break;
    case 'l':
      $t = $l;
      break;
    case 's':
      $t = $sl;
      break;
  }
  return $t;

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

            <div class="col-md-9">

                <div class="font-bold m-b-sm">
                     Course details
                </div>

                <div class="hpanel">
                    <div class="panel-body">

                        <h3 class="m-t-none">About the course </h3><br>
                        <?=$c_summary?><br>
                        <div class="article"><?=html_entity_decode($c_description)?></div>
                        



                        <div class="m-t-md">
                            <canvas id="lineOptions" height="60"></canvas>
                        </div>
                    </div>
                </div>


                <div class="font-bold fa-lg m-b-sm">
                     Curriculum
                </div>

                <div class="hpanel">

                    <div class="panel-body-removed" id="accordion">
<style type="text/css">
.filter-item {
    margin-bottom: 10px;
}
.filter-item small {
    font-size: 71%;
    display: block;
    margin-bottom: 10px;
}

.filter-item .panel-body i.course-folder {
    font-size: 2.8em;
    /* margin-top: 20px; */
    top: 26px;
    position: absolute;
    display: inline-block;
    /* width: 5%; */
}
.filter-item .panel-body h3 {
    font-size: 17px;
    font-weight: 600;
    color: gray;
    width: 92%;
    float: right;
}

    .panel-body-collapse-items{
    padding: 10px 20px;
    margin: 0px -20px;
    border-bottom: none;
    border-radius: 0px;
    position: relative;

    }
.panel-body-collapse-items:hover,
.filter-item.active .panel-body.panel-body-collapse-items {
/*   background: #eaeded; fafcfd*/
 background: #fafcfd;
    border-top: 1px solid #d5dbdb;
  z-index: 100;
  -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.175);
  -moz-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.175);
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.175);
}

.section-down i {
    font-size: 32px;
    margin-top: -18px;
}



/* 
  ##Device = Low Resolution Tablets, Mobiles (Landscape)
  ##Screen = B/w 481px to 767px
*/

@media (min-width: 481px) and (max-width: 767px) {
  

.filter-item .panel-body h3 {
    width: 80%;
    font-size: 15px !important;
}


}
/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/

@media (min-width: 320px) and (max-width: 480px) {


.filter-item .panel-body h3 {
    width: 80%;
    font-size: 15px !important;
}
  }

</style>
<?php
//$query = query("SELECT * FROM $tbl_lesson WHERE course_id='".$_c."' ORDER BY lesson ASC");


$query = query("SELECT s.id AS session, s.sort,  l.id, l.status, l.title, l.lesson, l.duration, l.type, r.progress, r.user,
IF(s.title IS NULL, 'others', s.title) AS session_name,
IF(r.user = '".$_SESSION['_q_user']['_id']."', TRUE, FALSE) AS r_exist
 FROM training_lesson AS l
 LEFT JOIN training_record AS r ON l.id = r.lesson AND (r.user='".$_SESSION['_q_user']['_id']."' OR r.user IS NULL)
 LEFT JOIN training_section AS s ON l.section = s.id
 WHERE course_id='".$_c."' AND s.status='1'
GROUP BY l.id 
ORDER BY s.sort, l.id");


/*
 - training_course
 - training_enrollment
 - training_record
 - training_program
training_lesson


DROP FUNCTION IF EXISTS alphas; 
DELIMITER | 
CREATE FUNCTION alphas( str CHAR(32) ) RETURNS CHAR(16) 
BEGIN 
  DECLARE i, len SMALLINT DEFAULT 1; 
  DECLARE ret CHAR(32) DEFAULT ''; 
  DECLARE c CHAR(1); 
  SET len = CHAR_LENGTH( str ); 
  REPEAT 
    BEGIN 
      SET c = MID( str, i, 1 ); 
      IF c REGEXP '[[:alpha:]]' THEN 
        SET ret=CONCAT(ret,c); 
      END IF; 
      SET i = i + 1; 
    END; 
  UNTIL i > len END REPEAT; 
  RETURN ret; 
END | 
DELIMITER ; 
UPDATE training_program SET course = alphas(course); 






SELECT l.id, l.title, l.lesson, l.duration, l.type, r.progress, r.user,
IF(r.user = '".$_SESSION['_q_user']['_id']."', TRUE, FALSE) as r_exist
 FROM training_lesson AS l
 LEFT JOIN training_record AS r ON l.id = r.lesson AND (r.user='".$_SESSION['_q_user']['_id']."' OR r.user IS NULL)
 WHERE course_id='".$_c."'
GROUP BY l.id

$query = query("SELECT l.id, l.title, l.lesson, l.duration, l.type, r.progress, r.user, IF(r.user = '".$_SESSION['_q_user']['_id']."', TRUE, FALSE) as r_exist
FROM $tbl_lesson AS l
 LEFT JOIN $tbl_record AS r ON (l.id = r.lesson)
 WHERE l.course_id='".$_c."' AND (r.user='".$_SESSION['_q_user']['_id']."' OR r.user IS NULL)");
*/


if( mysqli_num_rows($query)){
$current_cat = 'null';
$tpl ="";

while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $id        = $rows['id'];; 
        $title     = $rows['title'];; 
        $lesson    = $rows['lesson'];; 
        $sort    = $rows['sort'];; 
        $session  = $rows['session'];; 
        $session_name  = $rows['session_name'];; 
       $duration  = $rows['duration'];; 
        $type      = $rows['type']; 
        $status    = $rows['status']; 


        $r_exist      = $rows['r_exist']; 

//        $l         = ($isEnrolled)?"lessonsession.php?_l=$id&cs=$_c":"#";
       // $l         = ($isEnrolled)?($status == '0' ?'#void' : "lessonsession.php?_l=$id&cs=$_c" ):"#";
 //       $ad        = ($isEnrolled)?"assignment-details.php?_l=$id&cs=$_c":"#";
       // $ad        = ($isEnrolled)?($status == '0' ?'#void' : "assignment-details.php?_l=$id&cs=$_c"):"#";
        $_dstatus  = ($isEnrolled)?($status == '0' ? '#void' : ''):" void";
        $_rstatus  = ($r_exist)?" active":"";
        //$typestyle  = ($type == 'l')?"Lesson $lesson":"Assignment";
       // $typeLink   = ($type == 'l')?$l:$ad;
        $r_done  = courseLessonDone($type, $r_exist);
        $typestyle  = courseLessonType($type, $lesson);
        $typeLink   = courseLessonLink($type, $isEnrolled, $status, $id, $_c);

  if ($rows["session"] != $current_cat) {
    $current_cat_name = $rows["session_name"];
      $c_id = $rows["session"];

      if($current_cat == 'null'){

                echo "<div class='hpanel filter-item'>
                <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$session."' aria-expanded='true'>
                <div class='panel-body'>
                   <i class='course-folder fa fa-folder-open fa-lg text-faint'></i>

                <h3 class='m-b-xs'><small>Section ".$sort." :</small> ".(string)$current_cat_name."</h3>
                <div class='clearfix'></div>
                 <div id='collapse".$session."' class='panel-collapse collapse in'>
                 <hr>";
      }else{
        echo "</div>
                          </div>
                        </a>
                    </div>
                  <div class='hpanel filter-item'>
                <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$session."' aria-expanded='false'>
                  <div class='panel-body'>
                   <i class='course-folder fa fa-folder fa-lg text-faint'></i>
               <h3 class='m-b-xs'><small>Section ".$sort." :</small> ".(string)$current_cat_name."<span class='section-down pull-right'> <i class='pe pe-7s-angle-down'></i></span></h3>
                     <div class='clearfix'></div>
            <div id='collapse".$session."' class='panel-collapse collapse'>
                 <hr>";
        }
    $current_cat = $c_id;
  }
       echo '<a href="'.$typeLink.'">
                    <div class="panel-body-collapse-items">
                        <div class="pull-right text-right hidden-xs">
                            <h4><i class="pe pe-7s-clock fa-lg text-faint"></i> '. $duration.' </h4>
                        </div>
                        <h4 class="m-b-xs"><span class="col-md-2 text-left p-l-none">'. $r_done.' '.$typestyle.':</span>  '.$title.'</h4>
                  </div>
                </a>';
} ?>

                    </div>
                    </div>
                    </div>
 <?php }else{?> <!-- Lessons comming soon -->

 <div class="alert alert-info">
 <strong><?=$c_title?> course doesnt have a lesson schedule today </strong>
   </div>



<?php } ?>

                    </div>

                </div>
            </div>


            <div class="col-md-3">

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


                        <div class=hpanel">
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
/*
$("#accordion .filter-item:first").css("background-color", "red");
$("#accordion .filter-item:first").removeClass('collapsed');
$("#accordion .filter-item:first").find('.panel-collapse.collapse').addClass('in');
*/


$('.article').readmore({
  speed: 400,
  moreLink: '<a href="#" class="article-readmore text-info m-t-md pull-right"><i class="pe pe-7s-more"></i> Full Details</a>',
  lessLink: '<a href="#" class="article-readmore text-info m-t-md pull-right"><i class="pe pe-7s-more"></i> Less Details</a>'
});
});
</script>
