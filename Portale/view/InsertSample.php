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
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="body">
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 8.6cm; margin-top: 0cm" alt="immagine non visualizzata" width="130" height="150"/>

		<h3>
		<br>
		Studio e analisi
		<br>
		della Sindrome di Joubert</h3>

		<div class="panel panel-info"style="width:5cm;height:3cm;  margin-top:-2cm;  margin-left: 30cm">
			<div class="panel-heading">
				<h3 class="panel-title"></h3>
			</div>
			<div class="panel-body">
				<span class="glyphicon glyphicon-user"></span>
				<?php
				session_start();
				if (isset($_SESSION["myusername"]))
					print "Benvenuto <strong> " . $_SESSION["myusername"];
				else
					print "Sessione scaduta";
				?>
				</strong>
				<br>
				<br>
				<button type="button" class="btn btn-primary btn-sm"style="margin-left: 3cm" onclick="location.href='../persistence/Logout.php'">
					Esci
				</button>
			</div>
		</div>

		<p id="chooseText" style="margin-left: 8cm; margin-top: 2cm">
			<strong>Scegli la modalit&agrave di inserimento:</strong>
		</p>

		<p class="text-center">
			<button type="button"  class="btn btn-success" onclick="location.href='InsertSingleSample.php'" value="go"
			style="margin-top: 2cm; margin-left: -9.8cm" class="buttonStar">
				Inserisci singolo campione
			</button>
		</p>

		<p class="text-center">
			<button type="button"  class="btn btn-success" onclick="location.href='InsertSequencing.php'" value="go"
			style="margin-top: -2cm; margin-left: 4.8cm" class="buttonStar">
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

		<ul class="pager" style="margin-top: 1.2cm; margin-left: -30.5cm" onclick="location.href='TasksManagement.php'">
			<li class="prev">
				<a href="#"> &#8592 Cambia Attivit&agrave</a>
			</li>
		</ul>
	</body>
</html>