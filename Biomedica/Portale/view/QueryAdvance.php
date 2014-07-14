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

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="body">
	
				<div class='panel panel-info'style='width:5cm;height:3cm;  margin-top:1cm; margin-right:1cm; float:right'>
								<div class='panel-heading'>
								<h3 class='panel-title'></h3>
								</div>
								<div class='panel-body'><span class='glyphicon glyphicon-user'>
								</span> Benvenuto  
								<?php session_start();
								if (isset($_SESSION["myusername"])) {
												echo "<strong>". $_SESSION['myusername']."</strong>";?>
												<br>
												<br>
												<button type='button' class='btn btn-primary btn-sm'style='margin-left: 3cm' onclick="location.href='../persistence/Logout.php'">
												Esci
												</button>
											<?php } else
												echo "!";
											?>
					  			
								</div>
								</div>
				
		<ul class="pager" style="float:top; float:left; margin-left: 1.2cm; margin-top: 1cm">
			<li class="prev">
			<?php 
			if (isset($_SESSION["myusername"])) {
				echo '<a href="TasksManagement.php"> &#8592 Cambia Attivit&agrave</a>';
			}
			else {
				 echo '<a href="HomePage.php"> &#8592 Homepage</a>';
			}?>
			</li>
		</ul>
		
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 5.8cm; margin-top: 1.5cm" alt="immagine non visualizzata" width="130" height="150"/>

		<h3 style="margin-top: 1.5cm; margin-left: 9.25cm">
		<br>
		Studio e analisi
		<br>
		della Sindrome di Joubert</h3>
			

		<br>
		<h2><p style="color: #228B22; margin-left: 12cm; margin-top: 2cm">Effettua una ricerca</p></h2>

		<div class="row">
		<p id="chooseText" style="margin-left: 10cm; margin-top: 2cm">
			Seleziona i filtri della tua ricerca:
		</p>
		<br>

		<form name="ricercaAvanzata" action="ShowResult.php" method="POST">
		<div class="panel-group" id="accordion" style="width:12cm; margin-left: 10cm; margin-top: 1cm">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<h3 class="panel-title" style="color: #228B22"><strong>CNS: Central Nervous System</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
					<div class="panel-body">
						CNS:
						<select class="form-control" id="inputCns" style="width: 2cm" name="inputCns">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Breath:
						<select class="form-control" id="inputBreath" style="width: 2cm" name="inputBreath">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						ID:
						<select class="form-control" id="inputID" style="width: 2cm" name="inputID">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Hypotonia:
						<select class="form-control" id="inputHypotonia" style="width: 2cm" name="inputHypotonia">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Ataxia:
						<select class="form-control" id="inputAtaxia" style="width: 2cm" name="inputAtaxia">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Apraxia:
						<select class="form-control" id="inputApraxia" style="width: 2cm" name="inputApraxia">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Nystagmus:
						<select class="form-control" id="inputNystagmus" style="width: 2cm" name="inputNystagmus">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							<h3 class="panel-title" style="color: #228B22"><strong>EYES</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
						EYES:
						<select class="form-control" id="inputEyes" style="width: 2cm" name="inputEyes">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Leber Amaurosis:
						<select class="form-control" id="inputLeberAmaurosis" style="width: 2cm" name="inputLeberAmaurosis">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Retinopathy:
						<select class="form-control" id="inputRetinopathy" style="width: 2cm" name="inputRetinopathy">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Coloboma:
						<select class="form-control" id="inputColoboma" style="width: 2cm" name="inputColoboma">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
							<h3 class="panel-title" style="color: #228B22"><strong>KIDNEYS</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse">
					<div class="panel-body">
						KIDNEYS:
						<select class="form-control" id="inputKidneys" style="width: 2cm" name="inputKidneys">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Renal failure:
						<select class="form-control" id="inputRenalFailure" style="width: 2cm" name="inputRenalFailure">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						NPH:
						<select class="form-control" id="inputNPH" style="width: 2cm" name="inputNPH">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Cystis:
						<select class="form-control" id="inputCystis" style="width: 2cm" name="inputCystis">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Eco/Blood Alterations:
						<select class="form-control" id="inputEcoBloodAlterations" style="width: 2cm" name="inputEcoBloodAlterations">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
							<h3 class="panel-title" style="color: #228B22"><strong>LIVER</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseFour" class="panel-collapse collapse">
					<div class="panel-body">
						LIVER:
						<select class="form-control" id="inputLiver"style="width: 2cm" name="inputLiver">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Eco/Blood Alterations:
						<select class="form-control" id="inputAltEcoBlood"style="width: 2cm" name="inputAltEcoBlood">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						HF:
						<select class="form-control" id="inputHF"style="width: 2cm" name="inputHF">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
							<h3 class="panel-title" style="color: #228B22"><strong>POLYDACTYLY</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseFive" class="panel-collapse collapse">
					<div class="panel-body">
						POLYDACTYLY:
						<select class="form-control" id="inputPolydactyly"style="width: 2cm" name="inputPolydactyly">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Postaxial:
						<select class="form-control" id="inputPostassiale"style="width: 2cm" name="inputPostassiale">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Mesa-preaxial:
						<select class="form-control" id="inputMesaPreassiale"style="width: 2cm" name="inputMesaPreassiale">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
							<h3 class="panel-title" style="color: #228B22"><strong>TONGUE</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseSix" class="panel-collapse collapse">
					<div class="panel-body">
						TONGUE:
						<select class="form-control" id="inputTongue"style="width: 2cm" name="inputTongue">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						CLEFT lip/palate:
						<select class="form-control" id="inputLabPal"style="width: 2cm" name="inputLabPal">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>	
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
							<h3 class="panel-title" style="color: #228B22"><strong>HEART</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseSeven" class="panel-collapse collapse">
					<div class="panel-body">
						HEART:
						<select class="form-control" id="inputHeart"style="width: 2cm" name="inputHeart">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>	
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseHeight">
							<h3 class="panel-title" style="color: #228B22"><strong>DYSMORPHIC FEATURES</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseHeight" class="panel-collapse collapse">
					<div class="panel-body">
						DYSMORPHIC FEATURES:
						<select class="form-control" id="inputDysmorphic"style="width: 2cm" name="inputDysmorphic">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
							<h3 class="panel-title" style="color: #228B22"><strong>MTI</strong></h3>
						</a>
					</h4>
				</div>
				<div id="collapseNine" class="panel-collapse collapse">
					<div class="panel-body">
						MTI:
						<select class="form-control" id="inputMti" style="width: 2cm" name="inputMti">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						E/M cele:
						<select class="form-control" id="inputEMCele" style="width: 2cm" name="inputEMCele">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						Hydroceph:
						<select class="form-control" id="inputIdrocefalo" style="width: 2cm" name="inputIdrocefalo">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						DW:
						<select class="form-control" id="inputDW" style="width: 2cm" name="inputDW">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
						CC hypopl:
						<select class="form-control" id="inputCChypopl" style="width: 2cm" name="inputCChypopl">
							<option value=0></option>
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div>
				</div>
			</div>
			
		</div>
		
	
		<button id="bottone" type="submit" style="margin-left: 28cm; margin-top: 2cm" name="okPatient" class="btn btn-success">
				Ricerca
			</button>
		</form>
		
		<?php 
		$_SESSION["QueryAdvance"] = true;
		$_SESSION["QuerySimple"] = false;
		?>
		
		
	</body>
</html>