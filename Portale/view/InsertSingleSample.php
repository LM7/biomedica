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
		<h2><p style="color: #228B22; margin-left:-1cm; margin-top:2cm; margin-bottom:1cm;" class="text-center">Inserisci singolo campione</p></h2>
		<br>

		<form name="form" method="post">
			<div class="row">
				<div class="form-group"style="margin-left: 6cm">
					<label for="inputEmail" class="col-lg-2 control-label">Patient Code:</label>
					<div class="col-lg-10">
						<input type="number" class="form-control" id="inputCodicePaziente" placeholder="ex: 308" style="width: 7cm" name="inputCodicePaziente" required>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group"style="margin-left: 6cm">
					<label for="inputEmail" class="col-lg-2 control-label">Family Code:</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="inputCodiceFamiglia" placeholder="ex: COR000" style="width: 7cm" name="inputCodiceFamiglia" required maxlength="10">
					</div>
				</div>
			</div>

			<br>
			
			<div class="form-group"style="margin-left: 6cm">
				<label for="select" class="col-lg-2 control-label">Sex:</label>
				<div class="col-lg-10">
					<select class="form-control" id="inputSesso" style="width: 2cm" name="inputSesso">
						<option value="m">m</option>
						<option value="f">f</option>
					</select>
				</div>
			</div>

			<div class="form-group"style="margin-left: 6cm">
				<label for="select" class="col-lg-2 control-label">Consanguineous:</label>
				<div class="col-lg-10">
					<select class="form-control" id="inputConsanguinei" style="width: 2cm" name="inputConsanguinei">
						<option value="x">x</option>
						<option value="y">y</option>
						<option value="n">n</option>
					</select>
					<br>
				</div>
			</div>

			<table class="table table-striped table-hover " style="width: 30cm;margin-left: 4cm">
				<thead>
					<tbody>
						<tr class="info">
							<td><label for="select" class="control-label">CNS</label>
							<br>
							<select class="form-control" id="inputCns" style="width: 2cm" name="inputCns">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">EYES</label>
							<br>
							<select class="form-control" id="inputOcchi" style="width: 2cm" name="inputOcchi">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">KIDNEYS</label>
							<br>
							<select class="form-control" id="inputReni" style="width: 2cm" name="inputReni">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">LIVER</label>
							<br>
							<select class="form-control" id="inputFegato" style="width: 2cm" name="inputFegato">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">POLYDACTYLY</label>
							<br>
							<select class="form-control" id="inputPolidattilia" style="width: 2cm" name="inputPolidattilia">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">TONGUE</label>
							<br>
							<select class="form-control" id="inputLingua" style="width: 2cm" name="inputLingua">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">HEART</label>
							<br>
							<select class="form-control" id="inputCuore" style="width: 2cm" name="inputCuore">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">DYSMORPHIC</label>
							<br>
							<select class="form-control" id="inputDismorfismo" style="width: 2cm" name="inputDismorfismo">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
							<td><label for="select" class="control-label">MTI</label>
							<br>
							<select class="form-control" id="inputMti" style="width: 2cm" name="inputMti">
								<option value="x">x</option>
								<option value="y">y</option>
								<option value="n">n</option>
							</select></td>
						</tr>
				</thead>
				<tr class="active">
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Breath</label>
						<select class="form-control" id="inputRespiro"style="width: 2cm" name="inputRespiro">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Leber amaurosis</label>
						<select class="form-control" id="inputAmaurosi"style="width: 2cm" name="inputAmaurosi">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Renal failure</label>
						<select class="form-control" id="inputInsuffRenale"style="width: 2cm" name="inputInsuffRenale">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Eco/blood alterations </label>
						<select class="form-control" id="inputAltEcoBlood"style="width: 2cm" name="inputAltEcoBlood">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Postaxial</label>
						<select class="form-control" id="inputPostassiale"style="width: 2cm" name="inputPostassiale">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Cleft lip/palate</label>
						<select class="form-control" id="inputLabPal"style="width: 2cm" name="inputLabPal">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">E/M cele</label>
						<select class="form-control" id="inputEMCele"style="width: 2cm" name="inputEMCele">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
				</tr>

				<tr class="active">
					<td>
					<div class="form-group">
						<label for="select" class="control-label">ID</label>
						<select class="form-control" id="inputID"style="width: 2cm" name="inputID">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Retinopathy</label>
						<select class="form-control" id="inputRetinopatia"style="width: 2cm" name="inputRetinopatia">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">NPH</label>
						<select class="form-control" id="inputNPH"style="width: 2cm" name="inputNPH">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">HF</label>
						<select class="form-control" id="inputHF"style="width: 2cm" name="inputHF">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Mesa-preaxial</label>
						<select class="form-control" id="inputMesaPreassiale"style="width: 2cm" name="inputMesaPreassiale">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Hydroceph</label>
						<select class="form-control" id="inputIdrocefalo"style="width: 2cm" name="inputIdrocefalo">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
				</tr>

				<tr class="active">
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Hypotonia</label>
						<select class="form-control" id="inputIpotonia"style="width: 2cm" name="inputIpotonia">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Coloboma</label>
						<select class="form-control" id="inputColoboma"style="width: 2cm" name="inputColoboma">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Cystis</label>
						<select class="form-control" id="inputCisti"style="width: 2cm" name="inputCisti">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">DW</label>
						<select class="form-control" id="inputDW"style="width: 2cm" name="inputDW">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
				</tr>

				<tr class="active">
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Ataxia</label>
						<select class="form-control" id="inputAtassia"style="width: 2cm"name="inputAtassia">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Eco/blood alterations</label>
						<select class="form-control" id="inputAltEcoBlood"style="width: 2cm"name="inputAltEcoBlood2">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					<div class="form-group">
						<label for="select" class="control-label">CC hypopl</label>
						<select class="form-control" id="inputCChypopl"style="width: 2cm"name="inputCChypopl">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
				</tr>

				<tr class="active">
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Apraxia</label>
						<select class="form-control" id="inputAprassia"style="width: 2cm"name="inputAprassia">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>

				<tr class="active">
					<td>
					<div class="form-group">
						<label for="select" class="control-label">Nystagmus</label>
						<select class="form-control" id="inputNistagmo"style="width: 2cm"name="inputNistagmo">
							<option value="x">x</option>
							<option value="y">y</option>
							<option value="n">n</option>
						</select>
					</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				</tbody>
			</table>
  
			<div class="form-group">
				<label for="textArea" class="col-lg-2 control-label" style="margin-left: 6cm; margin-top: 1cm">Note</label>
				<div class="col-lg-10">
					<textarea class="form-control" rows="3" id="textArea" style="width: 14cm;margin-left: 10cm; margin-top: -1cm" name="textArea"></textarea>
				</div>
			</div>

			<div class="form-group">
				<br>
				<label for="inputEmail" class="col-lg-2 control-label"style="margin-left: 6cm; margin-top: 1cm">Diagnosi</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="inputDiagnosi"style="width: 7cm; margin-left: 10cm; margin-top: -1cm" name="inputDiagnosi">
				</div>
			</div>
			<button id="bottone" style="margin-left: 27cm; margin-top: 2cm" name="okPatient" class="btn btn-success">
				Inserisci
			</button>
		</form>


		<script>
					$("#bottone").click(function(event) {
						var elemInserimentoCorretto = document.getElementById('correctInsertion');
						var controllo = true;
						<?php
							$_SESSION["control"]=false;
							?>
						if(elemInserimentoCorretto) {
							$(elemInserimentoCorretto).hide();
						}
						if(controllo) {
							<?php
							$_SESSION["control"]=true;
							?>
						}					
					});
				</script>
					
				<?php
				if (isset($_POST['inputCodiceFamiglia'])) {
					if ($_SESSION['control']) {
						$FAMILY = $_POST['inputCodiceFamiglia'];
						$NG = $_POST['inputCodicePaziente'];

						$sex = $_POST['inputSesso'];
						$consang = $_POST['inputConsanguinei'];
						$CNS = $_POST['inputCns'];
						$breath = $_POST['inputRespiro'];
						$id = $_POST['inputID'];
						$hypotonia = $_POST['inputIpotonia'];
						$ataxia = $_POST['inputAtassia'];
						$apraxia = $_POST['inputAprassia'];
						$nystagmus = $_POST['inputNistagmo'];
						$EYES = $_POST['inputOcchi'];
						$leber_amaurosis = $_POST['inputAmaurosi'];
						$retinopathy = $_POST['inputRetinopatia'];
						$coloboma = $_POST['inputColoboma'];
						$KIDNEYS = $_POST['inputReni'];
						$renal_failure = $_POST['inputInsuffRenale'];
						$nph = $_POST['inputNPH'];
						$Cystis = $_POST['inputCisti'];
						$eco_blood_alterations = $_POST['inputAltEcoBlood2'];
						$LIVER = $_POST['inputFegato'];
						$eco_blood_alterations_liver = $_POST['inputAltEcoBlood'];
						$hf = $_POST['inputHF'];
						$POLYDACTYLY = $_POST['inputPolidattilia'];
						$postaxial = $_POST['inputPostassiale'];
						$mesa_preaxial = $_POST['inputMesaPreassiale'];
						$TONGUE = $_POST['inputLingua'];
						$cleft_lip_palate = $_POST['inputLabPal'];
						$HEART = $_POST['inputCuore'];
						$DYSMORPHIC_FEATURES = $_POST['inputDismorfismo'];
						$MTI = $_POST['inputMti'];
						$em_cele = $_POST['inputEMCele'];
						$hydroceph = $_POST['inputIdrocefalo'];
						$dw = $_POST['inputDW'];
						$cc_hypopl = $_POST['inputCChypopl'];
						$Notes = $_POST['textArea'];
						$Diagnosis = $_POST['inputDiagnosi'];
				
						$insert = new LoadRecord();
						$tupla = array($FAMILY, $NG, 0, 0, $sex, $consang, $CNS, $breath, $id, $hypotonia, $ataxia, $apraxia, $nystagmus, 
										$EYES, $leber_amaurosis, $retinopathy, $coloboma, $KIDNEYS, $renal_failure, $nph, $Cystis, $eco_blood_alterations, 
										$LIVER, $eco_blood_alterations_liver, $hf, $POLYDACTYLY, $postaxial, $mesa_preaxial, $TONGUE, $cleft_lip_palate, 
										$HEART, $DYSMORPHIC_FEATURES, $MTI, $em_cele, $hydroceph, $dw, $cc_hypopl, $Notes, $Diagnosis);
						$check = $insert -> Load($tupla);
						if ($check)
							echo print "<div class='alert alert-dismissable alert-success fade in' role='alert' id='correctInsertion' style='width:8cm;margin-left: 22cm; margin-top:-32.5cm'>
													<span class='glyphicon glyphicon-ok'></span>
													<button type='button' id='close' class='close' data-dismiss='alert'' aria-hidden='true'>
													&times;
													</button>
													<strong>Inserimento Corretto!</strong><br>
													Il campione &egrave stato aggiunto nell'archivio
													</div>";			
					}
				}
				?>
	</body>
</html>