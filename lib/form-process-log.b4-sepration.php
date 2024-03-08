<?php 
include("config.php");
include("common.php");
include("aes.php");
include("passwordLib.php");




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



if( !isset( $json['error'] ) ) {
$a = array();
//$e_p=md5($pass);

            if(preg_match('/access_/i', $email)){

              //$admin_access     =str_replace('admin_', '', $email);

       // if($email == 'admin' || $email == 'records'){
          $hash1 = password_hash($pass, PASSWORD_DEFAULT);

            $sql=query("SELECT * FROM $tbl_user WHERE id='$email' ");
            $count=mysqli_num_rows($sql);
            if($count){ 
            while($rows=mysqli_fetch_array($sql))
               {
                         
           // $_pass=decript($rows['password']);
                if(password_verify($pass, $rows['password'])){
                 // if(strcmp($_pass,$e_p)==0)
                   // {
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
                        $a['_log_type']     =$rows['rank']; 
                        $a['_rank_id']     =$rows['rank_id']; 
                        $a['_gender']     =$rows['gender']; 
                        $a['_nationality']     =$rows['nationality']; 
                        $a['_new']      = false; 
                        $a['_time']     =time(); 

                       // $a['_log_type']     =str_replace('admin_', '', $email);

                            switch ($rows['rank']) {
                                case 'staff':
                                    $__loc = 'dashboard.php'; 
                                   break;
                                case 'manager':
                                    $__loc = 'course-all.php'; 
                                   break;
                                case 'records':
                                    $__loc = 'daily-report.php?day='.date('Y-m-d'); 
                                    break;
                            }
                           
                            $json['loc'] = $__loc;

                        $_SESSION['_q_user']=$a; 
                        $_SESSION['_access']= true; 

                        $json['success'] = 'kindly continue to access your account!';

                    }else{
                        $json['error']['log'] = 'Invalid login details ';
                       // $json['error']['pass'] = "Invalid Password $_pass    ====  $e_p";
                    }
                }

            }else{
                        $json['error']['log'] = 'Invalid login details ';
            }





        }else{


            // USE PORTAL LOGIN NOT AN ADMIN



         if(isValidEmail($email)){

            // USE EMAIL ADDRESS FOR LOGIN

          //die('Valid email');

//$hash = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 11));
$hash1 = password_hash($pass, PASSWORD_DEFAULT);



            $sql=query("SELECT * FROM $tbl_user WHERE id='$email' AND status='1' ");
            $count=mysqli_num_rows($sql);
            if($count){ 
            while($rows=mysqli_fetch_array($sql))
               {
                         
            //$_pass=decript($rows['password']);

                if(password_verify($pass, $rows['password'])){

                 // if(strcmp($_pass,$e_p)==0)
                  //  {



                        $a['_id']       =$rows['id'];; 
                        $a['_title']    =$rows['title']; 
                        $a['_email']    =$rows['email']; 
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
                        $a['_log_type'] = 'staff';


                        $json['loc'] = 'all-course.php';

                        $_SESSION['_q_user']=$a; 
                        $_SESSION['_access']= true; 

                        $json['success'] = 'kindly continue to access your account!';

                    }else{
                        $json['error']['log'] = 'Invalid login details ';
                      //  $json['error']['pass'] = "Invalid Password $pass    ====  $hash1 ".$rows['password'];
                    }
                }    
            }else{
                        $json['error']['log'] = 'Invalid login details ';
            }











         }else{

            // USE PORTAL ID FOR LOGIN

                $_post = array(
                  'apiKey' => "12RT5HWI9Y00FFG3",
                  'portalID' => $email,
                  'password' => $pass,
                );

                $cp_ = _curl_post($_post);
                $cp_ = json_decode($cp_, true);
//print_r($cp_['user']);
//die();
                if(!$cp_['status']){
                    $json['error']['log'] = $cp_['message'];
                  //echo $cp_['message'];
                }else{

                      if(query("INSERT INTO $tbl_user(id,email,title,firstname,lastname,dept,jobfamily_id,status,date,designation,rank,img,nationality,deptname,jobfamilyname,gender,maritalstatus,rank_id) VALUES('$email','".$cp_['user']['emailAddress']."','".$cp_['user']['title']."','".$cp_['user']['firstName']."','".$cp_['user']['lastName']."','".$cp_['user']['deptID']."','".$cp_['user']['jobFamily']."','1',NOW(),'".$cp_['user']['designation']."','".$cp_['user']['rankName']."','".$cp_['user']['picturePath']."','".$cp_['user']['nationality']."','".$cp_['user']['deptName']."','".$cp_['user']['jobFamilyName']."','".$cp_['user']['gender']."','".$cp_['user']['maritalStatus']."','".$cp_['user']['rankID']."')  ON DUPLICATE KEY UPDATE email='".$cp_['user']['emailAddress']."',title='".$cp_['user']['title']."', firstname='".$cp_['user']['firstName']."',lastname='".$cp_['user']['lastName']."',dept='".$cp_['user']['deptID']."',jobfamily_id='".$cp_['user']['jobFamily']."',designation='".$cp_['user']['designation']."',rank='".$cp_['user']['rankName']."',img='".$cp_['user']['picturePath']."',nationality='".$cp_['user']['nationality']."',deptname='".$cp_['user']['deptName']."',jobfamilyname='".$cp_['user']['jobFamilyName']."',gender='".$cp_['user']['gender']."',maritalstatus='".$cp_['user']['maritalStatus']."',rank_id='".$cp_['user']['rankID']."'")){

                          query("INSERT IGNORE INTO training_dept (id,name,date, status) VALUES ('".$cp_['user']['deptID']."','".$cp_['user']['deptName']."',NOW(), '1')");
                          query("INSERT INTO training_login (user,dept,designation,jobfamily,gender,date,last) VALUES ('$email','".$cp_['user']['deptID']."','".$cp_['user']['designation']."','".$cp_['user']['jobFamily']."','".$cp_['user']['gender']."',NOW(), NOW())");

                          query("INSERT IGNORE INTO training_rank (id,name,date,status) VALUES ('".$cp_['user']['rankID']."','".$cp_['user']['rankName']."',NOW(), '1')");
                          query("INSERT IGNORE INTO training_jobfamily (id,name,date,status) VALUES ('".$cp_['user']['jobFamily']."','".$cp_['user']['jobFamilyName']."',NOW(), '1')");


                                                      $a['_id']       =$email; 
                                                      $a['_title']    =$cp_['user']['title']; 
                                                      $a['_email']    =$cp_['user']['emailAddress']; 
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
                                                      $a['_log_type'] = 'staff';
                                                      $json['loc'] = 'all-course.php';
                                                      $_SESSION['_q_user']=$a; 
                                                      $_SESSION['_access']= true; 

                                                      $json['success'] = 'kindly continue to access your account!';

                              }

                       }

    }
}

echo json_encode( $json );


        }




}
/*
CREATE TABLE `lwnm`.`training_rank` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(125) NOT NULL DEFAULT '',
  `date` DATETIME NOT NULL DEFAULT 0,
  `status` NUMERIC(2) NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`)
)
ENGINE = InnoDB;


CREATE TABLE `lwnm`.`training_jobfamily` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(125) NOT NULL DEFAULT '',
  `date` DATETIME NOT NULL DEFAULT 0,
  `status` NUMERIC(2) NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`)
)
ENGINE = InnoDB;


CREATE TABLE `lwnm`.`training_login` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL DEFAULT '',
  `dept` VARCHAR(45) NOT NULL DEFAULT '',
  `designation` VARCHAR(45) NOT NULL DEFAULT '',
  `jobfamily` VARCHAR(45) NOT NULL DEFAULT '',
  `gender` VARCHAR(45) NOT NULL DEFAULT '',
  `date` DATETIME NOT NULL DEFAULT 0,
  `last` DATETIME NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`)
)
ENGINE = InnoDB;
*/
?>