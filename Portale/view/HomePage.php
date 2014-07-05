<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Istituto Mendel</title>

		<!-- Bootstrap -->
		<!-- css -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link href="HomePage.css" rel="stylesheet" type="text/css">
		<!-- javascript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		
		
		
		
		<h1><span style="color:#228B22"><strong><p class="text-center">ISTITUTO DI RICERCA MENDEL</p> </strong> </span></h1>
		<h2><em><p class="text-center">Studio e analisi della Sindrome di Joubert</p></em></h2>
		<p class="text-center">
		<img src="logoMendel.jpg" id="imglogo" style="margin-left: 6.5cm; margin-top: 1cm" alt="immagine non visualizzata"/>
		</p>
		<div class="container">
		<form class="form-signin" id="formLogin" method="post" action="../persistence/Login.php" style="margin-right: 1cm; margin-top:-1cm" role="form">
			<h2 class="form-signin-heading" style="color:#228B22">Admin login</h2>
				<input name="myusername" type="text" class="form-control"  placeholder="Administrator" required autofocus>
        		<input name="mypassword" type="password" class="form-control" placeholder="Password" required>
        		<label class="checkbox" style="color:#228B22">
          		<input type="checkbox" name:"rememberme" value="yes" > Remember me
        		</label>
			<button name="submit" onclick="" class="btn btn-lg btn-success btn-block" type="submit">login</button> <!--onclick?! -->
		</form>
		
		</div> 
		
		<?php
		session_start();
		if (isset($_SESSION["count"]) ) {
		$count = $_SESSION["count"];
				if ($count == 0) {
				print "<div class='alert alert-danger' role='alert' style='width:5cm;margin-left: 26.5cm; margin-top:-2cm'>
					<strong>Attenzione!</strong><br>
					Username o Password errati.<br>
					<a class='alert-link'></a>
					</div>";
				}
		}
		//provaaaaaaaaa
		?>
		
		
		
		<p class="text-center">
		<button type="button"  class="btn btn-success" onclick="location.href='Query.html'" value="go" style="margin-top: -7cm; margin-left: 6cm" class="buttonStar">
			Effettua una ricerca
		</button>
		</p>
		
		<p class="text-center">
		<img src="logoRomaTre.jpg" id="imglogoRM3" style="margin-top: 2cm; margin-right:4cm" alt="immagine non visualizzata"/>
		</p>
		
		
		<address>
			<p class="text-center"id="add" style="margin-right: 1cm; margin-top: 1.7cm">
				<strong>Con la collaborazione di:</strong>
				<br>
				<em>Lorenzo Martucci</em>
				<br>
				<em>Claudia Raponi</em>
				<br>
				<em>Luca Tomaselli</em>
				<br>
			</p>
		</address>
		
		

		<address>
			<p class="text-center" style="margin-top: 2cm; margin-right: 20cm">
				<strong>Istituto CSS-Mendel</strong>
				<br>
				Viale Regina Margherita 261, 00198 Roma
				<br>
				dal Lunedì al Venerdì, 09:00-18:00
				<br>
				<abbr title="Phone">Tel:</abbr> 06 4416 0515
			</p>
		</address>
		
	</body>
</html>