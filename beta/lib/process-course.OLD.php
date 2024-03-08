<?php 
include("config.php");
include("common.php");
include("aes.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json     = array();
$_a        = isset( $_POST['_a'] ) ? escape_s($_POST['_a']) : '';
$_title   = isset( $_POST['c_title'] ) ? escape_s($_POST['c_title']) : '';
$_code    = isset( $_POST['c_code'] ) ? escape_s($_POST['c_code']) : '';
$_duration = isset( $_POST['c_duration'] ) ? escape_s($_POST['c_duration']) : '';
$_category   = isset( $_POST['c_category'] ) ? escape_s($_POST['c_category']) : '';
$_summary = isset( $_POST['c_summary'] ) ? escape_s($_POST['c_summary']) : '';


if( !$_title ) {
    $json['error']['title'] = 'title is required';
}else{
    if(strlen($_title)  < 10 ) {
    $json['error']['title'] = 'Please your title is too short';
}
}



if(empty($_category)) {
    $json['error']['category'] = 'course category is required';
}

if( !$_duration) {
    $json['error']['duration'] = 'your course duration is empty';
}

if( !$_code) {
    $json['error']['code'] = 'your course description is empty';
}else{
    if( strlen($_code)  < 100 ) {
        $json['error']['code'] = 'your course description is too short, please write more';
    }  
}

if( !$_summary) {
    $json['error']['summary'] = 'Course summary or intro is is empty';
}else{
    if( strlen($_summary)  < 100 ) {
        $json['error']['summary'] = 'Course summary is too short, please write more';
    }  
}

//print_r($_FILES);
//die(); 
             //if they DID upload a file...
      if($_FILES['c_picture']['name']){

        $file_thumb = $_FILES['c_picture']; 
        list($otherpartt, $extension) = explode(".", strtolower($_FILES["c_picture"]["name"]));
        //$extension = end();
        $currentdir = '';

            // check if picture size is more than allowed in config
          if($_FILES['c_picture']['size'] > ($max_upload_size)) //can't be larger than 1 MB
          {
              $json['error']['upload']= 'Oops!  Your file\'s size is to large.';
          }

            // check if picture type is within allowed Extensions
          if (!in_array( $extension,  $allowedExtensions)) 
          { 
                $json['error']['upload'] = ' is an invalid file type!';
          }

          // if folder doesnt exit, create it
        if(!is_dir($currentdir . $thumb_folder)){
           // create the directory
            if (!mkdir($currentdir . $thumb_folder, 0777, true)) {
               $json['error']['upload'] = 'Unable to Create Upload directory';
            }
        }

      }






if( !isset( $json['error'] ) ) {

switch ($_a) {
    case 'new':
        $i = genRand();

              if($_FILES['c_picture']['name']){
                $file_thumb = $_FILES['c_picture']; 
                list($otherpartt, $extension) = explode(".", strtolower($_FILES["c_picture"]["name"]));
                $currentdir = '';
                $target =  $thumb_folder . $i.'.'.$extension;
                    // check if picture thumbnail already exist

               if($_FILES['c_picture']['name'])
                  {
                          move_uploaded_file($_FILES['c_picture']['tmp_name'], $target);
                 }
              }



        if(query("INSERT INTO $tbl_course(id,title,duration,summary,description,date,category)
        VALUES('$i','$_title','$_duration','$_summary','$_code',NOW(),'$_category')")){
                $json['success'] = 'Course has been added!';
        }else{
            $json['error']['course'] = 'Server error, please check back later';
        }
        break;
    
     case 'edit':

        $_c  = isset( $_POST['_c'] ) ? escape_s($_POST['_c']) : '';
              if($_FILES['c_picture']['name']){
                $file_thumb = $_FILES['c_picture']; 
                list($otherpartt, $extension) = explode(".", strtolower($_FILES["c_picture"]["name"]));
                $currentdir = '';
                $target =  $thumb_folder . $_c.'.'.$extension;
                    // check if picture thumbnail already exist
               if($_FILES['c_picture']['name'])
                  {
                          move_uploaded_file($_FILES['c_picture']['tmp_name'], $target);
                 }
              }


        if(query("UPDATE $tbl_course SET title='$_title', category='$_category', duration='$_duration', summary='$_summary', description='$_code' WHERE id='$_c'")){
                $json['success'] = 'Course Updated!';
        }else{
            $json['error']['course'] = 'Server error, please check back later';
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