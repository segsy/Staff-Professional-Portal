<?php 
include("config.php");
include("common.php");

	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json     = array();
$_title   = isset( $_POST['l_title'] ) ? escape_s($_POST['l_title']) : '';
$_path    = isset( $_POST['l_path'] ) ? escape_s($_POST['l_path']) : '';
$_summary = isset( $_POST['l_summary'] ) ? escape_s($_POST['l_summary']) : '';
$_duration = isset( $_POST['l_duration'] ) ? escape_s($_POST['l_duration']) : '';
$_lesson = isset( $_POST['l_lesson'] ) ? escape_s($_POST['l_lesson']) : '';
$_course   = isset( $_POST['l_course'] ) ? escape_s($_POST['l_course']) : '';


if( !$_title ) {
        $json['error']['title'] = 'title is required';
    }else{
        if(strlen($_title)  < 4 ) {
        $json['error']['title'] = 'Please your title is too short';
    }
}

if( !$_duration) {
    $json['error']['duration'] = 'your lesson duration is empty';
}


if( !isset( $json['error'] ) ) {

//print_r($_POST);

$_a  = isset($_POST['_a'])?$_POST['_a']:'';

switch ($_a) {
    case 'new':
            $i = genRand();
            if(query("INSERT INTO $tbl_lesson(lesson,title,duration,course_id,summary,status,date,path,poster,type)
            VALUES('$_lesson','$_title','$_duration','$_course','$_summary','1',NOW(),'$_path','-','l')")){
                    $json['success'] = 'Lesson Added!';
                    $json['lssId'] = $i;
                    $json['lssIdTr'] = '<tr class="lesson'.$i.'"><td>'.$_lesson.'</td><td>'.$_title.'</td><td>'.$_duration.'</td><td> Today </td><td><div class="btn-group btn-group-sm pull-right"><button data-id="'.$i.'" class="del'.$i.' btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> Delete</button></div></td></tr>';

            }else{
                $json['error']['lesson'] = 'Server error, please check back later';
            }
             
        break;
    
     case 'edit':
//print_r($_POST);
        $_l  = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';
        if(query("UPDATE $tbl_lesson SET title='$_title', duration='$_duration', summary='$_summary', path='$_path', lesson='$_lesson', course_id='$_course' WHERE id='$_l'")){
                $json['success'] = 'Lesson Updated!';
        }else{
            $json['error']['lesson'] = 'Server error, please check back later';
        }        
        break;  


     case 'enable':
        $_l  = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';
        if(query("UPDATE $tbl_lesson SET status='1' WHERE id='$_l'")){
                $json['success'] = 'Lesson Updated!';
        }else{
            $json['error']['lesson'] = 'Server error, please check back later';
        }        
        break;  

    case 'disable':
        $_l  = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';
        if(query("UPDATE $tbl_lesson SET status='0' WHERE id='$_l'")){
                $json['success'] = 'Lesson Updated!';
        }else{
            $json['error']['lesson'] = 'Server error, please check back later';
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