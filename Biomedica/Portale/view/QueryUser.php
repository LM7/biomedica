<?php
include '../persistence/LoadRecord.php';
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
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="/bower_components/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
		<script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="body">
		<ul class="pager" style="float:top; float:left; margin-left: 1cm; margin-top: 1cm" onclick="location.href='HomePage.php'">
			<li class="prev">
				<a href="#"> &#8592 Homepage</a>
			</li>
		</ul>
		
		<div class="panel panel-info"style="float:right; float:top; margin-top:1cm; margin-right:1cm; width:5cm;height:3cm;">
			<div class="panel-heading">
				<h3 class="panel-title"></h3>
			</div>
			<div class="panel-body">
				<span class="glyphicon glyphicon-user"></span>
				Benvenuto!
				</strong>
				<br>
				<br>
			</div>
		</div>
		
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 6cm; margin-top: 1.5cm" alt="immagine non visualizzata" width="130" height="150"/>

		<h3 style="margin-top: 1.5cm">
		<br>
		Studio e analisi
		<br>
		della Sindrome di Joubert</h3>

		
		
		<br><br><br><br>
		<h2><p style="color: #228B22" class="text-center">Effettua una ricerca</p></h2>

		<p id="chooseText" style="margin-left: 12cm; margin-top: 2cm">
			Cerca per:
		</p>
		
		<?php
		session_start();
		$_SESSION["querySimple"] = true;
		$_SESSION["queryAdvance"] = false;
		?>
		
		<select class="form-control" id="select" style="margin-left: 15cm; margin-top: -1cm; width: 5cm" onChange="myNewFunction(this);">
			<option value="defaul"></option>
			<option value="ng">Codice Paziente</option>
			<option value="family">Codice Famiglia</option>
			<option value="date">Data di Inserimento</option>
		</select>

		<div class="alert" style="width:8cm; margin-left: 20cm; margin-top: -1cm">
			oppure effettua una
			<a href="QueryAdvance.php" class="alert-link">Ricerca Avanzata</a>
		</div>
		<br>

		<form name="ricerca" action="ShowResult.php" method="POST">
			<div class="form-group" align="center">
				<label for="inputNg" class="col-lg-2 control-label" style="margin-left: 10cm; width: 7cm; display: none" id="inputNg">Inserisci Codice Paziente:</label>
				<br>
				<br>
				<input type="number" class="form-control" id="inputCodicePaziente" placeholder="ex: 308" style="margin-left: -5cm; width: 7cm; display: none" name="inputCodicePaziente" required>
				<button id="bottone1" type="submit" style="margin-left: 5cm; margin-top: -1.5cm; display: none" name="okChooseFilter" class="btn btn-success">
					Ricerca
				</button>
			</div>
		</form>

		<form name="ricerca" action="ShowResult.php" method="POST">
			<div class="form-group" align="center" style="margin-top: -1.4cm">
				<label for="inputFamily" class="col-lg-2 control-label" style="margin-left: 10cm; width: 7cm; display: none" id="inputFamily">Inserisci Codice Famiglia:</label>
				<br>
				<br>
				<input type="text" class="form-control" id="inputCodiceFamiglia" placeholder="ex: COR000" style="margin-left: -5cm; width: 7cm; display: none" name="inputCodiceFamiglia" required maxlength="10">
				<button id="bottone2" type="submit" style="margin-left: 5cm; margin-top: -1.5cm; display: none" name="okChooseFilter" class="btn btn-success">
					Ricerca
				</button>
			</div>
		</form>

		<form name="ricerca" action="ShowResult.php" method="POST">
			<div class="form-group" align="center" style="margin-top: -1.4cm">
				<label for="inputCalendar" class="col-lg-2 control-label" style="margin-left: 10cm; width: 7cm; display: none" id="inputCalendar">Inserisci Data di Inserimento:</label>
				<br>
				<br>
				<?php 
				date_default_timezone_set("Europe/Rome");
 	 			$insertion_date = date("Y-m-d");
 	 			?>
				<input type="date" id="mydatetime" name="mydatetime" style="margin-left: -3cm; width: 7cm; display: none" required max=<?php echo $insertion_date?> >
				<button id="bottone3" type="submit" style="margin-left: 0.5cm; margin-top: 0cm; display: none" name="okChooseFilter" class="btn btn-success">
					Ricerca
				</button>
			</div>
		</form>

		</form>

		<script>
			function myNewFunction(sel) {

				var inputCodiceFamiglia = document.getElementById('inputCodiceFamiglia');
				var inputCodicePaziente = document.getElementById('inputCodicePaziente');
				var inputNg = document.getElementById('inputNg');
				var inputFamily = document.getElementById('inputFamily');
				var cal = document.getElementById('inputCalendar');
				var inputDate = document.getElementById('mydatetime');
				
				var button1 = document.getElementById('bottone1');
				var button2 = document.getElementById('bottone2');
				var button3 = document.getElementById('bottone3');
				
            	if((sel.options[sel.selectedIndex].text).localeCompare("Codice Famiglia")==0) {
            		
            		$(inputFamily).show();
            		$(inputCodiceFamiglia).show();
            		$(button2).show();
            		
            		$(inputNg).hide();
            		$(inputCodicePaziente).hide();
            		$(button1).hide();
            		
            		$(cal).hide();
            		$(inputDate).hide();
            		$(button3).hide();
            	
            	}
            	
            	else if((sel.options[sel.selectedIndex].text).localeCompare("Codice Paziente")==0) {
            		
            		$(inputNg).show();
            		$(inputCodicePaziente).show();
            		$(button1).show();
            		
            		$(inputFamily).hide();
            		$(inputCodiceFamiglia).hide();
            		$(button2).hide();
            		$(cal).hide();
            		$(inputDate).hide();
            		$(button3).hide();
            	}
           
            	else if((sel.options[sel.selectedIndex].text).localeCompare("Data di Inserimento")==0) {
            		$(cal).show();
            		$(inputDate).show();
            		$(button3).show();
            		
            		$(inputFamily).hide();
            		$(inputCodiceFamiglia).hide();
            		$(button2).hide();
            		
            		$(inputNg).hide();
            		$(inputCodicePaziente).hide();
            		$(button1).hide();
            	}
            	else {
            		$(inputFamily).hide();
            		$(inputCodiceFamiglia).hide();
            		$(inputNg).hide();
            		$(inputCodicePaziente).hide();
            		$(cal).hide();
            		$(inputDate).hide();
            		$(button).hide();
            	}
            }
			</script>

		

		<ul class="pager" style="margin-top: 4.5cm; margin-left: -30.5cm" onclick="location.href='Homepage.php'">
			<li class="prev">
				<a href="#"> &#8592 Homepage</a>
			</li>
		</ul>
		
	</body>
</html>