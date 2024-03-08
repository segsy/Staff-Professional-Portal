<?php 
include("config.php");
include("common.php");
include("function.php");
include("passwordLib.php");
/*
include("browser.php");
include("class.phpmailer.php");

title:brother
gender:male
mstatus:single
r_fname:Oluwafemi
r_lname:Epebinu
r_pasword:joketwo
r_password2:joketwo
r_email:epebinuoluwafemi@gmail.com
r_phone:07088281068
r_dept:147
r_family:2
r_rank:10
r_designation:Administration


*/
//require_once('lib/recaptcha/recaptchalib.php');



	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 

$json = array();
$title = isset( $_POST['title'] ) ? ucwords(escape_s($_POST['title'])) : '';
$dept  = isset( $_POST['r_dept'] ) ? escape_s($_POST['r_dept']) : '';
$mstatus  = isset( $_POST['mstatus'] ) ? ucwords(escape_s($_POST['mstatus'])) : '';
$gender  = isset( $_POST['gender'] ) ? ucwords(escape_s($_POST['gender'])) : '';
$fname = isset( $_POST['r_fname'] ) ? escape_s($_POST['r_fname']) : '';
$lname = isset( $_POST['r_lname'] ) ? escape_s($_POST['r_lname']) : '';
$pass  = isset( $_POST['r_password'] ) ? escape_s($_POST['r_password']) : '';
$pass2  = isset( $_POST['r_password2'] ) ? escape_s($_POST['r_password2']) : '';
$email = isset( $_POST['r_email'] ) ? escape_s($_POST['r_email']) : '';
$phone = isset( $_POST['r_phone'] ) ? escape_s($_POST['r_phone']) : '';
$deptID = isset( $_POST['r_dept'] ) ? escape_s($_POST['r_dept']) : '';
$jobFamilyID = isset( $_POST['r_family'] ) ? escape_s($_POST['r_family']) : '';
$rankID = isset( $_POST['r_rank'] ) ? escape_s($_POST['r_rank']) : '';
$designation = isset( $_POST['r_designation'] ) ? escape_s($_POST['r_designation']) : '';

if( !$fname ) {
    $json['error']['fname'] = 'Please enter your first name.';
}
if( !$lname ) {
    $json['error']['lname'] = 'Please enter your last name.';
}


if( !$phone ) {
    $json['error']['phone'] = 'Please enter your phone number';
}
if( !$pass ) {
    $json['error']['pass'] = 'Please enter your password';
}

if(strcmp($pass,$pass2) !=0){
    $json['error']['pass2'] = 'password doesnt match';
}

if( !$email || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email ) ) {
    $json['error']['email'] = 'Invali email address.';
}


if( !isset( $json['error'] ) ) {
//$i = genRand();
$a = array();

$jobFamilyName = getJobfamilyById($jobFamilyID);
$rankName      = getRankById($rankID);
$deptName      = getDeptById($deptID);

//$e_p=encript(md5($pass));
$hash = password_hash($pass, PASSWORD_DEFAULT);
  if(query("INSERT INTO $tbl_user(id,email,password,title,firstname,lastname,dept,jobfamily_id,status,date,designation,rank,img,nationality,deptname,jobfamilyname,gender,maritalstatus,rank_id) VALUES('$email','$email','$hash','$title','$fname','$lname','$deptID','$jobFamilyID','2',NOW(),'$designation','$rankName','default','default','$deptName','$jobFamilyName','$gender','$mstatus','$rankID')  ON DUPLICATE KEY UPDATE date=NOW()")){


        $json['success'] = 'Thank you, your information has been recieved and we will get back to you shortly';
}else{

    $json['error']['reg'] = 'Server error, please check back later';

}
 



}

echo json_encode( $json );

}

?>