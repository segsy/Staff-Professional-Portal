<?php 
include("config.php");
include("common.php");
include("browser.php");


if(!isset($_SESSION['_access'])){
   die("login");
  }
if(!isset($_SESSION['_q_user']['_log_type'])){
   die("login");
  }


  if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$_a  = isset( $_POST['a_'] ) ? escape_s($_POST['a_']) : '';
$_id   = $_SESSION['_q_user']['_id'];

switch ($_a) {
  case 'l':
      query("UPDATE training_login SET last=NOW() WHERE user='$_id'");
    break;
  case 'v':
$_page  = isset( $_POST['page'] ) ? escape_s($_POST['page']) : '';
      query("INSERT IGNORE INTO training_visit (user,page,os,osv,browser,broswerv,session,ip,date) VALUES ('$_id','$_page','$_os','$_osv','$_browser','$_browserv','$_session','$_ip',NOW())");
    break;
}


}
?>