<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 

$json       =  array();
$_a         = isset( $_POST['_a'] ) ? escape_s($_POST['_a']) : '';
$_id        = $_SESSION['_q_user']['_id'];
$_assingment  = isset( $_POST['_i'] ) ? escape_s($_POST['_i']) : '';

$_gen_file = $_assingment.$_id;
//print_r($_FILES);
//die(); 
             //if they DID upload a file...
  if($_FILES['a_file']['name']){

    $file_thumb = $_FILES['a_file']; 
    list($otherpartt, $extension) = explode(".", strtolower($_FILES["a_file"]["name"]));
    //$extension = end();
    $currentdir = '';

        // check if picture size is more than allowed in config
      if($_FILES['a_file']['size'] > ($max_upload_size)) //can't be larger than 1 MB
      {
          $json['error']['file']= 'Oops!  Your file\'s size is to large.';
      }

        // check if picture type is within allowed Extensions
      if (!in_array( $extension,  $allowedFileExtensions)) 
      { 
            $json['error']['file'] = ' Invalid file type!';
      }

      // if folder doesnt exit, create it
    if(!is_dir($currentdir . $file_folder)){
       // create the directory
        if (!mkdir($currentdir . $file_folder, 0777, true)) {
           $json['error']['upload'] = 'Unable to Create Upload directory';
        }
    }

  }else{
        $json['error']['file'] = 'Upload a valid file type';

  }






if( !isset( $json['error'] ) ) {

switch ($_a) {
    case 'new':

             if($_FILES['a_file']['name']){
                $file_thumb = $_FILES['a_file']; 
                list($otherpartt, $extension) = explode(".", strtolower($_FILES["a_file"]["name"]));
                $currentdir = '';
                $target =  $file_folder . $_gen_file.'.'.$extension;
                    // check if picture thumbnail already exist

               if($_FILES['a_file']['name'])
                  {
                          move_uploaded_file($_FILES['a_file']['tmp_name'], $target);
                 }
              }



        if(query("INSERT INTO $tbl_answer(user,assignment,type,content,date)
        VALUES('$_id','$_assingment','0','$_gen_file.$extension',NOW())")){
                $json['success'] = 'Assignment has been submitted!';
        }else{
            $json['error']['course'] = 'Server error, please check back later';
        }
        break;
    
     case 'edit':
/*
        $_c  = isset( $_POST['_c'] ) ? escape_s($_POST['_c']) : '';
              if($_FILES['a_file']['name']){
                $file_thumb = $_FILES['a_file']; 
                list($otherpartt, $extension) = explode(".", strtolower($_FILES["a_file"]["name"]));
                $currentdir = '';
                $target =  $thumb_folder . $_c.'.'.$extension;
                    // check if picture thumbnail already exist
               if($_FILES['a_file']['name'])
                  {
                          move_uploaded_file($_FILES['a_file']['tmp_name'], $target);
                 }
              }


        if(query("UPDATE $tbl_course SET title='$_title', duration='$_duration', summary='$_summary', description='$_code' WHERE id='$_c'")){
                $json['success'] = 'Course Updated!';
        }else{
            $json['error']['course'] = 'Server error, please check back later';
        }     
        */   
        break;  
default:
        # code...

        break;
}





}

echo json_encode( $json );

}

?>