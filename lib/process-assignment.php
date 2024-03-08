<?php 

include("config.php");

include("common.php");





	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")

{

	/*



a_path:http://127.0.0.1/slim/training/videos/lesson.mp4

a_course:0r3c8pbdhe3y5bgb2e36

a_duration:3 Minutes

a_assignment:Assignment 5

a_summary:



 die();

	*/

$json     = array();

$_path    = isset( $_POST['a_path'] ) ? escape_s($_POST['a_path']) : '';

$_question = isset( $_POST['a_question'] ) ? escape_s($_POST['a_question']) : '';

$_duration = isset( $_POST['a_duration'] ) ? escape_s($_POST['a_duration']) : '';

$_number = isset( $_POST['a_number'] ) ? escape_s($_POST['a_number']) : '';

$_course   = isset( $_POST['a_course'] ) ? escape_s($_POST['a_course']) : '';


// print_r($_POST);

// die();





if( !$_duration) {

    $json['error']['duration'] = 'your assignment duration is empty';

}





if( !isset( $json['error'] ) ) {



$_a  = isset($_POST['_a'])?$_POST['_a']:'';



switch ($_a) {

    case 'new':

			$i = genRand();

			if(query("INSERT INTO $tbl_lesson(id,lesson,title,duration,course_id,summary,status,date,path,poster,type)

			VALUES('$i','$_number','','$_duration','$_course','$_question','0',NOW(),'$_path','-','a')")){

			        $json['success'] = 'Assignment Added!';

            }else{

                $json['error']['lesson'] = 'Server error, please check back later';

            }

             

        break;

    

     case 'edit':

//print_r($_POST);

     

        $a_number  = isset( $_POST['a_number'] ) ? escape_s($_POST['a_number']) : '';

        $_l  = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';

        if(query("UPDATE $tbl_lesson SET duration='$_duration', summary='$_question', path='$_path', lesson='$a_number', course_id='$_course' WHERE id='$_l'AND type='a'")){

                $json['successd'] = 'Assignment Updated!';

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