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


if( !isset( $json['error'] ) ) {

$_a  = isset($_POST['_a'])?$_POST['_a']:'';

switch ($_a) {
    case 'new':

            $n    = isset( $_POST['c_title'] ) ? escape_s($_POST['c_title']) : '';

            if( empty($n)) {
                $json['error']['title'] = 'your category name is empty';
            }
            if( !isset( $json['error'] ) ) {
            if(query("INSERT INTO $tbl_category (title,jobfamily_id,jobfamily,status,date) VALUES ('$n', '0','$n', '0',NOW())")){
   			//if(query("INSERT INTO $tbl_category(title,status,date) VALUES('$n','0',NOW())")){
    			        $json['success'] = 'Category Added!';
                        $_insert_id = mysqli_insert_id($dbCon);
                        $json['new_id'] = $_insert_id;
                        $_data = '<tr class="cat'.$_insert_id.'">
                                      <td class="tdcourse">'.$n.'</td>
                                      <td>0</td>
                                      <!-- <td>2017-03-20 16:13:07</td> -->
                                      <td>
                                      <div class="btn-group btn-group-sm pull-right">
                                        <button data-id="'.$_insert_id.'" data-name="'.$n.'" class="del'.$_insert_id.' btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i>  </button>
                                        <button data-id="'.$_insert_id.'" data-name="'.$n.'" class="edt'.$_insert_id.' btn btn-outline btn-info btn-edit"> <i class="pe pe-7s-pen fa-lg"></i> Edit </button>
                                      </div> 
                                      </td><!--   -->
                                    </tr>';

                        $json['trdata'] = $_data;

                }else{
                    $json['error']['category'] = 'Server error, please check back later';
                }
            }
             
        break;
    
     case 'delete':

        $i        = isset( $_POST['i'] ) ? escape_s($_POST['i']) : '';
         if(query("DELETE FROM $tbl_category WHERE id='$i'")){
                $json['success'] = 'Category Deleted!';
        }else{
            $json['error']['delete'] = 'Server error while deleting content';
        }    


//print_r($_POST);
     /*

     i have full transcript of my chats with your team and am ready to publish it as much as i can, if youre not going to either call back my package or deliver it to me


        $a_number  = isset( $_POST['a_number'] ) ? escape_s($_POST['a_number']) : '';
        $_l  = isset( $_POST['_l'] ) ? escape_s($_POST['_l']) : '';
        if(query("UPDATE $tbl_lesson SET duration='$_duration', summary='$_question', path='$_path', lesson='$a_number', course_id='$_course' WHERE id='$_l'AND type='a'")){
                $json['successd'] = 'Assignment Updated!';
        }else{
            $json['error']['lesson'] = 'Server error, please check back later';
        }    
        */    
        break;  
default:
        
            $n    = isset( $_POST['c_title'] ) ? escape_s($_POST['c_title']) : '';

            if( empty($n)) {
                $json['error']['title'] = 'your category name is empty';
            }
            if( empty($n)) {
                $json['error']['category'] = 'Server error, Unacceptable method';
            }
            if( !isset( $json['error'] ) ) {
              if(query("UPDATE $tbl_category SET title='$n' WHERE id='$_a'")){
                        $json['success'] = 'Category Added!';
                }else{
                    $json['error']['category'] = 'Server error, please check back later';
                }
            }

        break;
}



}


echo json_encode( $json );

}

?>