<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
  $json  = array();
$a_ = isset( $_POST['a_'] ) ? escape_s($_POST['a_']) : '';
$_dept = $_SESSION['_q_user']['_dept'];
$_id   = $_SESSION['_q_user']['_id'];



 switch ($a_) {
   case 'enroll':// play
     # lesson started...
        
        $cs = isset( $_POST['cs'] ) ? escape_s($_POST['cs']) : '';    

        $course_enabled = mysqli_num_rows(query("SELECT * FROM training_enrollment WHERE course = '".$cs."' AND dept = '".$_dept."'"));
   
      if(!$course_enabled){

            $json['error']['subscription'] = 'no subscription ';

      }else{
/**/
        if(mysqli_num_rows(query("SELECT * FROM $tbl_program WHERE user='$_id' AND course='$cs'"))){

        }else{
        query("INSERT INTO $tbl_program(user,course,lesson,progress,date,dept) VALUES('$_id','$cs','0','0',NOW(),'$_dept')");
        }
        $json['success'] = '# started a program by enrolling...';   
        
      }        

    break;
 
 }
echo json_encode( $json );


}
 