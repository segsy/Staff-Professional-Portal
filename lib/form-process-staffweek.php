<?php 
include("config.php");
include("common.php");
include("function.php");
/*
title: brother
gender: male
fname: 
lname: 
jobfamily: 1
zone: hq
date_training: 
prof_level: beginner
take_course: yes
preffered_time: morning
*/

//require_once('lib/recaptcha/recaptchalib.php');

	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 

$json = array();
$title = isset( $_POST['title'] ) ? ucwords(escape_s($_POST['title'])) : '';
$gender  = isset( $_POST['gender'] ) ? ucwords(escape_s($_POST['gender'])) : '';
$fname = isset( $_POST['fname'] ) ? escape_s($_POST['fname']) : '';
$lname = isset( $_POST['lname'] ) ? escape_s($_POST['lname']) : '';
$jobfamily  = isset( $_POST['jobfamily'] ) ? escape_s($_POST['jobfamily']) : '';
$zone  = isset( $_POST['zone'] ) ? ucwords(escape_s($_POST['zone'])) : '';
$date_training  = isset( $_POST['date_training'] ) ? escape_s($_POST['date_training']) : '';
$prof_level  = isset( $_POST['prof_level'] ) ? escape_s($_POST['prof_level']) : '';
$take_course = isset( $_POST['take_course'] ) ? escape_s($_POST['take_course']) : '';
$preffered_time = isset( $_POST['preffered_time'] ) ? escape_s($_POST['preffered_time']) : '';


if( !$fname ) {
    $json['error']['fname'] = 'Please enter your first name.';
}
if( !$lname ) {
    $json['error']['lname'] = 'Please enter your last name.';
}
if( !$date_training ) {
    $json['error']['date_training'] = 'Please enter last time you received one';
}

if( !isset( $json['error'] ) ) {
//$i = genRand();
$a = array();


  if(query("INSERT INTO training_staffweek (title,gender,firstname,lastname,jobfamily,zone,date_training,prof_level,take_course,preffered_time,status,date_created ) VALUES ('$title','$gender','$fname','$lname','$jobfamily','$zone','$date_training','$prof_level','$take_course','$preffered_time','1',NOW() )")){

        $json['success'] = 'Thank you, your information has been recieved and we will get back to you shortly';
}else{

	    $json['error']['reg'] = 'Server error, please check back later';

}
 
 /*
INSERT INTO `cpdp`.`training_staffweek`
(`id`,
`title`,
`gender`,
`firstname`,
`lastname`,
`jobfamily`,
`zone`,
`date_training`,
`prof_level`,
`take_course`,
`preffered_time`,
`status`,
`date_created`)
VALUES
(<{id: }>,
<{title: }>,
<{gender: }>,
<{firstname: }>,
<{lastname: }>,
<{jobfamily: }>,
<{zone: }>,
<{date_training: }>,
<{prof_level: }>,
<{take_course: }>,
<{preffered_time: }>,
<{status: }>,
<{date_created: 0000-00-00 00:00:00}>);

 */



}

echo json_encode( $json );

}

?>