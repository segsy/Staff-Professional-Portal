<?php 
include("config.php");
include("common.php");
include("aes.php");

/**

{
    "status": true,
    "message": "Success",
    "user": {
        "title": "Pastor",
        "firstName": "Omolade ",
        "lastName": "Omisore",
        "designation": "Web and Mobile apps Development Asst. ",
        "emailAddress": "pst.l.omisore@loveworld360.com",
        "portalID": "104433",
        "picturePath": "https:\/\/portal1.blwonline.org\/user_res\/picture\/e\/104433.jpg",
        "maritalStatus": "Single",
        "gender": "Male",
        "deptID": "143",
        "rankID": "4",
        "nationality": "Nigeria",
        "jobFamily": "3",
        "subDept": null,
        "rankName": "Senior Administrator",
        "jobFamilyName": "IT",
        "deptName": "LoveWorld New Media"
    }
}

*/

//https://portal1.blwonline.org/auth/externalauth?apiKey=12RT5HWI9Y00FFG3&portalID=104433&password=73490

$_post = array(
  'apiKey' => "12RT5HWI9Y00FFG3",
  'portalID' => "104433",
  'password' => "73490",
);


$c_post = _curl_post($_post);
//print_r($c_post);
$c_post = json_decode($c_post, true);
if(!$c_post['status']){
    echo $c_post['message'];
}else{
echo $c_post['user']['firstName'];
}

?>