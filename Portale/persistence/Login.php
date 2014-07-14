<?php

    $host = "localhost";
    $username = "root";
	$password = "";
	$db = "clinical_data";

	$connection = mysql_connect("$host","$username", "$password" );
	
	if(!$connection) {
		die("Unable to connect" . mysql_error());
	}
	
	mysql_select_db("$db",$connection);

   
   $myusername=$_POST['myusername']; 
   $mypassword=$_POST['mypassword'];
   $rememberme=$_POST['rememberme'];
   
   
   $myusername = stripslashes($myusername);
   $mypassword = stripslashes($mypassword);
   $myusername = mysql_real_escape_string($myusername);
   $mypassword = mysql_real_escape_string($mypassword);
   $sql="SELECT * FROM administrators WHERE username='$myusername' and password='$mypassword'";
   $result=mysql_query($sql);
   
   $count=mysql_num_rows($result);
   
   if($count==1) {
   		session_start();
   		$_SESSION["myusername"]=$myusername;
	    $_SESSION["mypassword"]=$mypassword; //perch��?

		header("location:LoginSuccess.php");
   		
   }
   else {
   		session_start();
   		$_SESSION["count"] = $count;
		header("location:../view/HomePage.php");
   }
   
   
   
?>