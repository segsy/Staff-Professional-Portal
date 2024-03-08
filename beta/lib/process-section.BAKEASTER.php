<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	 
$json     = array();

/*
Array
(
    [_a] => new
    [_h] => 76,77,78,79,80
    [c_title] => test
    [_course] => mecpbgohhshbmt
)
*/

if( !isset( $json['error'] ) ) {

$_s  = isset($_POST['_sort'])?$_POST['_sort']:'';
$_a  = isset($_POST['_a'])?$_POST['_a']:'';
$_t  = mysqli_escape_string($dbCon, isset($_POST['c_title'])?$_POST['c_title']:'');
$_c  = isset($_POST['_course'])?$_POST['_course']:'';
$_h  = isset($_POST['_h'])?$_POST['_h']:'';
$_h = explode(',', $_h); //split string into array seperated by ', '
/*
foreach($_h as $check) {
        echo $check; 
    }
    print_r($_POST);
    die();


    */
switch ($_a) {
    case 'schedule':
    $s        = isset( $_POST['s'] ) ? $_POST['s'] : '';
    $_i        = isset( $_POST['d'] ) ? $_POST['d'] : '';

             switch ($s) {
                    case 0:  // please subscribe me
                    if(query("UPDATE training_section SET status='1' WHERE id='$_i'")){
                                $json['success'] = 'Section Updated!';
                        }else{
                            $json['error']['section'] = 'Server error, please check back later';
                        }
                    break;
                    
                    case 1:  // please remove me            
                        if(query("UPDATE training_section SET status='0' WHERE id='$_i'")){
                                $json['success'] = 'Schedule Removed!';
                        }else{
                            $json['error']['section'] = 'Server error, while removing schedule';
                        }    
                           /* */
                  break;  
                }

             
        break;
    
 case 'new':

            $n    = isset( $_POST['c_title'] ) ? escape_s($_POST['c_title']) : '';

            if( empty($n)) {
                $json['error']['title'] = 'your section name is empty';
            }
            if( !isset( $json['error'] ) ) {
                if(query("INSERT INTO training_section(title,status,date,course,sort) VALUES('$_t','0',NOW(),'$_c','$_s')")){
                        $json['success'] = 'Section Added!';
                        $_insert_id = mysqli_insert_id($dbCon);

                        foreach($_h as $check) {
                            query("UPDATE training_lesson SET section='$_insert_id' WHERE id='$check'");
                                }


                }else{
                    $json['error']['section'] = 'Server error, please check back later';
                }
            }
             
        break;
    
     case 'delete':

        $i        = isset( $_POST['i'] ) ? escape_s($_POST['i']) : '';
         if(query("DELETE FROM training_section WHERE id='$i'")){
                $json['success'] = 'Section Deleted!';
        }else{
            $json['error']['delete'] = 'Server error while deleting content';
        }       
        break;  
     case 'edit':
        
            $_i    = isset( $_POST['_i'] ) ? escape_s($_POST['_i']) : '';

            if( empty($_t)) {
                $json['error']['title'] = 'your section name is empty';
            }
            if( empty($_s)) {
                $json['error']['section'] = 'Server error, Unacceptable method';
            }
            if( !isset( $json['error'] ) ) {
              if(query("UPDATE training_section SET title='$_t', sort='$_s' WHERE id='$_i'")){
                        $json['success'] = 'Section Updated!';
                }else{
                    $json['error']['section'] = 'Server error, please check back later';
                }
            }

        break;
}



}


echo json_encode( $json );

}

?>