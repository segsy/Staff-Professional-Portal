<?php
session_start();

ini_set('display_errors', 1);

error_reporting(E_ALL | E_STRICT);

// include("webAnalyticsCPDP.php");

if(isset($_GET['logout']))

{

  session_destroy();

  header("Location:login.php?status=logout");

}





//$db_user = 'cpdp_me';                             /* Database User */

//$db_pass = 'eCsAs5)3+ai&';                              /* Database Password  */

//$db_host = 'localhost';                          /* Database Host */

//$db_name = 'cpdp_portal';


$db_user = 'root';                             /* Database User */

$db_pass = '';                              /* Database Password  */

$db_host = 'localhost';                          /* Database Host */

$db_name = 'cpdp';





$tbl_program = 'training_program';
$tbl_category = 'training_category';
$tbl_jobfamily = 'training_jobfamily';
$tbl_answer = 'training_answer';
$tbl_lesson = 'training_lesson';
$tbl_course = 'training_course';
$tbl_record = 'training_record';
$tbl_user = 'training_user';
$tbl_proffessional = 'training_proffessional';



define('ENCRYPT_PASS', 'lwnm2016#@%^&1kforaskthe');



date_default_timezone_set('America/New_York');



$max_upload_size = 5120000;                                               /* 1024000  = 1 MB */

$thumb_folder = '../upload/';                                               /* Upload Directory */

$file_folder = '../files/';                                               /* Upload Directory */

$allowedExtensions = array("jpg", "jpeg", "png");                 /*Allowed Upload Image Extension */

$allowedFileExtensions = array("doc", "docx", "pdf", "ppt", "pptx", "pps");                 /*Allowed Upload Image Extension */

//$allowedExtensions = array("jpg", "jpeg", "gif", "png");                 /*Allowed Upload Image Extension */











// check if our Database connection is successfull to store the info in DB else remove this part

$dbCon = mysqli_connect($db_host, $db_user, $db_pass, $db_name );

if (mysqli_connect_errno()) 

{

  $valid_file = false;

  $message = 'MysQl Error '.mysqli_connect_error();

}



?>
