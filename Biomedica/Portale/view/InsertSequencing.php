<?php
include '../persistence/FromExcelToDB.php';
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

		
		
		<br><br><br><br>
		<h2><p style="color: #228B22" class="text-center">Inserisci sequenziamento</p></h2>
		
		<form action="" method="POST" enctype="multipart/form-data"style="width:15cm; margin-left:10cm; margin-right: 60cm; margin-top: 1.5cm">
			<input type="file" class="filestyle" data-buttonName="btn-primary"id="fileUpload"name="file">
			<br>
			<br>
			<input type="submit" class="btn btn-success" name="submit" value="Inserisci" style="margin-top: 0cm; margin-left: 13cm">
		</form>
		
		<?php
	
		if (isset($_FILES["file"]["name"])) {
			$name = $_FILES["file"]["name"];
			//$size = $_FILES['file']['size']
			//$type = $_FILES['file']['type']
	
			$tmp_name = $_FILES['file']['tmp_name'];
			//echo print $tmp_name;
			$error = $_FILES['file']['error'];
			
			if (isset($name)) {
				if (!empty($name)) {
					//$location ='../persistence/';
					//if(move_uploaded_file($tmp_name,$location.$name)) {
						if(strstr($name,".xls") || strstr($name, ".xlsx")) {
							$exception = false;						
							$loading = new FromExcelToDB();
							try {
								$string = $loading -> load($tmp_name);
								unlink($tmp_name);
							}catch(Exception $e) {
								$string = "";
								$exception = true;	
							}
							echo '<p id="chooseText" style="margin-left: 10cm; margin-top: 1cm">
							<strong>'.$string.'</strong>
							</p>';
							if($exception)
							echo '<div class="alert alert-dismissable alert-danger fade in" style="width:10cm;margin-left: 10cm;margin-top:-2cm">
								<button type="button" id="close" class="close" data-dismiss="alert" aria-hidden="true">&times;
								</button>
	  							<strong>Attenzione!</strong> Errore nello standard <br />
	  							<a href="ExcelExample.png" class="alert-link">Visualizza lo standard
								</a>
	  							</div>';
							}
							else {
								$log = new Log();
								$log->emptyAll();
								//$log->write("Il formato del file deve essere .xls oppure .xlsx". "<br /> <br />");
								echo '<div class="alert alert-dismissable alert-danger fade in" style="width:10cm;margin-left:10cm;margin-top:1cm">
								<button type="button" id="close" class="close" data-dismiss="alert" aria-hidden="true">&times;
								</button>
	  							<strong>Attenzione!</strong> il formato del file deve essere excel 
	  							</div>';
							}
						//} 
						//else {
						//	echo 'please choose a file';
						//}
					}
				}
			}
		?>
			
		<?php
		if (isset($_FILES["file"]["name"]) && filesize("../persistence/log.txt") > 0) {
			$log = new Log();
			echo '
				<button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-left:10cm; margin-top: 0cm">More info</button>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  				<div class="modal-dialog modal-lg">
	    				<div class="modal-content">'.
	      				$log->read().
	    				'</div>
	  				</div>
				</div>';
		}
		?>

	</body>
</html>
