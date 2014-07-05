<?php
    session_start();
	if (isset($_SESSION["myusername"]) || isset($_COOKIE["myusername"]) ) {
		
		header("location:../view/TasksManagement.php");
	}
	else 
		header("location:../view/HomePage.php");
?>

