<?php 
if(!isset($_SESSION['_q_user'])){
	  header("Location:login.php?status=logout");

}else{
	
	if($_SESSION['_q_user']['_log_type'] == 'staff'){
	    include"nav.php";
	} elseif($_SESSION['_q_user']['_log_type'] == 'manager'){
	    include"nav2.php";
	} elseif($_SESSION['_q_user']['_log_type'] == 'jfManager'){
	    include"nav4.php";
	} else{
		include"nav3.php";
	}

}

?>