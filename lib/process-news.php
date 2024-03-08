<?php 
include("config.php");
include("common.php");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json     = array();
$_a        = isset( $_POST['_a'] ) ? escape_s($_POST['_a']) : '';
$_title   = isset( $_POST['c_title'] ) ? escape_s($_POST['c_title']) : '';
$_summary = isset( $_POST['c_code'] ) ? escape_s($_POST['c_code']) : '';


if( !$_title ) {
    $json['error']['title'] = 'title is required';
}else{
    if(strlen($_title)  < 5 ) {
    $json['error']['title'] = 'Please your title is too short';
}
}



if( !$_summary) {
    $json['error']['summary'] = 'news content is is empty';
}






if( !isset( $json['error'] ) ) {

switch ($_a) {
    case 'new':


        if(query("INSERT INTO training_news(title,content,date)
        VALUES('$_title','$_summary',NOW())")){
                $json['success'] = 'news has been added!';
        }else{
            $json['error']['news'] = 'Server error, please check back later';
        }
        break;
    
     case 'edit':



        if(query("UPDATE training_news SET content='$_summary' WHERE id='$_c'")){
                $json['success'] = 'news Updated!';
        }else{
            $json['error']['news'] = 'Server error, please check back later';
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