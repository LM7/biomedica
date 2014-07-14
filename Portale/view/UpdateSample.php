<?php
include('../persistence/UpdateRecord.php');
error_reporting(0); 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
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
		<h2><p style="color: #228B22; margin-top:2cm" class="text-center">Inserisci i codici dei pazienti che vuoi modificare</p></h2>
		<form name="form" method="post">
		<input id="myText" type="text" style="width:5cm; margin-top:2cm; margin-left: 14cm" name="writePatient" class="form-control" placeholder="esempio: 310,316,407..." required>	
		<button id="button"  style="margin-left: 15cm; margin-top: 2cm" name="okPatient" class="btn btn-success">Trova pazienti</button>
		</form>
		<div id="mydiv2" class='alert alert-danger'  role='alert' style='height:2.5cm; display:none; margin-top:1cm; margin-left:13cm; width:7.5cm'><strong>Attenzione!</strong><br>L'espressione inserita non &egrave corretta </div>
		

		
		
		
		<?php	
		if (ISSET($_POST['writePatient'])) {
		    if ($_SESSION['control']) {
		        $stringa = $_POST['writePatient'];
		        $insertCode = array();
		        $insertCode = writePatientInArray($stringa);
		        for ($i=0; $i < count($insertCode) ; $i++) {
		            $numero = $insertCode[$i];
		        }
		        $q = new Query();
		        $resultCode = $q -> queryMultyNG($insertCode);
				
				if(count($resultCode)>0)
				    echo show($resultCode,1,1,1,1,1,1,1,1);
				else {
				    echo '<div class="alert alert-warning alert-dismissible" style="width:10cm;margin-left:8cm;margin-top:2cm">
				    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				    <strong>Attenzione!</strong>
				    <br>Non corrisponde nessun dato alla seguente ricerca.<br></div>';
                }
            }
		}
		
		
		
		
		
		
		
		function writePatientInArray($string) { //quello che gli arriva �� sicuramente una lista di numeri separati da virgole
			$code = array();
			$number = "";
			$j = 0;
			for ($i=0; $i < strlen($string); $i++) {
				$char = $string[$i];
				if ($char != ",") {
					$number = $number.$char;
				}
				else if ($char == ",") {
					$code[$j] = $number;
					$j++;
					$number = "";
				}	
			}
			$code[$j] = $number;
			return $code;
		}
		
		
			
		
		
		function show($arr,$patient=0,$cns=0,$eyes=0,$kidneys=0,$liver=0,$mti=0,$polydactyly=0,$tongue=0) {
			//table table-striped
			$print = '<form name="form" method="post">';
			$print .= "<table class='table table-striped table-hover' cellpadding=5 style='width:200px; margin-left: 1cm; margin-right: 1cm; margin-top: 1cm'>"; 
			
			if ($patient)
				$print .= "<tr class='info'><th>NG:</th> <th>InsertionDate:</th> <th>family:</th> <th>sex:</th> <th>consang:</th> <th>cns:</th>
				<th>eyes:</th> <th>kidneys:</th> <th>liver:</th> <th>polydactyly:</th> <th>tongue:</th> <th>heart:</th>
				<th>dysmorphic:</th> <th>mti:</th></tr>";
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						$arrPin = array();
						for($j=0;$j<14;$j++) {
							if ($j == 0 || $j == 2) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
								$arrPin[] = $arr[$i][$j];
							}
							else if($j==1) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								if ($j == 3) {
									if ($arr[$i][$j] == 'm' || $arr[$i][$j] == "") {
									$print .= '<td class="active"><select class="form-control" id="inputPatientSex" style="width: 2cm" name="inputPatientSex">
									<option value="m">m</option>
									<option value="f">f</option>
									</select></td>';
									}
									if ($arr[$i][$j] == 'f') {
									$print .= '<td class="active"><select class="form-control" id="inputPatientSex" style="width: 2cm" name="inputPatientSex">
									<option value="f">f</option>
									<option value="m">m</option>
									</select></td>';
									}
								}
								else  {
									$input = $j;
									if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputPatient' style='width: 2cm' name='inputPatient".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
									}
									if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputPatient' style='width: 2cm' name='inputPatient".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
									}
								
									if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputPatient' style='width: 2cm' name='inputPatient".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
									}
									
								}
							}
							$_SESSION['ifPin'] = $arrPin;      
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						$arrPin = array();
						for($j=0;$j<14;$j++) {
							 if ($j == 0 || $j == 2) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
								$arrPin[] = $arr[$i][$j];
							}
							else if($j==1) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
							else {
								if ($j == 3) {
									if ($arr[$i][$j] == 'm' || $arr[$i][$j] == "") {
										$print .= "<td class='active'><select class='form-control' id='inputPatientSex".$cont."' style='width: 2cm' name='inputPatientSex".$cont."'>
										<option value='m'>m</option>
										<option value='f'>f</option>
										</select></td>";
									}
									if ($arr[$i][$j] == 'f') {
										$print .= "<td class='active'><select class='form-control' id='inputPatientSex".$cont."' style='width: 2cm' name='inputPatientSex".$cont."'>
										<option value='f'>f</option>
										<option value='m'>m</option>
										</select></td>";
									}
								}
								else {
									$input = $j;
									if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputPatient".$input.$cont."' style='width: 2cm' name='inputPatient".$input.$cont."'>
									<option value='y''>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
									}
									if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputPatient".$input.$cont."' style='width: 2cm' name='inputPatient".$input.$cont."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
									}
									if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputPatient".$input.$cont."' style='width: 2cm' name='inputPatient".$input.$cont."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
	
								}
								
								
							}
						}
						$print .= "</tr>";
						$_SESSION['elsePin'.$cont] = $arrPin;
					}
				}
            $_SESSION['cont'] = $cont;
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
			
			if ($cns)
				$print .= "<tr class='success'> <th>NG</th> <th>InsertionDate:</th> <th>breath:</th> <th>id:</th> <th>hypotonia:</th> 
				<th>ataxia:</th> <th>apraxia:</th> <th>nystagmus:</th> </tr>";
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=16;$j<24;$j++) {
							if ($j == 16) {
									$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==17) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputCns' style='width: 2cm' name='inputCns".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputCns' style='width: 2cm' name='inputCns".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputCns' style='width: 2cm' name='inputCns".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						for($j=16;$j<24;$j++) {
							if ($j == 16) {
									$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==17) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputCns".$input.$cont."' style='width: 2cm' name='inputCns".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputCns".$input.$cont."' style='width: 2cm' name='inputCns".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputCns".$input.$cont."' style='width: 2cm' name='inputCns".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							}
						}
						$print .= "</tr>";
					}
				}
				
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
			
			if ($eyes)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>leber amaurosis:</th> <th>retinopathy:</th> 
				<th>coloboma:</th></tr>";
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=24;$j<29;$j++) {
							if ($j == 24) {
									$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==25) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputEyes' style='width: 2cm' name='inputEyes".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputEyes' style='width: 2cm' name='inputEyes".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputEyes' style='width: 2cm' name='inputEyes".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						for($j=24;$j<29;$j++) {
							if ($j == 24) {
									$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==25) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputEyes".$input.$cont."' style='width: 2cm' name='inputEyes".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputEyes".$input.$cont."' style='width: 2cm' name='inputEyes".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputEyes".$input.$cont."' style='width: 2cm' name='inputEyes".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							}
						}
						$print .= "</tr>";
					}
				}
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th></tr>";
			
			if ($kidneys)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>renal failure:</th> <th>nph:</th> 
				<th>cystis:</th> <th>eco blood alterations:</th></tr>";
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=29;$j<35;$j++) {
							if ($j == 29) {
									$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==30) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputKidneys' style='width: 2cm' name='inputKidneys".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputKidneys' style='width: 2cm' name='inputKidneys".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputKidneys' style='width: 2cm' name='inputKidneys".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						for($j=29;$j<35;$j++) {
							if ($j == 29) {
									$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==30) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputKidneys".$input.$cont."' style='width: 2cm' name='inputKidneys".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x'  || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputKidneys".$input.$cont."' style='width: 2cm' name='inputKidneys".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputKidneys".$input.$cont."' style='width: 2cm' name='inputKidneys".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							} 
						}
						$print .= "</tr>";
					}
				}
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
			
			if ($liver)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>eco blood alterations:</th> <th>hf:</th></tr>";
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=35;$j<39;$j++) {
							if ($j == 35) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==36) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputLiver' style='width: 2cm' name='inputLiver".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputLiver' style='width: 2cm' name='inputLiver".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputLiver' style='width: 2cm' name='inputLiver".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						for($j=35;$j<39;$j++) {
							if ($j == 35) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==36) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputLiver".$input.$cont."' style='width: 2cm' name='inputLiver".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x'  || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputLiver".$input.$cont."' style='width: 2cm' name='inputLiver".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputLiver".$input.$cont."' style='width: 2cm' name='inputLiver".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							} 
						}
						$print .= "</tr>";
					}
				}

			$print .= "<tr><th></th><th></th><th></th><th></th></tr>";
			
			
			
			if ($polydactyly)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>postaxial:</th> <th>mesa preaxial:</th></tr>";	
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=45;$j<49;$j++) {
							if ($j == 45) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==46) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    } 
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputPolydactyly' style='width: 2cm' name='inputPolydactyly".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputPolydactyly' style='width: 2cm' name='inputPolydactyly".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputPolydactyly' style='width: 2cm' name='inputPolydactyly".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						for($j=45;$j<49;$j++) {
							if ($j == 45) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==46) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputPolydactyly".$input.$cont."' style='width: 2cm' name='inputPolydactyly".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x'  || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputPolydactyly".$input.$cont."' style='width: 2cm' name='inputPolydactyly".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputPolydactyly".$input.$cont."' style='width: 2cm' name='inputPolydactyly".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							}
						}
						$print .= "</tr>";
					}
				}
			
			$print .= "<tr><th></th><th></th><th></th><th></th></tr>";
			
			if ($tongue)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>cleft lip palat:</th></tr>";
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=49;$j<52;$j++) {
							if ($j == 49) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==50) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputTongue' style='width: 2cm' name='inputTongue".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputTongue' style='width: 2cm' name='inputTongue".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputTongue' style='width: 2cm' name='inputTongue".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							}
						}
					}
					else {
						$print .= "<tr class 'active'>";
						$cont++;
						for($j=49;$j<52;$j++) {
							if ($j == 49) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==50) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }   
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputTongue".$input.$cont."' style='width: 2cm' name='inputTongue".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x'  || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputTongue".$input.$cont."' style='width: 2cm' name='inputTongue".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputTongue".$input.$cont."' style='width: 2cm' name='inputTongue".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							}
						}
						$print .= "</tr>";
					}
				}
				$print .= "<tr><th></th><th></th><th></th></tr>";
				
				if ($mti)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>em cele:</th> <th>hydroceph:</th> 
				<th>dw:</th> <th>cc hypopl:</th></tr>";	
				
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=39;$j<45;$j++) {
							if ($j == 39) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==40) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else {
								$input = $j;
								if ($arr[$i][$j] == 'x' || $arr[$i][$j] == "") {
									$print .= "<td class='active'><select class='form-control' id='inputMti' style='width: 2cm' name='inputMti".$input."'>
									<option value='x'>x</option>
									<option value='y'>y</option>
									<option value='n'>n</option>
									</select></td>";
								}
								if ($arr[$i][$j] == 'y') {
									$print .= "<td class='active'><select class='form-control' id='inputMti' style='width: 2cm' name='inputMti".$input."'>
									<option value='y'>y</option>
									<option value='x'>x</option>
									<option value='n'>n</option>
									</select></td>";
								}
								
								if ($arr[$i][$j] == 'n') {
									$print .= "<td class='active'><select class='form-control' id='inputMti' style='width: 2cm' name='inputMti".$input."'>
									<option value='n'>n</option>
									<option value='x'>x</option>
									<option value='y'>y</option>
									</select></td>";
								}
							} 
						}
					}
					else {
						$print .= "<tr class='active'>";
						$cont++;
						for($j=39;$j<45;$j++) {
							if ($j == 39) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
							else if($j==40) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else {
								$input = $j;
								if ($arr[$i][$j] == 'y') {
								$print .= "<td class='active'><select class='form-control' id='inputMti".$input.$cont."' style='width: 2cm' name='inputMti".$input.$cont."'>
								<option value='y''>y</option>
								<option value='x''>x</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'x'  || $arr[$i][$j] == "") {
								$print .= "<td class='active'><select class='form-control' id='inputMti".$input.$cont."' style='width: 2cm' name='inputMti".$input.$cont."'>
								<option value='x'>x</option>
								<option value='y'>y</option>
								<option value='n'>n</option>
								</select></td>";
								}
								if ($arr[$i][$j] == 'n') {
								$print .= "<td class='active'><select class='form-control' id='inputMti".$input.$cont."' style='width: 2cm' name='inputMti".$input.$cont."'>
								<option value='n''>n</option>
								<option value='x'>x</option>
								<option value='y'>y</option>
								</select></td>";
								}
							} 
						}
						$print .= "</tr>";
					}
				}
				
				$print .= "</table>";
				
				if ($patient)
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					$row = $arr[$i];
					$cont = $i;
						for($j=0;$j<16;$j++) {
							if ($j == 0) {
								$pin = $arr[$i][$j];
							}
							if ($j == 1) {
								$d = new DateTime($arr[$i][$j]);
                                $date = $d->format('Y-m-d');
							}
						
							if ($j == 14) {
								$print .= "<div class='form-group'><label for='textArea' class='col-lg-2 control-label' style='width:8cm; margin-left: 6cm;margin-top: 1cm'>Notes<br>(NG: " .$pin  .", InsertionDate: " .$date  .") </label><div class='col-lg-10'><textarea class='form-control' rows='3' id='inputNotes".$cont."' style='width: 14cm;margin-left: 14cm; margin-top: -1cm' name='inputNotes".$cont."'>". $arr[$i][$j] . "</textarea></div></div>";
							}
							if ($j == 15) {
								$print .= "<div class='form-group'><label for='textArea' class='col-lg-2 control-label' style='width:8cm; margin-left: 6cm;margin-top: 1cm'>Diagnosis<br>(NG: ". $pin  .", InsertionDate:  ". $date.") </label><div class='col-lg-10'><textarea class='form-control' rows='3' id='inputDiagnosis".$cont."' style='width: 14cm;margin-left: 14cm; margin-top: -1cm' name='inputDiagnosis".$cont."'>". $arr[$i][$j] . "</textarea></div></div>";
							}
						}
				}

			$print .= "<button  id='buttonUpdate'  style='float:right;margin-right:16.5cm;margin-top: 2cm; display:block; name='Update' class='btn btn-success'>Modifica</button></form>";

			
				
			return $print;
		}
		
		
		
		?>
		
		
		
		
		<script>
		$("#button").click(function( event ) {
			var myText = document.getElementById('myText').value;
			var controlNow = false;
			<?php $_SESSION['control'] = false; ?>
			
			if(myText != "") {
				var esprReg = new RegExp("^([0-9][0-9]*,)*([0-9][0-9]*)$");
				if (esprReg.test(myText)) {
					controlNow = true;
					if (controlNow) {
						<?php $_SESSION['control'] = true; ?>
						/*var buttonUp = document.getElementById('buttonUpdate');
						buttonUp.style.display = "block";*/
					}
					
				}
				else {
					event.preventDefault();
					var elem2 = document.getElementById('mydiv2');
					$(elem2).show();
					
				}
			}	
		});
		
		
		</script>
		
		<script>
			$("#buttonUpdate").click(function( event ) {
						<?php $_SESSION['alo'] = true;?>
			});
		</script>
		
		<?php 
		$success = false;
		if (ISSET($_POST['inputPatientSex'])) {
			if ($_SESSION['alo']) {
				$NG = $_SESSION['ifPin'][0];
				$FAMILY = $_SESSION['ifPin'][2];
				$insertion_date = $_SESSION['ifPin'][1];
				$sex = $_POST['inputPatientSex'];
				$consang = $_POST['inputPatient4'];
				$CNS = $_POST['inputPatient5']; 
					$breath = $_POST['inputCns18'];
					$id = $_POST['inputCns19'];
					$hypotonia = $_POST['inputCns20'];
					$ataxia = $_POST['inputCns21'];
					$apraxia = $_POST['inputCns22'];
					$nystagmus = $_POST['inputCns23'];
				$EYES = $_POST['inputPatient6'];
					$leber_amaurosis = $_POST['inputEyes26'];
					$retinopathy = $_POST['inputEyes27'];
					$coloboma = $_POST['inputEyes28'];
				$KIDNEYS = $_POST['inputPatient7'];
					$renal_failure = $_POST['inputKidneys31'];
					$nph = $_POST['inputKidneys32'];
					$Cystis = $_POST['inputKidneys33'];
					$eco_blood_alterations = $_POST['inputKidneys34'];
				$LIVER = $_POST['inputPatient8'];
					$eco_blood_alterations_liver = $_POST['inputLiver37'];
					$hf = $_POST['inputLiver38'];
				$POLYDACTYLY = $_POST['inputPatient9'];
					$postaxial = $_POST['inputPolydactyly47'];
					$mesa_preaxial = $_POST['inputPolydactyly48'];
				$TONGUE = $_POST['inputPatient10'];
					$cleft_lip_palate = $_POST['inputTongue51'];
				$HEART = $_POST['inputPatient11'];
				$DYSMORPHIC_FEATURES = $_POST['inputPatient12'];
				$MTI = $_POST['inputPatient13'];
						$em_cele = $_POST['inputMti41'];
						$hydroceph = $_POST['inputMti42'];
						$dw = $_POST['inputMti43'];
						$cc_hypopl = $_POST['inputMti44'];
				$Notes = $_POST['inputNotes0'];
				$Diagnosis = $_POST['inputDiagnosis0'];
				
				$update = new UpdateRecord();
				$record = array($NG, $insertion_date, $FAMILY, 0, 0, $sex, $consang, $CNS, $breath, $id, $hypotonia, $ataxia, $apraxia, $nystagmus,
								$EYES, $leber_amaurosis, $retinopathy, $coloboma, $KIDNEYS, $renal_failure, $nph, $Cystis, $eco_blood_alterations,
								$LIVER, $eco_blood_alterations_liver, $hf, $POLYDACTYLY, $postaxial, $mesa_preaxial, $TONGUE, $cleft_lip_palate,
								$HEART, $DYSMORPHIC_FEATURES, $MTI, $em_cele, $hydroceph, $dw, $cc_hypopl, $Notes, $Diagnosis);
				$success = $update -> Update($record);
				if($success) {
					$i = $j = 1;
				}
				
				
				
				//per tutti gli altri
				$cont = $_SESSION['cont'];
				$j = 1;
				for($i=1; $i <= $cont; $i++) {
						$NG = $_SESSION['elsePin'.$i][0];
						$FAMILY = $_SESSION['elsePin'.$i][2];
						$insertion_date = $_SESSION['elsePin'.$i][1];
							$sex = $_POST['inputPatientSex'.$i];
							$consang = $_POST['inputPatient4'.$i];
						$CNS = $_POST['inputPatient5'.$i]; 
							$breath = $_POST['inputCns18'.$i];
							$id = $_POST['inputCns19'.$i];
							$hypotonia = $_POST['inputCns20'.$i];
							$ataxia = $_POST['inputCns21'.$i];
							$apraxia = $_POST['inputCns22'.$i];
							$nystagmus = $_POST['inputCns23'.$i];
						$EYES = $_POST['inputPatient6'.$i];
							$leber_amaurosis = $_POST['inputEyes26'.$i];
							$retinopathy = $_POST['inputEyes27'.$i];
							$coloboma = $_POST['inputEyes28'.$i];
						$KIDNEYS = $_POST['inputPatient7'.$i];
							$renal_failure = $_POST['inputKidneys31'.$i];
							$nph = $_POST['inputKidneys32'.$i];
							$Cystis = $_POST['inputKidneys33'.$i];
							$eco_blood_alterations = $_POST['inputKidneys34'.$i];
						$LIVER = $_POST['inputPatient8'.$i];
							$eco_blood_alterations_liver = $_POST['inputLiver37'.$i];
							$hf = $_POST['inputLiver38'.$i];
						$POLYDACTYLY = $_POST['inputPatient9'.$i];
							$postaxial = $_POST['inputPolydactyly47'.$i];
							$mesa_preaxial = $_POST['inputPolydactyly48'.$i];
						$TONGUE = $_POST['inputPatient10'.$i];
							$cleft_lip_palate = $_POST['inputTongue51'.$i];
						$HEART = $_POST['inputPatient11'.$i];
						$DYSMORPHIC_FEATURES = $_POST['inputPatient12'.$i];
						$MTI = $_POST['inputPatient13'.$i];
							$em_cele = $_POST['inputMti41'.$i];
							$hydroceph = $_POST['inputMti42'.$i];
							$dw = $_POST['inputMti43'.$i];
							$cc_hypopl = $_POST['inputMti44'.$i];
						$Notes = $_POST['inputNotes'.$i];
						$Diagnosis = $_POST['inputDiagnosis'.$i];
				
						$update = new UpdateRecord();
						$record = array($NG, $insertion_date, $FAMILY, 0, 0, $sex, $consang, $CNS, $breath, $id, $hypotonia, $ataxia, $apraxia, $nystagmus,
								$EYES, $leber_amaurosis, $retinopathy, $coloboma, $KIDNEYS, $renal_failure, $nph, $Cystis, $eco_blood_alterations,
								$LIVER, $eco_blood_alterations_liver, $hf, $POLYDACTYLY, $postaxial, $mesa_preaxial, $TONGUE, $cleft_lip_palate,
								$HEART, $DYSMORPHIC_FEATURES, $MTI, $em_cele, $hydroceph, $dw, $cc_hypopl, $Notes, $Diagnosis,$insertion_date);
						$success = $update -> Update($record);
						if ($success){
							$j= $j +1;
						}
					
				}
				
			}
		}

		if ($i != null && $j != null) {
			if ($j == $i) {
			echo print "<div class='alert alert-dismissable alert-success fade in' role='alert' id='correctInsertion' style='width:8cm;margin-left: 13cm; margin-top:2cm'>
									<span class='glyphicon glyphicon-ok'></span>
									<button type='button' id='close' class='close' data-dismiss='alert'' aria-hidden='true'>
									&times;
									</button>
										<strong>Aggiornamento eseguito su ".$j." campioni! </strong><br>
									</div>";
			}
			else {
				echo print "<div class='alert alert-dismissable alert-success fade in' role='alert' id='correctInsertion' style='width:8cm;margin-left: 13cm; margin-top:2cm'>
									<span class='glyphicon glyphicon-ok'></span>
									<button type='button' id='close' class='close' data-dismiss='alert'' aria-hidden='true'>
									&times;
									</button>
										<strong>Aggiornamento eseguito solo su ".$j." campioni! </strong><br>
									</div>";
			}
			
		}
		
		
			
		
		
		?>
		
		
		
		
		
		
		
		
		
		
		</body>
</html>