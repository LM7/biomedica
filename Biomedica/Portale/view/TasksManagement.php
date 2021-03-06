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
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link href="TemplateAdmin.css" rel="stylesheet" type="text/css">
		<!-- javascript -->
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		

	</head>
	<body id="body">
		
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
		
		
		
		
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 10.77cm; margin-top: 1.5cm" alt="immagine non visualizzata" width="130" height="150"/>

		<h3 style="margin-top: 1.5cm">
		<br>
		Studio e analisi
		<br>
		della Sindrome di Joubert</h3>	
		
		
		
		<p id="chooseText" style="margin-left: 10cm; margin-top:3cm"><strong>Scegli una tra le seguenti l'attivit&agrave:</strong></p>
		
		<p class="text-center">
		<button type="button"  class="btn btn-success" onclick="location.href='InsertSample.php'" value="go" 
		style="margin-top: 2cm; margin-left: -16cm" class="buttonStar">
			Inserisci campioni
		</button>
		<div class="well" style="width: 6cm; margin-left: 7cm; margin-top: 0.5cm">
  		<p align="center">Permette di aggiungere all'archivio nuovi campioni, sia singoli che multipli purch&egrave; raccolti in un file Excel in base allo standard.</p> 
		</div>
		</p>

		<p class="text-center">
		<button type="button"  class="btn btn-success" onclick="location.href='UpdateSample.php'" value="go" 
		style="margin-top: -11.5cm; margin-left: -2cm" class="buttonStar">
			Modifica campioni
		</button>
		<div class="well" style="width: 6cm; margin-left: 14cm; margin-top: -5.3cm">
  		<p align="center">Permette di correggere campioni gi&aacute presenti nell'archivio, intervenendo sulle singole specifiche relative al paziente.</p> 
		</div>
		</p>
		
		<p class="text-center">
		<button type="button"  class="btn btn-success" onclick="location.href='DeleteSample.php'" value="go" 
		style="margin-top: -11.5cm; margin-left: 12cm" class="buttonStart">
			Elimina campione
		</button>
		<div class="well" style="width: 6cm; margin-left: 21cm; margin-top: -5.3cm">
  		<p align="center">Permette di eliminare un campione presente all'interno dell'archivio, dopo averlo cercato sulla base del proprio codice.</p> 
		</div>
		
		<p class="text-center">
		<button type="button"  class="btn btn-success" onclick="location.href='QueryAdmin.php'" value="go" 
		style="margin-top: -11.5cm; margin-left: 26cm" class="buttonStart">
			Effettua una ricerca
		</button>
		<div class="well" style="width: 6cm; margin-left: 28cm; margin-top: -5.3cm">
  		<p align="center">Permette di interrogare l'archivio per effettuare ricerche incrociate sui pazienti affetti dalla sindrome.</p> 
		</div>
		</p>
		
		
		</p>
		
</body>
</html>