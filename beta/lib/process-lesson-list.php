<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json     = array();
$c   = isset( $_POST['i'] ) ? escape_s($_POST['i']) : false;

print_r($_POST);

if( $c ) {


$_a  = isset($_POST['_a'])?$_POST['_a']:'';
    $op = "<option value=\"\"> Select A Lesson No</option>";

switch ($_a) {
    case 'new':

 $query = query("SELECT * FROM $tbl_lesson WHERE type='l'  AND  course_id='$c'");
                    $count=mysqli_num_rows($query);
                    if($count){
                   while($row=mysqli_fetch_array($query))
                       {
                    $lesson=$row['lesson'];    
                    $op .= "<option value=\"$lesson\"> Lesson $lesson</option>";
                      }       
                    }else{
                       // $op = "<option value=\"1\"> Lesson 1</option>";
                    }     
        break;
    
     default:
//print_r($_POST);
                 $query = query("SELECT * FROM $tbl_lesson WHERE type='l'  AND  course_id='$c'");
                    $count=mysqli_num_rows($query);
                    if($count){
                   while($row=mysqli_fetch_array($query))
                       {
                    $lesson=$row['lesson'];    
                    $op .= "<option value=\"$lesson\"> Lesson $lesson</option>";
                      }       
                    }else{
                       // $op = "<option value=\"1\"> Lesson 1</option>";
                    }     
        break;  

}
echo $op;



}


}

?>