<?php
include('../persistence/Query.php');
include('../persistence/DeleteRecord.php');
//error_reporting(0); 
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
		<h2><p style="color: #228B22; margin-top:2cm" class="text-center">Inserisci i codici dei pazienti che vuoi eliminare</p></h2>
		<form name="form" method="post">
		<input id="myText" type="text" style="width:5cm; margin-top:2cm; margin-left: 14cm" name="writePatient" class="form-control" placeholder="esempio: 310,326,507..." required>	
		<button id="button"  style="margin-left: 15cm; margin-top: 2cm" name="okPatient" class="btn btn-success">Trova pazienti</button>
		</form>
		<div id="mydiv2" class='alert alert-danger'  role='alert' style='height:2.5cm; display:none; margin-top:1cm; margin-left:13cm; width:7.5cm'><strong>Attenzione!</strong><br>L'espressione inserita non &egrave corretta </div>
		
		
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
			$print = '<table class="table table-striped table-hover" cellpadding=5 style="width:200px; margin-left: 0cm; margin-right: 1cm; margin-top: 1cm">'; 
			$print .='<form name="form" method="post">';
			$arrHelp = array();
			
			if ($patient)
				$print .= "<tr class='info'><th>NG:</th> <th>InsertionDate:</th> <th>family:</th> <th>sex:</th> <th>consang:</th> <th>cns:</th>
				<th>eyes:</th> <th>kidneys:</th> <th>liver:</th> <th>polydactyly:</th> <th>tongue:</th> <th>heart:</th>
				<th>dysmorphic:</th> <th>mti:</th> <th>notes:</th> <th>diagnosis:</th></tr>";
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=0;$j<16;$j++) {
							if ($j==0) {
								$arrHelp[$i][$j]=$arr[$i][$j];
							}						    	
						    if($j==1) {
						    	$arrHelp[$i][$j]=$arr[$i][$j];
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
						    }
						}
					$arrHelp[$i][2]=$i;
					$print .= '<td class="warning">
					<input type="checkbox" name="test'.$i.'" value="value1"> <strong><font color="#FF0000">Elimina</font></strong>
					</td>';	
					}
					else {
						$print .= "<tr>";
						for($j=0;$j<16;$j++) {
						    if ($j==0) {
								$arrHelp[$i][$j]=$arr[$i][$j];
							}		
						    if($j==1) {
                                $arrHelp[$i][$j]=$arr[$i][$j];	
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
						}
					$arrHelp[$i][2]=$i;	
					$print .= '<td class="warning">
					<input type="checkbox" name="test'.$i.'" value="value1"> <strong><font color="#FF0000">Elimina</font></strong>
					</td>';	
					$print .= "</tr>"; 
					}
				}
			
			$_SESSION['array']=$arrHelp;
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
			
			$print .= '<button style="margin-left:28cm; margin-top:-1.5cm" type=submit id="bottone" name="bottone" class="btn btn-danger">
						Elimina
						</button>';
			$print .= "</form>";
			
			if ($cns)
				$print .= "<tr class='success'> <th>NG</th> <th>InsertionDate:</th> <th>breath:</th> <th>id:</th> <th>hypotonia:</th> 
				<th>ataxia:</th> <th>apraxia:</th> <th>nystagmus:</th> </tr>";

				$cont = 0;
				for($i=0;$i<count($arr);$i++) {

					$row = $arr[$i];
					if ($i == $cont) {
						for($j=16;$j<24;$j++) {
						    if($j==17) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr class='active'>";
						for($j=16;$j<24;$j++) {
						    if($j==17) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
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
						    if($j==25) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr class='active'>";
						for($j=24;$j<29;$j++) {
						    if($j==25) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
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
						    if($j==30) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr class='active'>";
						for($j=29;$j<35;$j++) {
						    if($j==30) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            } 
						$cont++;
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
						    if($j==36) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr class='active'>";
						for($j=35;$j<39;$j++) {
						    if($j==36) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
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
						    if($j==46) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr class='active'>";
						for($j=45;$j<49;$j++) {
						    if($j==46) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
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
						    if($j==50) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr>";
						for($j=49;$j<52;$j++) {
						    if($j==50) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
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
						    if($j==40) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						}
					}
					else {
						$print .= "<tr class='active'>";
						for($j=39;$j<45;$j++) {
						    if($j==40) {
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
                            else {
                                $print .= "<td class='active'>".$arr[$i][$j] . "</td>"; 
                            }
						$cont++;
						}
						$print .= "</tr>";
					}
				}

			$print .= "</table>"; 
					
		return $print;
		}
		
		
 		?>
 		
 		
 		<script>	
			$("#bottone").click(function( event ) {
				<?php $_SESSION['delete'] = true;?>
			});
		</script>
		
				
		<?php 
		if ($_SESSION['delete']) {
				if(ISSET($_SESSION['array'])) {
					$toDelete = $_SESSION['array'];
					//print_r($toDelete);
						for ($x=0; $x <count($toDelete) ; $x++) {
				 			if (isset($_POST['test'.$x])) {	
								$delete = new DeleteRecord();
								/*
								echo "<br>";
								echo "codice:".$toDelete[$x][0];
								echo "<br>"; 
								echo "data".$toDelete[$x][1];
								echo "<br>";
								 * 
								 */
								$delete->Delete($toDelete[$x][0], $toDelete[$x][1]);
								print "<div class='alert alert-dismissable alert-success fade in' role='alert' id='correctInsertion' style='width:8cm;margin-left: 13cm; margin-top:2cm'>
											<span class='glyphicon glyphicon-ok'></span>
											<button type='button' id='close' class='close' data-dismiss='alert'' aria-hidden='true'>
											&times;
											</button>
												<strong>Il campione relativo al paziente ".$toDelete[$x][0]." &egrave stato cancellato! </strong><br>
											</div>";
							}	
							else {
								//echo "non selezionato";
							}
						}
				}
		}					
		?>

		
		
		</body>
</html>