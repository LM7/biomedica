<?php
include '../persistence/LoadRecord.php';
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
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 8.6cm; margin-top: 0cm" alt="immagine non visualizzata" width="130" height="150"/>

		<h3>
		<br>
		Studio e analisi
		<br>
		della Sindrome di Joubert</h3>

		<div class="panel panel-info"style="width:5cm;height:3cm;  margin-top:-2cm; margin-left:30cm">
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

		<p id="chooseText" style="margin-left: 6cm; margin-top: 2cm">
			<strong>Inserisci singolo campione:</strong>
		</p>

           <form name="form" method="post">
			<div class="form-group"style="margin-left: 6cm">
				<label for="inputEmail" class="col-lg-2 control-label">Codice Paziente</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="inputCodicePaziente" placeholder="ex: 308" style="width: 7cm" name="inputCodicePaziente">
				</div>
			</div>

			<div id="alertCampoVuoto" class='alert alert-danger'  role='alert' style='height:1.5cm; display:none; margin-top:1cm; margin-left:20cm; width:10cm'>
				<strong>Attenzione!</strong>
				il campo <strong>CodicePaziente</strong> &egrave vuoto!
				<br>
			</div>
			
			<div id="alertNonNumero" class='alert alert-danger'  role='alert' style='height:1.5cm; display:none; margin-top:1cm; margin-left:20cm; width:10cm'>
				<strong>Attenzione!</strong>
				il campo <strong>CodicePaziente</strong> non &egrave un numero!
				<br>
			</div>

				<div class="form-group"style="margin-left: 6cm">
					<label for="inputEmail" class="col-lg-2 control-label">Codice Famiglia</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="inputCodiceFamiglia" placeholder="ex: COR000" style="width: 7cm" name="inputCodiceFamiglia">
					</div>
				</div>
			
			<div id="alertCampoVuoto2" class='alert alert-danger'  role='alert' style='height:1.5cm; display:none; margin-top:1cm; margin-left:20cm; width:10cm'>
				<strong>Attenzione!</strong>
				il campo <strong>CodiceFamiglia</strong> &egrave vuoto!
				<br>
			</div>
			
			<div id="alertTroppiCaratteri" class='alert alert-danger'  role='alert' style='height:1.5cm; display:none; margin-top:1cm; margin-left:20cm; width:10cm'>
				<strong>Attenzione!</strong>
				il campo <strong>CodiceFamiglia</strong> supera il limite di 10 caratteri!
				<br>
			</div>

				<div class="form-group"style="margin-left: 6cm">
					<label for="select" class="col-lg-2 control-label">Sesso</label>
					<div class="col-lg-10">
						<select class="form-control" id="inputSesso" style="width: 2cm" name="inputSesso">
							<option value="m">m</option>
							<option value="f">f</option>
						</select>
					</div>
				</div>

				<div class="form-group"style="margin-left: 6cm">
					<label for="select" class="col-lg-2 control-label">Consanguinei</label>
					<div class="col-lg-10">
						<select class="form-control" id="inputConsanguinei" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
						<br>
					</div>
				</div>
				
			<table class="table table-striped table-hover " style="width: 30cm;margin-left: 4cm">
			<thead>
				<tbody>
				<tr class="info">
					<td>
						<label for="select" class="control-label">CNS</label>
						<br>
						<select class="form-control" id="inputCns" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
					
						<label for="select" class="control-label">OCCHI</label>
						<br>
						<select class="form-control" id="inputOcchi" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
					
						<label for="select" class="control-label">RENI</label>
						<br>
						<select class="form-control" id="inputReni" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
					
						<label for="select" class="control-label">FEGATO</label>
						<br>
						<select class="form-control" id="inputFegato" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
						<label for="select" class="control-label">POLIDATTILIA</label>
						<br>
						<select class="form-control" id="inputPolidattilia" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
						<label for="select" class="control-label">LINGUA</label>
						<br>
						<select class="form-control" id="inputLingua" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
						<label for="select" class="control-label">CUORE</label>
						<br>
						<select class="form-control" id="inputCuore" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
						<label for="select" class="control-label">DISMORFISMO</label>
						<br>
						<select class="form-control" id="inputDismorfismo" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
					<td>
						<label for="select" class="control-label">MTI</label>
						<br>
						<select class="form-control" id="inputMti" style="width: 2cm">
							<option>x</option>
							<option>y</option>
							<option>n</option>
						</select>
					</td>
				</tr>
			</thead>
				<tr class="active">
				<td><div class="form-group">
					<label for="select" class="control-label">Respiro</label>
					<select class="form-control" id="inputRespiro"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
				</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Amaurosi</label>
					<select class="form-control" id="inputAmaurosi"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
				</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Insufficienza Renale</label>
					<select class="form-control" id="inputInsuffRenale"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Alterazione Eco/Blood</label>
					<select class="form-control" id="inputAltEcoBlood"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Postassiale</label>
					<select class="form-control" id="inputPostassiale"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Labio / Palatoschisi</label>
					<select class="form-control" id="inputLabPal"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td> </td>
				<td> </td>
				<td><div class="form-group">
					<label for="select" class="control-label">E/M cele</label>
					<select class="form-control" id="inputEMCele"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				</tr>
				
				<tr class="active">
				<td><div class="form-group">
					<label for="select" class="control-label">ID</label>
					<select class="form-control" id="inputID"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Retinopatia</label>
					<select class="form-control" id="inputRetinopatia"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">NPH</label>
					<select class="form-control" id="inputNPH"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">HF</label>
					<select class="form-control" id="inputHF"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Mesa-Preassiale</label>
					<select class="form-control" id="inputMesaPreassiale"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td></td>
				<td></td>
				<td></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Idrocefalo</label>
					<select class="form-control" id="inputIdrocefalo"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				</tr>
				
				<tr class="active">
				<td><div class="form-group">
					<label for="select" class="control-label">Ipotonia</label>
					<select class="form-control" id="inputIpotonia"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Coloboma</label>
					<select class="form-control" id="inputColoboma"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Cisti</label>
					<select class="form-control" id="inputCisti"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><div class="form-group">
					<label for="select" class="control-label">DW</label>
					<select class="form-control" id="inputDW"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				</tr>
				
				<tr class="active">
				<td><div class="form-group">
					<label for="select" class="control-label">Atassia</label>
					<select class="form-control" id="inputAtassia"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td></td>
				<td><div class="form-group">
					<label for="select" class="control-label">Alterazione Eco/Blood</label>
					<select class="form-control" id="inputAltEcoBlood"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><div class="form-group">
					<label for="select" class="control-label">CC hypopl</label>
					<select class="form-control" id="inputCChypopl"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
					</select>
					</div></td>
				</tr>
				
				<tr class="active">
				<td><div class="form-group">
					<label for="select" class="control-label">Aprassia</label>
					<select class="form-control" id="inputAprassia"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
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
				<td><div class="form-group">
					<label for="select" class="control-label">Nistagmo</label>
					<select class="form-control" id="inputNistagmo"style="width: 2cm">
						<option>x</option>
						<option>y</option>
						<option>n</option>
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
					<textarea class="form-control" rows="3" id="textArea" style="width: 14cm;margin-left: 10cm; margin-top: -1cm"></textarea>
				</div>
		</div>
		
				<div class="form-group">
					<br>
					<label for="inputEmail" class="col-lg-2 control-label"style="margin-left: 6cm; margin-top: 1cm">Diagnosi</label>
					<div class="col-lg-10">
					<input type="text" class="form-control" id="inputDiagnosi"style="width: 7cm; margin-left: 10cm; margin-top: -1cm">
					</div>
				</div>
		<button id="bottone" style="margin-left: 27cm; margin-top: 2cm" name="okPatient" class="btn btn-success">Modifica</button>
		</form>		
		
			
		<ul class="pager" style="margin-top: 2cm; margin-left: -30.5cm" onclick="location.href='TasksManagement.php'">
			<li class="prev">
				<a href="#"> &#8592 Cambia Attivit&agrave</a>
			</li>
		</ul>
		
		
		<script>
					$("#bottone").click(function(event) {
						var myInputCodicePaziente = document.getElementById('inputCodicePaziente');
						var myInputCodiceFamiglia = document.getElementById('inputCodiceFamiglia');
						var elemCampoVuoto = document.getElementById('alertCampoVuoto');
						var elemNonNumero = document.getElementById('alertNonNumero');
						var elemCampoVuoto2 = document.getElementById('alertCampoVuoto2');
						var elemTroppiCaratteri = document.getElementById('alertTroppiCaratteri');
						var controllo = true;
						<?php
							$_SESSION["control"]=false;
							?>
						
						
						if(myInputCodicePaziente.value == "") {
							event.preventDefault();
							$(elemCampoVuoto).show();
							$(elemNonNumero).hide();
							controllo=false;
						}
						else if(isNaN(myInputCodicePaziente.value)) {
							event.preventDefault();
							$(elemCampoVuoto).hide();
							$(elemNonNumero).show();
							controllo=false;
						}
						else {
							$(elemNonNumero).hide();
							$(elemCampoVuoto).hide();
						}
						if(myInputCodiceFamiglia.value=="") {
							event.preventDefault();
							$(elemCampoVuoto2).show();
							$(elemTroppiCaratteri).hide();
							controllo=false;
						}
						else if(myInputCodiceFamiglia.value.length>10) {
							event.preventDefault();
							$(elemCampoVuoto2).hide();
							$(elemTroppiCaratteri).show();
							controllo=false;
						}
						else {
							$(elemTroppiCaratteri).hide();
							$(elemCampoVuoto2).hide();
						}
						if(controllo) {
							<?php
							$_SESSION["control"]=true;
							?>
							//$insert= new LoadRecord();
							//$tupla=array();
							//$check=$insert->Load($tupla);
							//if($check)
							//echo "win!";
							
						}					
					});
				</script>	
				<?php
					if($_SESSION['control']) {
							
						echo ($_POST['inputCodicePaziente']);					
					}
				?>		
		
	</body>
</html>