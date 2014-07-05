<?php
session_start(); // inizializzo la sessione
session_unset(); // svuoto l'array $_SESSION
session_destroy(); // distruggo la sessione
setcookie("myusername", $myusername, time()-7600);

header("location:../view/HomePage.php");
?>