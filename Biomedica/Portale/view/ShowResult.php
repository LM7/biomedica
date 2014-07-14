<?php
include('../persistence/Query.php');
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
	
				<div class='panel panel-info'style='width:5cm;height:3cm;  margin-top:1cm; float:right;margin-right:1cm'>
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

		<form name="form" method="post">
		
		<?php
        function controlloCampi($tipo,$arr)
        {
            if($tipo == "CNS" && count($arr)==6) {
                return new Cns(0,0,$arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5]);
            }
            if($tipo == "EYES" && count($arr)==3) {
                return new Eyes(0,0,$arr[0],$arr[1],$arr[2]);
            }
            if($tipo == "KIDNEYS" && count($arr)==4) {
                return new Kidneys(0,0,$arr[0],$arr[1],$arr[2],$arr[3]);
            }
            if($tipo == "LIVER" && count($arr)==2) {
                return new Liver(0,0,$arr[0],$arr[1]);
            }
            if($tipo == "POLYDACTYLY" && count($arr)==2) {
                return new Polydactyly(0,0,$arr[0],$arr[1]);
            }
            if($tipo == "TONGUE" && count($arr)==1) {
                return new Polydactyly(0,0,$arr[0]);
            }
            if($tipo == "MTI" && count($arr)==4) {
                return new Mti(0,0,$arr[0],$arr[1],$arr[2],$arr[3]);
            }
            else 
                throw new Exception("NO TIPE");
        }
        
        if (isset($_SESSION["QueryAdvance"]) && $_SESSION["QueryAdvance"] && isset($_POST['inputCns'])) {
            
            echo '
            <A HREF="QueryAdvance.php"> 
                <button type="button" style="margin-left: 14cm; margin-top: 3cm" class="btn btn-info">
                    <span class="glyphicon glyphicon-arrow-left"></span> Torna Indietro
                </button>
            </A>';
            
            $inputCns = $_POST['inputCns'];
            $arr = array($_POST['inputBreath'],$_POST["inputID"],$_POST["inputHypotonia"],$_POST['inputAtaxia'],
                        $_POST['inputApraxia'],$_POST['inputNystagmus']);
            $cns = controlloCampi("CNS", $arr);
            
            $inputEyes = $_POST['inputEyes'];
            $arr = array($_POST['inputLeberAmaurosis'],$_POST['inputRetinopathy'],$_POST['inputColoboma']);
            $eyes = controlloCampi("EYES", $arr);

            $inputKidneys = $_POST['inputKidneys'];
            $arr = array($_POST['inputRenalFailure'],$_POST['inputNPH'],$_POST['inputCystis'],$_POST['inputEcoBloodAlterations']);
            $kidneys = controlloCampi("KIDNEYS", $arr);
            
            $inputLiver = $_POST['inputLiver'];
            $arr = array($_POST['inputAltEcoBlood'],$_POST['inputHF']);
            $liver = controlloCampi("LIVER", $arr);
            
            $inputPolydactyly = $_POST['inputPolydactyly'];
            $arr = array($_POST['inputPostassiale'],$_POST['inputMesaPreassiale']);
            $polydactyly = controlloCampi("POLYDACTYLY", $arr);
            
            $inputTongue = $_POST['inputTongue'];
            $arr = array($_POST['inputLabPal']);
            $tongue = controlloCampi("TONGUE", $arr);
            
            $inputHeart = $_POST['inputHeart'];
            
            $inputDysmorphic = $_POST['inputDysmorphic'];
            
            $inputMti = $_POST['inputMti'];
            $arr = array($_POST['inputEMCele'],$_POST['inputIdrocefalo'],$_POST['inputDW'],$_POST['inputCChypopl']);
            $mti = controlloCampi("MTI", $arr);
            
            $patient = new Patient(0,0,0,0,0,$inputCns,$inputEyes,$inputKidneys,$inputLiver,$inputPolydactyly,
                                    $inputTongue,$inputHeart,$inputDysmorphic,$inputMti);

            $q = new Query(); 
            $result = $q -> queryMultiple($patient,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
            
            if(count($result)>0) {
                $_SESSION['result'] = $result;
                echo '
                <A HREF="Download.php"> 
                    <button type="button"  class="btn btn-success" style="margin-right:5cm; margin-left:8cm; margin-top: 0cm;">
                    Scarica
                    </button>
                </A>';  
            }        
            echo '
            <p id="chooseText" style="margin-left: 6cm; margin-top: 2cm">
                <strong>Risultati query:</strong>
            </p>';
            
            if(count($result)>0)
                echo show($result,$patient,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
            else {
                echo '<div class="alert alert-warning alert-dismissible" style="width:10cm;margin-left: 8cm">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Attenzione!</strong>
                <br>Non corrisponde nessun dato alla seguente ricerca.<br></div>';
            }    
            
        }
        ?>
         
		<?php
		if(ISSET($_SESSION["querySimple"]) && $_SESSION["querySimple"] && (isset($_POST['inputCodicePaziente']) || isset($_POST['inputCodiceFamiglia']) || isset($_POST['mydatetime'])))  {
			$q = new Query();
			$cns = new Cns();
			$eyes= new Eyes();
			$kidneys = new Kidneys();
			$liver = new Liver();
			$mti = new Mti();
			$polydactyly = new Polydactyly();
			$tongue = new Tongue();

    		if (ISSET($_POST['inputCodicePaziente'])) {  
    				  	$stringa = $_POST['inputCodicePaziente'];
    					$pat = new Patient(0,$stringa);
    		};			
    		
    		if (ISSET($_POST['inputCodiceFamiglia'])) {  
    				  	$stringa = $_POST['inputCodiceFamiglia'];
    					$pat = new Patient($stringa);
    		};
    		if (ISSET($_POST['mydatetime'])) {  
    				  	$stringa = $_POST['mydatetime'] . " 00:00:00";
    					$pat = new Patient(0,0,$stringa);			
    		};	
    										
    		$result = $q -> queryMultiple($pat,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
            
            if(count($result)>0) {
                $_SESSION['result'] = $result;
                echo '
                <A HREF="Download.php"> 
                    <button type="button"  class="btn btn-success" style="margin-right:5cm; margin-left:8cm; margin-top: 2cm;">
                    Scarica
                    </button>
                </A>';
            }          
            echo '
            <p id="chooseText" style="margin-left: 6cm; margin-top: 2cm">
                <strong>Risultati query:</strong>
            </p>';
            
            if(count($result)>0)
		      echo show($result,$pat,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
            else {
                echo '<div class="alert alert-warning alert-dismissible" style="width:10cm;margin-left: 8cm">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Attenzione!</strong>
                <br>Non corrisponde nessun dato alla seguente ricerca.<br></div>';
            }    
		}


		function show($arr,$patient=0,$cns=0,$eyes=0,$kidneys=0,$liver=0,$mti=0,$polydactyly=0,$tongue=0) {
			//table table-striped	
			$print = '<table class="table table-striped table-hover" cellpadding=5 style="width:200px; margin-left: 1cm; margin-right: 1cm; margin-top: 1cm">'; 

			if ($patient)
				$print .= "<tr class='info'><th>NG:</th> <th>InsertionDate:</th> <th>family:</th> <th>sex:</th> <th>consang:</th> <th>cns:</th>
				<th>eyes:</th> <th>kidneys:</th> <th>liver:</th> <th>polydactyly:</th> <th>tongue:</th> <th>heart:</th>
				<th>dysmorphic:</th> <th>mti:</th> <th>notes:</th> <th>diagnosis:</th></tr>";
				$cont = 0;
				for($i=0;$i<count($arr);$i++) {

					$row = $arr[$i];
					if ($i == $cont) {
						for($j=0;$j<16;$j++) {
						    if($j==1) {
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
						for($j=0;$j<16;$j++) {
						    if($j==1) {
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

			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";

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


		/*$q = new Query();
		$patient = new Patient();
		$cns = new Cns();
		$tongue = new Tongue();
		$eyes = new Eyes();
		$kidneys = new Kidneys();
		$liver = new Liver();
		$mti = new Mti();
		$polydactyly = new Polydactyly();
		$result = $q -> queryMultiple($patient,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
		echo show($result,$patient,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);*/
		/*$result = $q -> queryMultiple($patient);
		echo show($result,$patient);*/
		?>
		

	</body>
</html>