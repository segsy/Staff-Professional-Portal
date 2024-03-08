<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
//   var dataString='n='+n+'&c='+c+'&d='+i+'&s='+t;

$json     = array();
$n        = isset( $_POST['n'] ) ? escape_s($_POST['n']) : '';
$c        = isset( $_POST['c'] ) ? escape_s($_POST['c']) : '';
$d        = isset( $_POST['d'] ) ? escape_s($_POST['d']) : '';
$s        = isset( $_POST['s'] ) ? escape_s($_POST['s']) : '';


if( !isset( $json['error'] ) ) {

switch ($s) {
    case 0:  // please subscribe me
            $json['success'] = 'Subscribed!';

       if(query("INSERT INTO training_enrollment (course, dept, status, date) VALUES('$c','$d','1',NOW())")){
            $json['success'] = 'Subscribed!';
        }else{
            $json['error']['enroll'] = 'Server error, while enrolling department';
        }

    break;
    
    case 1:  // please remove me
/**/
         if(query("DELETE FROM training_enrollment WHERE course='$c' AND dept='$d'")){
                $json['success'] = 'Lesson Deleted!';
        }else{
            $json['error']['enroll'] = 'Server error, while unsubscribing department';
        }    
    break;  
        
default:
        # code...
        break;
}





}

echo json_encode( $json );

}

?>