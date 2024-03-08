<?php 
include("config.php");
include("common.php");
include("aes.php");
/*
include("browser.php");
include("class.phpmailer.php");


ALTER TABLE `lwnm`.`q_user` ADD COLUMN `type` VARCHAR(45) NOT NULL DEFAULT '' AFTER `date`;



*/
//require_once('lib/recaptcha/recaptchalib.php');



	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
 
$email = isset( $_POST['l_email'] ) ? escape_s($_POST['l_email']) : '';
$pass  = isset( $_POST['l_password'] ) ? escape_s($_POST['l_password']) : '';

$json  = array();


if( !$pass ) {
    $json['error']['pass'] = 'Enter Your Staff Portal Password';
}

if( !$email ) {
    $json['error']['email'] = 'Enter Your Staff Portal ID';
}

/*
if( !$email || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email ) ) {
    $json['error']['email'] = 'Invali email address.';
}
*/


if( !isset( $json['error'] ) ) {
$a = array();
//$e_p=md5($pass);
$e_p=$pass;

// id,email,password,title,firstname,lastname,dept,jobfamily,status,date

$sql=query("SELECT * FROM training_user WHERE id='$email' ");
$count=mysqli_num_rows($sql);
if($count){ 
while($rows=mysqli_fetch_array($sql))
   {
             
$_pass=decript($rows['password']);              
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

  if(strcmp($_pass,$e_p)==0)
    {
        $a['_id']       =$rows['id'];; 
        $a['_title']    =$rows['title']; 
        $a['_fname']    =$rows['firstname']; 
        $a['_lname']    =$rows['lastname']; 
        $a['_dept']     =$rows['dept']; 
        $a['_deptname']     =$rows['deptname']; 
        $a['_jobfamily_id']   =$rows['jobfamily_id']; 
        $a['_jobfamilyname']  =$rows['jobfamilyname']; 
        $a['_img']     =$rows['img']; 
        $a['_designation']     =$rows['designation']; 
        $a['_rank']     =$rows['rank']; 
        $a['_rank_id']     =$rows['rank_id']; 
        $a['_gender']     =$rows['gender']; 
        $a['_nationality']     =$rows['nationality']; 
        $a['_new']      = false; 
        $a['_time']     =time(); 

        if($rows['rank_id'] == '99999'){
            $a['_pres']= true; 
            $json['loc'] = 'course-all.php';
       }else{
            $a['_pres']= false; 
            $json['loc'] = 'dashboard.php';
        }

        $_SESSION['_q_user']=$a; 
        $_SESSION['_access']= true; 

        $json['success'] = 'kindly continue to access your account!';

    }
    else{
        $json['error']['log'] = 'Invalid login details ';
       // $json['error']['pass'] = "Invalid Password $_pass    ====  $e_p";
    }
    
  } 
}else{
       // $json['error']['email'] = 'Invalid login details ';


                $_post = array(
                  'apiKey' => "12RT5HWI9Y00FFG3",
                  'portalID' => $email,
                  'password' => $pass,
                );

                $cp_ = _curl_post($_post);
                    $cp_ = json_decode($cp_, true);
                    if(!$cp_['status']){
                        $json['error']['log'] = $cp_['message'];
                      //echo $cp_['message'];
                    }else{
                //$e_p=encript(md5($pass));
                $e_p=encript($pass);

        if(query("INSERT INTO $tbl_user(id,email,password,title,firstname,lastname,dept,jobfamily_id,status,date,designation,rank,img,nationality,deptname,jobfamilyname,gender,maritalstatus,rank_id) VALUES('$email','".$cp_['user']['emailAddress']."','$e_p','".$cp_['user']['title']."','".$cp_['user']['firstName']."','".$cp_['user']['lastName']."','".$cp_['user']['deptID']."','".$cp_['user']['jobFamily']."','1',NOW(),'".$cp_['user']['designation']."','".$cp_['user']['rankName']."','".$cp_['user']['picturePath']."','".$cp_['user']['nationality']."','".$cp_['user']['deptName']."','".$cp_['user']['jobFamilyName']."','".$cp_['user']['gender']."','".$cp_['user']['maritalStatus']."','".$cp_['user']['rankID']."')")){


                                        $a['_id']       =$email; 
                                        $a['_title']    =$cp_['user']['title']; 
                                        $a['_fname']    =$cp_['user']['firstName']; 
                                        $a['_lname']    =$cp_['user']['lastName']; 
                                        $a['_dept']     =$cp_['user']['deptID']; 
                                        $a['_deptname']     =$cp_['user']['deptName']; 
                                        $a['_jobfamily_id']     =$cp_['user']['jobFamily']; 
                                        $a['_jobfamilyname']     =$cp_['user']['jobFamilyName']; 
                                        $a['_img']     =$cp_['user']['picturePath']; 
                                        $a['_designation']     =$cp_['user']['designation']; 
                                        $a['_rank']     =$cp_['user']['rankName']; 
                                        $a['_rank_id']     =$cp_['user']['rankID']; 
                                        $a['_gender']     =$cp_['user']['gender']; 
                                        $a['_nationality']     =$cp_['user']['nationality']; 

                                        $a['_new']      = true; 
                                        $a['_time']     =time(); 
                                        $a['_pres']= false; 
                                        $json['loc'] = 'all-course.php';
                                        $_SESSION['_q_user']=$a; 
                                        $_SESSION['_access']= true; 

                                        $json['success'] = 'kindly continue to access your account!';





        }







                    }



    }
/*

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


}

echo json_encode( $json );

}

?>