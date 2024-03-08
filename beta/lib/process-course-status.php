<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 

$json     = array();
$s        = isset( $_POST['s'] ) ? escape_s($_POST['s']) : '';
$i        = isset( $_POST['i'] ) ? escape_s($_POST['i']) : '';
$t        = isset( $_POST['t'] ) ? escape_s($_POST['t']) : '';


if( !isset( $json['error'] ) ) {

switch ($t) {
    case 'enable':                 
       if(query("UPDATE $tbl_course  SET status = '1' WHERE id='$i'")){
                $json['success'] = 'Course Updated!';
        }else{
            $json['error']['status'] = 'Server error, while updating status';
        }
        /**/
        break;
    
     case 'disable':

       if(query("UPDATE $tbl_course  SET status = '0' WHERE id='$i'")){
                $json['success'] = 'Lesson Deleted!';
        }else{
            $json['error']['status'] = 'Server error, while updating status';
        }    
      /*  */
        break;  
  
default:
        # code...
        break;
}





}

echo json_encode( $json );

}

?>