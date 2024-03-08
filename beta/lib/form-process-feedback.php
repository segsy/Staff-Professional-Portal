<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json     = array();
$_a       = isset( $_POST['_a'] ) ? escape_s($_POST['_a']) : '';
$_l       = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';
$_cs      = isset( $_POST['_cs'] ) ? escape_s($_POST['_cs']) : '';
$_lsname      = isset( $_POST['_lname'] ) ? escape_s($_POST['_lname']) : '';
$_csname     = isset( $_POST['_csname'] ) ? escape_s($_POST['_csname']) : '';
$_subject = isset( $_POST['c_subject'] ) ? escape_s($_POST['c_subject']) : '';
$_code    = isset( $_POST['c_code'] ) ? escape_s($_POST['c_code']) : '';
$_dept    = $_SESSION['_q_user']['_dept'];
$_deptname= $_SESSION['_q_user']['_deptname'];
$_jobfamilyname= $_SESSION['_q_user']['_jobfamilyname'];
$_rank    = $_SESSION['_q_user']['_rank'];
$_id      = $_SESSION['_q_user']['_id'];
$_email   = $_SESSION['_q_user']['_email'];
$_title   = $_SESSION['_q_user']['_title'];
$_fname   = $_SESSION['_q_user']['_fname'];
$_lname   = $_SESSION['_q_user']['_lname'];
$_name    = $_title.' '.$_fname.' '.$_lname;

if( !$_subject ) {
    $json['error']['title'] = 'Subject is required';
}


if( !$_code) {
    $json['error']['code'] = 'your message is empty';
}else{
    if( strlen($_code)  < 50 ) {
        $json['error']['code'] = 'your message is too short, please write more';
    }  
}

//print_r($_POST);
//die();  


if( !isset( $json['error'] ) ) {

switch ($_a) {
    case 'new':
    
        require 'PHPMailerAutoload.php';
        include("mail.php");        

      if(query("INSERT INTO training_feedback(subject,content,status,date,user,dept,course,lesson)
        VALUES('$_subject','$_code','0',NOW(),'$_id','$_dept','$_cs','$_l')")){


            $mailit = mailFeedback($_POST['c_code'],$_csname,$_lsname,$_name,$_subject,$_email,$_deptname,$_rank,$_jobfamilyname);

                $json['success'] = 'Feedback recieved!';
        }else{
            $json['error']['contact'] = 'Server error, please check back later';
        }
        break;
    
     case 'edit':

/*
        $_c  = isset( $_POST['_c'] ) ? escape_s($_POST['_c']) : '';

        if(query("UPDATE $tbl_course SET title='$_title', category='$_category', duration='$_duration', summary='$_summary', description='$_code' WHERE id='$_c'")){
                $json['success'] = 'Course Updated!';
        }else{
            $json['error']['contact'] = 'Server error, please check back later';
        }   
    */         
        break;  
default:
        # code...

        break;
}





}

echo json_encode( $json );

}

?>