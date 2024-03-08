<?php 
include("config.php");
include("common.php");
include("function.php");

//require_once('lib/recaptcha/recaptchalib.php');

	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$json = array();
$title = isset( $_POST['title'] ) ? ucwords(escape_s($_POST['title'])) : '';
$fname = isset( $_POST['fname'] ) ? escape_s($_POST['fname']) : '';
$lname = isset( $_POST['lname'] ) ? escape_s($_POST['lname']) : '';
$phoneNumber = isset( $_POST['phoneNumber'] ) ? escape_s($_POST['phoneNumber']) : '';
$email = isset( $_POST['email'] ) ? escape_s($_POST['email']) : '';
$department  = isset( $_POST['department'] ) ? ucwords(escape_s($_POST['department'])) : '';
$jobfunction  = isset( $_POST['jobfunction'] ) ? escape_s($_POST['jobfunction']) : '';
$take_course = isset( $_POST['take_course'] ) ? escape_s($_POST['take_course']) : '';
$take_course_review_yes  = isset( $_POST['take_course_review_yes'] ) ? $_POST['take_course_review_yes'] : '';
$take_course_review_no  = isset( $_POST['take_course_review_no'] ) ? ($_POST['take_course_review_no']) : '';
$take_course_review_other_reason  = isset( $_POST['take_course_review_other_reason'] ) ? escape_s($_POST['take_course_review_other_reason']) : '';
$onsite_training = isset( $_POST['onsite_training'] ) ? escape_s($_POST['onsite_training']) : '';
$onsite_training_review_yes = isset( $_POST['onsite_training_review_yes'] ) ? escape_s($_POST['onsite_training_review_yes']) : '';

$jobPerf = isset( $_POST['jobPerf'] ) ? escape_s($_POST['jobPerf']) : '';
$trainPerf = isset( $_POST['trainPerf'] ) ? escape_s($_POST['trainPerf']) : '';
$persTrainNeeds1 = isset( $_POST['persTrainNeeds1'] ) ? escape_s($_POST['persTrainNeeds1']) : '';
$persTrainNeeds2 = isset( $_POST['persTrainNeeds2'] ) ? escape_s($_POST['persTrainNeeds2']) : '';
$persTrainNeeds3 = isset( $_POST['persTrainNeeds3'] ) ? escape_s($_POST['persTrainNeeds3']) : '';
$persTrainNeeds4 = isset( $_POST['persTrainNeeds4'] ) ? escape_s($_POST['persTrainNeeds4']) : '';
$persTrainNeeds5 = isset( $_POST['persTrainNeeds5'] ) ? escape_s($_POST['persTrainNeeds5']) : '';
$addComments = isset( $_POST['addComments'] ) ? escape_s($_POST['addComments']) : '';


if( !$fname ) {
    $json['error']['fname'] = 'Please type your first name.';
}
if( !$lname ) {
    $json['error']['lname'] = 'Please type your last name.';
}
if( !$phoneNumber ) {
    $json['error']['phoneNumber'] = 'Please type your kingschat number';
}
if( !$email ) {
    $json['error']['email'] = 'Please type your email address';
}
if( !$department ) {
    $json['error']['department'] = 'Please type your department';
}
if( !$jobfunction ) {
    $json['error']['jobfunction'] = 'Please type your job function';
}


if( !$jobPerf ) {
    $json['error']['jobPerf'] = 'Please select an option';
}
if( !$trainPerf ) {
    $json['error']['trainPerf'] = 'Please select an option';
}


if( !$take_course ) {
    $json['error']['take_course'] = 'Please select an option';
}else{

	if( $take_course == 'yes'){
			if( !$take_course_review_yes ) {
			    $json['error']['take_course_review_yes'] = 'Please select an option';
			}	
	}else{
			if( !$take_course_review_no ) {
			    $json['error']['take_course_review_no'] = 'Please select an option';
			}else{
				if($take_course_review_no  = 'other-reason'){
					if( !$take_course_review_other_reason ) {
					    $json['error']['take_course_review_other_reason'] = 'Please type your other reasons';
					}						
				}
			}	
	}
}

// if( !$training_needed ) {
//     $json['error']['training_needed'] = 'Please type your training_needed';
// }

if( !$onsite_training ) {
    $json['error']['onsite_training'] = 'Please select an option';

}else{
	if( $onsite_training == 'yes'){
		if( !$onsite_training_review_yes ) {
		    $json['error']['onsite_training_review_yes'] = 'Please select an option';
		}
	}	

}

if( !isset( $json['error'] ) ) {
//$i = genRand();
$a = array();

/*
CREATE TABLE `training_gap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL DEFAULT '',
  `firstname` varchar(225) NOT NULL DEFAULT '',
  `lastname` varchar(225) NOT NULL DEFAULT '',
  `department` varchar(225) NOT NULL DEFAULT '',
  `jobfunction` varchar(225) NOT NULL DEFAULT '',
  `take_course` varchar(10) NOT NULL,
  `take_course_review_yes` varchar(225) NOT NULL DEFAULT '',
  `take_course_review_no` varchar(225) NOT NULL DEFAULT '',
  `take_course_review_other_reason` varchar(255) DEFAULT '',
  `onsite_training` varchar(10) NOT NULL DEFAULT '',
  `onsite_training_review_yes` varchar(255) NOT NULL DEFAULT '',
  `jobPerf` varchar(45) DEFAULT NULL,
  `trainPerf` varchar(45) DEFAULT NULL,
  `persTrainNeeds1` varchar(255) DEFAULT NULL,
  `persTrainNeeds2` varchar(255) DEFAULT NULL,
  `persTrainNeeds3` varchar(255) DEFAULT NULL,
  `persTrainNeeds4` varchar(255) DEFAULT NULL,
  `persTrainNeeds5` varchar(255) DEFAULT NULL,
  `addComments` text,
  `status` varchar(45) NOT NULL DEFAULT '',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

*/


  if(query("INSERT INTO training_gap (title,firstname,lastname,email,phoneNumber,department,jobfunction,take_course,take_course_review_yes,take_course_review_no,take_course_review_other_reason,onsite_training,onsite_training_review_yes,jobPerf,trainPerf,persTrainNeeds1,persTrainNeeds2,persTrainNeeds3,persTrainNeeds4,persTrainNeeds5,addComments,status,date_created ) VALUES ('$title','$fname','$lname','$email','$phoneNumber','$department','$jobfunction','$take_course','$take_course_review_yes','$take_course_review_no','$take_course_review_other_reason','$onsite_training','$onsite_training_review_yes','$jobPerf','$trainPerf','$persTrainNeeds1','$persTrainNeeds2','$persTrainNeeds3','$persTrainNeeds4','$persTrainNeeds5','$addComments','1',NOW() )")){

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