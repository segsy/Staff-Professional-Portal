<?php 
include("config.php");
include("common.php");
include("aes.php");


    if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 

$json     = array();
$n        = isset( $_POST['n'] ) ? escape_s($_POST['n']) : '';
$i        = isset( $_POST['i'] ) ? escape_s($_POST['i']) : '';
$t        = isset( $_POST['t'] ) ? escape_s($_POST['t']) : '';


if( !isset( $json['error'] ) ) {

switch ($t) {
    case 'course':
             /* $json['success'] = 'Course Deleted!';*/
        if(query("DELETE FROM $tbl_course WHERE id='$i'")){
            query("DELETE FROM $tbl_lesson WHERE course_id='$i'");
            $json['success'] = 'Course Deleted!';
        }else{
            $json['error']['delete'] = 'Server error, while deleting content';
        }
        break;
    
     case 'lesson':
/**/
         if(query("DELETE FROM $tbl_lesson WHERE id='$i'")){
                $json['success'] = 'Lesson Deleted!';
        }else{
            $json['error']['delete'] = 'Server error, while deleting content';
        }    
        
        break;  
    case 'assignment':

         if(query("DELETE FROM $tbl_lesson WHERE id='$i' AND type='a'")){
                $json['success'] = 'Assignment Deleted!';
        }else{
            $json['error']['delete'] = 'Server error, while deleting content';
        }   
        break;  

    case 'news':

         if(query("DELETE FROM training_news WHERE id='$i'")){
                $json['success'] = 'News Deleted!';
        }else{
            $json['error']['delete'] = 'Server error, while deleting content';
        }    
       /* */
        break;  
default:
        # code...
        break;
}





}

echo json_encode( $json );

}

?>