<?php
include '../persistence/FromExcelToDB.php';
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
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="http://markusslima.github.io/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>

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
			<strong>Inserisci sequenziamento:</strong>
		</p>

		<?php
	
		if (isset($_FILES["file"]["name"])) {
			$name = $_FILES["file"]["name"];
			//$size = $_FILES['file']['size']
			//$type = $_FILES['file']['type']
	
			$tmp_name = $_FILES['file']['tmp_name'];
			$error = $_FILES['file']['error' ];
			
			if (isset($name)) {
				if (!empty($name)) {
					$location ='../persistence/';
					if (move_uploaded_file($tmp_name, $location . $name)) {
						if(strstr($name,".xls") || strstr($name, ".xlsx")) {
							$exception = false;						
							$loading = new FromExcelToDB();
							try {
								$string = $loading -> load('../persistence/'.$name);
							}catch(Exception $e) {
								$string = "";
								$exception = true;	
							}
							echo '<p id="chooseText" style="margin-left: 4cm; margin-top: 3cm">
							<strong>'.$string.'</strong>
							</p>';
							if($exception)
							echo '<div class="alert alert-dismissable alert-danger fade in" style="width:10cm;margin-left: 4cm">
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
								$log->write("Il formato del file deve essere .xls oppure .xlsx". "<br /> <br />");
								echo '<div class="alert alert-dismissable alert-danger fade in" style="width:10cm;margin-left: 4cm;margin-top: 3cm">
								<button type="button" id="close" class="close" data-dismiss="alert" aria-hidden="true">&times;
								</button>
	  							<strong>Attenzione!</strong> il formato del file deve essere excel 
	  							</div>';
							}
						} 
						else {
							echo 'please choose a file';
						}
					}
				}
			}
		?>
			
		<?php
		if (isset($_FILES["file"]["name"]) && filesize("../persistence/log.txt") > 0) {
			$log = new Log();
			echo '
				<button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-left: 4cm; margin-top: 0cm">More info</button>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  				<div class="modal-dialog modal-lg">
	    				<div class="modal-content">'.
	      				$log->read().
	    				'</div>
	  				</div>
				</div>';
		}
		if (isset($_FILES["file"]["name"]) && filesize("../persistence/log.txt") > 0) {
			echo '
				<div class="panel-group" id="accordion" style="width:15cm; margin-left: 4cm; margin-top: 0cm">
		  			<div class="panel panel-danger">
		    			<div class="panel-heading">
		      				<h4 class="panel-title">
		        				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
		          				More info
		        				</a>
		      				</h4>
		    			</div>
		    			<div id="collapseOne" class="panel-collapse collapse">
		      				<div class="panel-body">'.
		      				$log->read().	        
		      				'</div>
		    			</div>
		  			</div>
		  		</div>';
		}
		?>
		
		<form action="" method="POST" enctype="multipart/form-data"style="width:15cm; margin-left:10cm; margin-right: 60cm; margin-top: 1.5cm">
			<input type="file" class="filestyle" data-buttonName="btn-primary"id="fileUpload"name="file">
			<br>
			<br>
			<input type="submit" class="btn btn-success" name="submit" value="Submit"style="margin-top: 0cm; margin-left: 13cm">
		</form>
		
		
		<ul class="pager" style="margin-top: 7cm; margin-left: -30.5cm" onclick="location.href='TasksManagement.php'">
			<li class="prev">
				<a href="#"> &#8592 Cambia Attivit&agrave</a>
			</li>
		</ul>

	</body>
</html>
