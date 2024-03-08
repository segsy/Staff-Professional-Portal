<?php

function stopreferer(){

if(empty($_SERVER['HTTP_REFERER']))

die('Access Denied');

}



function query($sql) {

    global $dbCon;

$que=mysqli_query($dbCon, $sql);

if (!$que) {

    throw new Exception(mysqli_error($dbCon));

}

    return $que;

}

//$str;

function escape_s($s) {

    global $dbCon;

    return mysqli_real_escape_string($dbCon, htmlentities($s, ENT_QUOTES));

}





function genRand($length=20)

{

  //$chars ="abcdefghijkmnopqrstuvwxyz023456789";//length:36

  $chars ="abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNOPQRSTUVWXYZ";//length:36

  $final_rand='';

  for($i=0;$i<$length; $i++)

  {

    $final_rand .= $chars[ rand(0,strlen($chars)-1)];



  }

  return str_replace('.', null, trim($final_rand));

 // return $final_rand;

}







function changeTitle($t){

  $t = trim($t);

  $t = strtolower($t);

  switch ($t) {

      case 'sister':

        $nt = "Sis.";

        break;

      case 'brother':

        $nt = "Bro.";

        break;

      case 'pastor':

        $nt = "Pst.";

        break;

      

      default:

        $nt = ucwords($t);

        break;

    }

  

  return $nt;

  }





function abbrevJobFamily($t){

  $t = trim($t);

  $t = strtolower($t);

  switch ($t) {

      case 'specialist - entertainment and arts':

        $nt = "Spec- Ent.. & Arts.";

        break;

      

      default:

        $nt = ucwords($t);

        break;

    }

  

  return $nt;

  }





function abbrevDept($t){

  $b4 =$t;

  $t = trim($t);

  $t = strtolower($t);

  switch ($t) {

      case 'loveworld new media':

        $nt = "LWNM";

        break;

      case 'inner city mission':

        $nt = "ICM";

        break;

      case 'loveworld plus':

        $nt = "LWPLUS";

        break;

      case 'loveworld media training products':

        $nt = "LWMTP";

        break;

      case 'rhapsody of realities':

        $nt = "ROR.";

        break;

      case 'audio visuals department':

        $nt = "AVD";

        break;

      case 'office of the chief of staff':

        $nt = "OCOS";

        break;

      case 'ce lagos zone 5':

        $nt = "CELAGZ5";

        break;

      case 'lagos zone 2 - hq':

        $nt = "LAGZ2-HQ";

        break;

      case 'lagos zone 1 - hq':

        $nt = "LAGZ1-HQ";

        break;

      case 'healing school':

        $nt = "HS";

        break;

      case 'loveworld media operations':

        $nt = "LWMO";

        break;

      case 'ce lagos zone 2':

        $nt = "CELAGZ2";

        break;

      case 'loveworld media mobile platform videos':

        $nt = "LWMMPV";

        break;

      case 'ltm and radio':

        $nt = "LTM & Radio";

        break;

      case 'internet multimedia':

        $nt = "IMM";

        break;

      case 'healing school':

        $nt = "HS";

        break;

      case 'healing school':

        $nt = "HS";

        break;

      

      default:

        //$nt = ucwords($t);

        $nt = $b4;

        break;

    }

  

  return $nt;

  }



function isValidEmail($email){ 

    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

}





function _curl_post($p) 

 { 

//check if you have curl loaded

if(!function_exists("curl_init")) die("Error: </strong> cURL extension is not installed");

// create a new cURL resource

$ch = curl_init();

// set URL and other appropriate options

curl_setopt($ch, CURLOPT_POST, 1);

//curl_setopt($ch, CURLOPT_URL, "https://portal1.blwonline.org/auth/externalauth");
curl_setopt($ch, CURLOPT_URL, "https://www.blwstaffportal.org/auth/externalauth");

curl_setopt($ch, CURLOPT_POSTFIELDS, $p);

curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_TIMEOUT, 40);

// grab URL and pass it to the browser

$output = curl_exec($ch);

   if (curl_error($ch)){

     $output .= "STATUSERROR::". curl_error($ch);

   }

// close cURL resource, and free up system resources

 curl_close($ch);  

 return $output;  



}









/*





DROP FUNCTION IF EXISTS alphas;

DELIMITER | 

CREATE FUNCTION alphas( str CHAR(32) ) RETURNS CHAR(16) 

BEGIN 

  DECLARE i, len SMALLINT DEFAULT 1; 

  DECLARE ret CHAR(32) DEFAULT ''; 

  DECLARE c CHAR(1);

  SET len = CHAR_LENGTH( str ); 

  REPEAT 

    BEGIN 

      SET c = MID( str, i, 1 ); 

      IF c REGEXP '[[:alpha:]]' THEN 

        SET ret=CONCAT(ret,c); 

      END IF; 

      SET i = i + 1; 

    END; 

  UNTIL i > len END REPEAT;

  RETURN ret; 

END | 

DELIMITER ;

UPDATE training_lesson SET id=alphas(id);





*/

?>