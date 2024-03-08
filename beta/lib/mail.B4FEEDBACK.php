<?php



function mailEnrollment($mssg,$name,$subject,$e){
$html = file_get_contents('mailtemplate.html'); 
$html = str_replace('%message%', $mssg, $html); 
$html = str_replace('%name%', $name, $html); 

$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->From = 'no-reply@cpdp.me';
$mail->FromName = "Continous Professional Development Portal";
$mail->AddAddress("epebinuoluwafemi@gmail.com", "Epebinu oluwafemi");
$mail->addReplyTo($name, $e);
 
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->Subject = "CPDP: ".$subject;
$mail->MsgHTML($html);
if(!$mail->Send()) {
    return 'Your message cant be relay, please try again '. $mail->ErrorInfo;
     }else{
      return true;
     }
}



function mailContact($mssg,$name,$subject,$e,$dept,$rank,$jobfamily){
//$mssg = html_entity_decode($mssg);
$html = file_get_contents('mailtemplate.html'); 
$html = str_replace('%message%', $mssg, $html); 
$html = str_replace('%name%', $name, $html); 
$html = str_replace('%dept%', $dept, $html); 
$html = str_replace('%rank%', $rank, $html); 
$html = str_replace('%jobfamily%', $jobfamily, $html); 

$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->From = 'no-reply@cpdp.me';
$mail->FromName = "Continous Professional Development Portal";
$mail->AddAddress("cpdp@loveworld360.com", "Continous Professional Development Portal");
$mail->AddAddress("epebinuoluwafemi@gmail.com", "Epebinu oluwafemi");
$mail->addReplyTo($e, $name);
 
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->Subject = "CPDP: ".$subject;
$mail->MsgHTML($html);
if(!$mail->Send()) {
    return 'Your message cant be relay, please try again '. $mail->ErrorInfo;
     }else{
      return true;
     }
}


function mailContactSender($mssg,$name,$subject,$e){
$html = file_get_contents('mailtemplate.html'); 
$html = str_replace('%message%', $mssg, $html); 
$html = str_replace('%name%', $name, $html); 

$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->From = 'no-reply@cpdp.me';
$mail->FromName = "Continous Professional Development Portal";
$mail->AddAddress("epebinuoluwafemi@gmail.com", "Epebinu oluwafemi");
$mail->addReplyTo($name, $e);
 
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->Subject = "CPDP: ".$subject;
$mail->MsgHTML($html);
if(!$mail->Send()) {
    return 'Your message cant be relay, please try again '. $mail->ErrorInfo;
     }else{
      return true;
     }
}


?>