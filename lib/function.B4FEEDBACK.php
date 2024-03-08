<?php
define("U_PAGE",basename($_SERVER['PHP_SELF']));
//echo U_PAGE;


function getLessonsNo($c){
    global $dbCon;
    global $tbl_lesson;
    $op = "<option value=\"\"> Select A Lesson No</option>";

    switch ($c) {
      case 'n':
      $sq ="";
        break;
      default:
      $sq =" AND  course_id='$c'";
      break;
    }
//$query = query("SELECT * FROM $tbl_lesson ORDER BY date ASC");
$query = query("SELECT * FROM $tbl_lesson WHERE type='l' $sq");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
$lesson=$row['lesson'];    
$op .= "<option value=\"$lesson\"> Lesson $lesson</option>";
  }       
}else{
    $op = "<option value=\"1\"> Lesson 1</option>";
}
return $op;
  }


function getAllCourse(){
    global $dbCon;
    global $tbl_course;
    $op = "<option value=\"\"> Select A Course</option>";

$query=query("SELECT * FROM $tbl_course ORDER BY date ASC");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
$id=$row['id'];    
$title=$row['title'];    
$op .= "<option value=\"$id\"> $title</option>";
  }       
}else{}
return $op;
  }


function getAllCategory(){
    global $dbCon;
    global $tbl_category;
    $op = "<option value=\"\"> Select A Category</option>";

$query=query("SELECT * FROM $tbl_category ORDER BY date ASC");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
$id=$row['id'];    
$title=$row['title'];    
$op .= "<option value=\"$id\"> $title</option>";
  }       
}else{}
return $op;
  }



function getDepts(){
    global $dbCon;
    global $tbl_course;
   // $op = "<option value=\"\"> Select Department</option>";
    $op = "";

$query=query("SELECT * FROM training_dept ORDER BY name ASC");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
$id=$row['id'];    
$name=$row['name'];    
      if(!empty($name)) {
      $op .= "<option value=\"$id\"> $name</option>";
      }
  }       
}else{}
return $op;
  }

function getDeptById($i){
$query=query("SELECT name FROM training_dept WHERE id = '$i' ");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
    return $row['name'];
  }       
}else{return false;}
  }


function getjobfamilys(){
    global $dbCon;
  //  $op = "<option value=\"\"> Select Job Family</option>";
    $op = "";

$query=query("SELECT * FROM training_jobfamily ORDER BY name ASC");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
$id=$row['id'];    
$name=$row['name'];    
      if(!empty($name)) {
      $op .= "<option value=\"$id\"> $name</option>";
      }

  }       
}else{}
return $op;
  }

function getJobfamilyById($i){
$query=query("SELECT name FROM training_jobfamily WHERE id = '$i' ");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
    return $row['name'];
  }       
}else{return false;}
  }



function getRanks(){
    global $dbCon;
   // $op = "<option value=\"\"> Select Rank</option>";
    $op = "";

$query=query("SELECT * FROM training_rank GROUP BY name ORDER BY name ASC");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
$id=$row['id'];    
$name=$row['name'];    
      if(!empty($name)) {
      $op .= "<option value=\"$id\"> $name</option>";
      }

  }       
}else{}
return $op;
  }

function getRankById($i){
$query=query("SELECT name FROM training_rank WHERE id = '$i' ");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
    return $row['name'];
  }       
}else{return false;}
  }



function getDesignations(){
    global $dbCon;
   // $op = "<option value=\"\"> Select Designation</option>";
    $op = "";

$query=query("SELECT designation FROM training_user WHERE designation != '99' GROUP BY designation");
$count=mysqli_num_rows($query);
if($count){
while($row=mysqli_fetch_array($query))
   {
      $designation=$row['designation'];   
      if(!empty($designation)) {
      $op .= "<option value=\"$designation\"> $designation</option>";
      }
  }       
}else{}
return $op;
  }




// display pagination
function print_pagination($numPages,$urlVars,$currentPage) {
   if ($numPages > 1) {
       if ($currentPage > 1) {
         $prevPage = $currentPage - 1;
         echo '<li class="paginate-previous"><a href="'. $urlVars .'&p='. $prevPage.'" title="'.$prevPage.'">Prev &laquo;</a></li> ';
     }     
     for( $e=0; $e < $numPages; $e++ ) {
           $p = $e + 1;
         if ($p == $currentPage) {      
           $class = 'active';
         } else {
             $class = 'paginate';
         } 
           echo '<li class="'. $class .'"><a href="'. $urlVars .'&p='. $p .'" title="'.$p.'">'. $p .'</a></li>';
     }
     if ($currentPage != $numPages) {
           $nextPage = $currentPage + 1;  
       echo ' <li class="paginate-next"><a href="'. $urlVars .'&p='. $nextPage.'" title="Next To Page '.$nextPage.'">Next &raquo;</a></li>';
     }       
   }
}




function timeago($date) {
       $timestamp = strtotime($date);   
       
       $strTime = array("second", "minute", "hour", "day", "month", "year");
       $length = array("60","60","24","30","12","10");

       $currentTime = time();
       if($currentTime >= $timestamp) {
            $diff     = time()- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
       }
    }
?>