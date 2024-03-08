<?php 
include("config.php");
include("common.php");

/*
include("class.phpmailer.php");
*/
//require_once('lib/recaptcha/recaptchalib.php');

if(!isset($_SESSION['_access'])){
   die("login");
  }
if(!isset($_SESSION['_q_user']['_log_type'])){
   die("login");
  }


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$a_ = isset( $_POST['a_'] ) ? escape_s($_POST['a_']) : '';
$_dept = $_SESSION['_q_user']['_dept'];
$_id   = $_SESSION['_q_user']['_id'];
 switch ($a_) {
   case '1':// play
     # lesson started...
   echo"# lesson started...";
        $l = isset( $_POST['l'] ) ? escape_s($_POST['l']) : '';
        $cs = isset( $_POST['cs'] ) ? escape_s($_POST['cs']) : '';  
        $p = isset( $_POST['p'] ) ? escape_s($_POST['p']) : '';     
        if(mysqli_num_rows(query("SELECT * FROM $tbl_record WHERE user='$_id' AND lesson='$l' AND course='$cs'"))){
         query("UPDATE $tbl_record SET progress = '$p', start = NOW() WHERE user='$_id' AND lesson='$l' AND course='$cs' AND progress != 'd'");

        }else{
        query("INSERT INTO $tbl_record(lesson,course,dept,user,date,progress,start,end) VALUES('$l','$cs','$_dept','$_id',NOW(),'0',NOW(),'0000-00-00 00:00:00')");
        }


    break;
   case '2':// pause
        $l = isset( $_POST['l'] ) ? escape_s($_POST['l']) : '';
        $p = isset( $_POST['p'] ) ? escape_s($_POST['p']) : '';     
        $t = isset( $_POST['t'] ) ? escape_s($_POST['t']) : '';     
        $cs = isset( $_POST['cs'] ) ? escape_s($_POST['cs']) : '';     

           $_l_state = $p/$t;
           $_l_progress = number_format( $_l_state * 1, 2 ); // change 2 to # of decimals

         query("UPDATE $tbl_record SET progress = '$p', start = NOW() WHERE user='$_id' AND lesson='$l' AND course='$cs' AND progress != 'd'");
  

        $countdone = mysqli_num_rows(query("SELECT * FROM $tbl_record WHERE user='$_id' AND course='$cs' AND progress = 'd'"));
        $totallesson = mysqli_num_rows(query("SELECT * FROM $tbl_lesson WHERE course_id='$cs'"));

        $lessn_plus_done = $countdone + $_l_progress;
        $percent = $lessn_plus_done/$totallesson;
        $percent_friendly = number_format( $percent * 100, 2 ); // change 2 to # of decimals

        query("UPDATE $tbl_program SET progress = '$percent_friendly', lesson ='$l' WHERE user='$_id' AND course='$cs' AND progress != '100'");


   echo"# lesson pause... completed: $countdone; lesson: $_l_progress; lessn_plus_done: $lessn_plus_done; total $percent_friendly%";

    break;
      
  case '3':// ended
         $l = isset( $_POST['l'] ) ? escape_s($_POST['l']) : '';
        $cs = isset( $_POST['cs'] ) ? escape_s($_POST['cs']) : '';     
        query("UPDATE $tbl_record SET progress = 'd', end = NOW() WHERE user='$_id' AND lesson='$l' AND course='$cs' AND progress != 'd'");
        $countdone = mysqli_num_rows(query("SELECT * FROM $tbl_record WHERE user='$_id' AND course='$cs' AND progress = 'd'"));
        $totallesson = mysqli_num_rows(query("SELECT * FROM $tbl_lesson WHERE course_id='$cs'"));

        $percent = $countdone/$totallesson;
        $percent_friendly = number_format( $percent * 100, 0 ); // change 2 to # of decimals

        query("UPDATE $tbl_program SET progress = '$percent_friendly', lesson ='$l' WHERE user='$_id' AND course='$cs' AND progress != '100'");

   //echo"# lesson ended...$percent_friendly";

   break;
 }


}
 /*

            if(query("UPDATE question_content SET q_answered = '$attended' WHERE q_id='$a_msg_id'")){

                  if($attended == 1){
                     query("INSERT INTO a_content(a_question,a_content,a_date,a_user) VALUES('$a_msg_id','$code',NOW(),'$a_u')");
                  }
                  if($attended == 2){
                     query("INSERT INTO review_content(office,date,status,msg_id) VALUES('$forward_to_name',NOW(),'0','$a_msg_id')");
                  }
                  */