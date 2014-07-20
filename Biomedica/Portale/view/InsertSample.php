<?php
error_reporting(0);  
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Istituto Mendel</title>

		<!-- Bootstrap -->
		<!-- css -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link href="TemplateAdmin.css" rel="stylesheet" type="text/css">
		<!-- javascript -->
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
	</head>
	<body id="body">
		<ul class="pager" style="float:top; float:left; margin-left: 1cm; margin-top: 1cm" onclick="location.href='TasksManagement.php'">
			<li class="prev">
				<a href="#"> &#8592 Cambia Attivit&agrave</a>
			</li>
		</ul>
		
		<div class="panel panel-info"style="float:right; float:top; margin-top:1cm; margin-right:1cm; width:5cm;height:3cm;">
			<div class="panel-heading">
				<h3 class="panel-title"></h3>
			</div>
			<div class="panel-body">
				<span class="glyphicon glyphicon-user"></span>
				<?php
				session_start();
				if (isset($_SESSION["myusername"]))
					print "Benvenuto <strong> " . $_SESSION["myusername"];
				else {
					echo "<meta http-equiv=refresh content='0; url=Unauthorized.php'>";
					exit;
				}
				?>
				</strong>
				<br>
				<br>
				<button type="button" class="btn btn-primary btn-sm"style="margin-left: 3cm" onclick="location.href='../persistence/Logout.php'">
					Esci
				</button>
			</div>
		</div>
		
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 6cm; margin-top: 1.5cm" alt="immagine non visualizzata" width="130" height="150"/>

		<h3 style="margin-top: 1.5cm">
		<br>
		Studio e analisi
		<br>
		della Sindrome di Joubert</h3>

		<br>
		<h2><p style="color: #228B22; margin-top:2cm; margin-bottom:1cm;" class="text-center">Scegli la modalit&agrave di inserimento</p></h2>

		<p class="text-center">
			<button type="button"  class="btn btn-success" onclick="location.href='InsertSingleSample.php'" value="go"
			style="margin-top: 2cm; margin-left: -8cm" class="buttonStar">
				Inserisci singolo campione
			</button>
		</p>

		<p class="text-center">
			<button type="button"  class="btn btn-success" onclick="location.href='InsertSequencing.php'" value="go"
			style="margin-top: -2cm; margin-left: 7.5cm" class="buttonStar">
				Inserisci un intero sequenziamento
			</button>
		</p>

		<div class="alert alert-dismissable alert-danger fade in" style="width:10cm;margin-left: 21cm">
			<button type="button" id="close" class="close" data-dismiss="alert" aria-hidden="true">
				&times;
			</button>
			<strong>Attenzione!</strong>
			<br>
			Se decidi di inserire un intero sequenziamento accertati che il file Excel di input rispetti lo standard.
			<br>
			<a href="ExcelExample.png" class="alert-link">
			<p align="right">
				Visualizza lo standard
			</p></a>
		</div>

		
	</body>
</html>