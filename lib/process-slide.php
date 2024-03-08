<?php 
include("config.php");
include("common.php");

	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json     = array();
$_title   = isset( $_POST['s_title'] ) ? escape_s($_POST['s_title']) : '';
$_path    = isset( $_POST['s_path'] ) ? escape_s($_POST['s_path']) : '';
$_summary = isset( $_POST['s_summary'] ) ? escape_s($_POST['s_summary']) : '';
$_duration = isset( $_POST['s_duration'] ) ? escape_s($_POST['s_duration']) : '';
$_slide = isset( $_POST['s_slide'] ) ? escape_s($_POST['s_slide']) : '';
$_course   = isset( $_POST['s_course'] ) ? escape_s($_POST['s_course']) : '';

if( !$_title ) {
    $json['error']['title'] = 'title is required';
}else{
    if(strlen($_title)  < 10 ) {
    $json['error']['title'] = 'Please your title is too short';
}
}

if( !$_duration) {
    $json['error']['duration'] = 'your slide duration is empty';
}


if( !isset( $json['error'] ) ) {

//print_r($_POST);

$_a  = isset($_POST['_a'])?$_POST['_a']:'';

switch ($_a) {
    case 'new':
            $i = genRand();
            if(query("INSERT INTO $tbl_lesson(lesson,title,duration,course_id,summary,status,date,path,poster,type)
            VALUES('$_slide','$_title','$_duration','$_course','$_summary','0',NOW(),'$_path','-','s')")){
                    $json['success'] = 'slide Added!';
            }else{
                $json['error']['slide'] = 'Server error, please check back later';
            }
             
        break;
    
     case 'edit':
//print_r($_POST);
        $_l  = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';
        if(query("UPDATE $tbl_lesson SET title='$_title', duration='$_duration', summary='$_summary', path='$_path', slide='$_slide', course_id='$_course' WHERE id='$_l'")){
                $json['success'] = 'slide Updated!';
        }else{
            $json['error']['slide'] = 'Server error, please check back later';
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