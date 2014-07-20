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
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
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
		function tableDuplicate($arr,$inizio=0,$fine=14,$bool=false) {
            $string = "<table class='table table-striped table-hover' cellpadding=5 style='width:200px; margin-left: 1cm; margin-right: 1cm; margin-top: 1cm'>";
            $string .= "<tr><td align='center' colspan='".($fine-$inizio)."'><b>Altri campioni piu' vecchi</b></td></tr>";
            for ($t = 0; $t < count($arr); $t++) {
                $string .= "<tr>";
                for ($m=$inizio;$m<$fine;$m++) {
                    $elem = $arr[$t][$m];
                    if(!$bool || $m != 2){
                        if($m == $inizio +1) {
                            $d = new DateTime($elem);
                            $data = $d->format('Y-m-d');
                            $string .= "<td class='active'>".$data. "</td>";
                        }
                        else
                            $string .= "<td class='active'>".$elem."</td>";
                    }
                }
                $string .="</tr>";
            }
            $string .="</table>";
            return $string;
        }   
		
		
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
			$inTable = false;
			$moreInfo = false;
			$storyPatient = array();
			if ($patient)
				$print .= "<tr class='info'><th>NG:</th> <th>InsertionDate:</th> <th>family:</th> <th>sex:</th> <th>consang:</th> <th>cns:</th>
				<th>eyes:</th> <th>kidneys:</th> <th>liver:</th> <th>polydactyly:</th> <th>tongue:</th> <th>heart:</th>
				<th>dysmorphic:</th> <th>mti:</th> <th>notes:</th> <th>diagnosis:</th> </tr>";
				$cont = 0;
				$story0 = array(); 
				for($i=0;$i<count($arr);$i++) {
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=0;$j<16;$j++) {
							if ($j == 0) {
									if ($arr[0][0] != $arr[1][0]  ) { 
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; 
										for ($cicloj=0; $cicloj<16; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; 
										}
										$storyPatient[] = $story0; 
										$story0=array();
										$moreInfo = true;
									}
								
							}
							else if($j==1 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {   
						$inTableOther = false;
						$print .= "<tr class='active'>";
						$cont++; 
						for($j=0;$j<16;$j++) {
							 if ($j == 0) {
							 		if ($arr[$i][$j] != $arr[$i+1][0]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 0; $ciclojother < 16; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyPatient[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][0]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."patient'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."patient' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyPatient)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyPatient = array();
										}
							 			
							 		}
							}
							else if($j==1 && $inTableOther) {
							    $arrPin[] = $arr[$i][$j];
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
						}
					}
					$print .= "</tr>";
				}
			}
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
			
			$inTable = false;
			$moreInfo = false;
			$storyCns = array();
			if ($cns)    
				$print .= "<tr class='success'> <th>NG</th> <th>InsertionDate:</th> <th>breath:</th> <th>id:</th> <th>hypotonia:</th> 
				<th>ataxia:</th> <th>apraxia:</th> <th>nystagmus:</th> </tr>";
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=16;$j<24;$j++) {
							if ($j == 16) {
									if ($arr[0][16] != $arr[1][16]  ) { 
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; 
										for ($cicloj=16; $cicloj<24; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; 
										}
										$storyCns[] = $story0; 
										$story0=array();
										$moreInfo = true;
									}
								
							}
							else if($j==17 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {
						$inTableOther = false;
						$print .= "<tr class='active'>";
						$cont++; 
						for($j=16;$j<24;$j++) {
							 if ($j == 16) {
							 		if ($arr[$i][$j] != $arr[$i+1][16]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 16; $ciclojother < 24; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyCns[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][16]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."cns'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."cns' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyCns)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyCns = array();
										}
							 			
							 		}
							}
							else if($j==17 && $inTableOther) {
							    $arrPin[] = $arr[$i][$j];
                                $d = new DateTime($arr[$i][$j]);
                                $data = $d->format('Y-m-d');
                                $print .= "<td class='active'>".$data. "</td>";
                            }
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
						}	
					}
					$print .= "</tr>";
				}
			}
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
			
			$inTable = false;
			$moreInfo = false;
			$storyEyes = array();
			if ($eyes) 
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>leber amaurosis:</th> <th>retinopathy:</th> 
				<th>coloboma:</th></tr>";
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=24;$j<29;$j++) {
							if ($j == 24) {
									if ($arr[0][24] != $arr[1][24]  ) { 
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; 
										for ($cicloj=24; $cicloj<29; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; 
										}
										$storyEyes[] = $story0; 
										$story0=array();
										$moreInfo = true;
									}
							}
							else if($j==25 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
								
						}
					}
					else {
						$print .= "<tr class='active'>";
						$inTableOther = false;
						$cont++;
						for($j=24;$j<29;$j++) {
							if ($j == 24) {
									if ($arr[$i][$j] != $arr[$i+1][24]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 24; $ciclojother < 29; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyEyes[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][24]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."eyes'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."eyes' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyEyes)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyEyes = array();
										}
							 			
							 		}
							}
							else if($j==25 && $inTableOther) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
						$print .= "</tr>";
					}
				}
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th></tr>";

			$inTable = false;
			$moreInfo = false;
			$storyKid = array();
			if ($kidneys) 
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>renal failure:</th> <th>nph:</th> 
				<th>cystis:</th> <th>eco blood alterations:</th></tr>";
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=29;$j<35;$j++) {
							if ($j == 29) {
									if ($arr[0][29] != $arr[1][29]  ) { // se e' diverso dall'ng del secondo elemento, lo stampa perche' c'Ã¨ solo quello
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; //potrei anche non farla
										for ($cicloj=29; $cicloj<35; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; // se quello dopo e' uguale, aggiunge in coda l'elemento con quell'ng
										}
										$storyKid[] = $story0; // il primo array ha tutti gli elementi del primo record
										$story0=array();
										$moreInfo = true;
									}
							}
							else if($j==30 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$inTableOther = false;
						$cont++;
						for($j=29;$j<35;$j++) {
							if ($j == 29) {
									if ($arr[$i][$j] != $arr[$i+1][29]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 29; $ciclojother < 35; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyKid[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][24]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."kid'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."kid' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyKid)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyKid = array();
										}
							 			
							 		}
							}
							else if($j==30 && $inTableOther) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
						$print .= "</tr>";
					}
				}
			
			$print .= "<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>";

			$inTable = false;
			$moreInfo = false;
			$storyLiver = array();
			if ($liver) 
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>eco blood alterations:</th> <th>hf:</th></tr>";
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=35;$j<39;$j++) {
							if ($j == 35) {
								if ($arr[0][35] != $arr[1][35]  ) { // se e' diverso dall'ng del secondo elemento, lo stampa perche' c'Ã¨ solo quello
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
								}
								else {
										$cicloj = $j; //potrei anche non farla
										for ($cicloj=35; $cicloj<39; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; // se quello dopo e' uguale, aggiunge in coda l'elemento con quell'ng
										}
										$storyLiver[] = $story0; // il primo array ha tutti gli elementi del primo record
										$story0=array();
										$moreInfo = true;
									}
							}
							else if($j==36 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$inTableOther = false;
						$cont++;
						for($j=35;$j<39;$j++) {
							if ($j == 35) {
									if ($arr[$i][$j] != $arr[$i+1][35]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 35; $ciclojother < 39; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyLiver[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][35]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."liver'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."liver' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyLiver)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$arrPin[] = $arr[$i][$j];
 											$inTableOther = true;
 											$moreInfo = false;
											$storyLiver = array();
										}
							 			
							 		}
							}
							else if($j==36 && $inTableOther) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
						$print .= "</tr>";
					}
				}

			$print .= "<tr><th></th><th></th><th></th><th></th></tr>";

			$inTable = false;
			$moreInfo = false;
			$storyPoly = array();
			if ($polydactyly)  
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>postaxial:</th> <th>mesa preaxial:</th></tr>";	
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=45;$j<49;$j++) {
							if ($j == 45) {
									if ($arr[0][45] != $arr[1][45]  ) { // se e' diverso dall'ng del secondo elemento, lo stampa perche' c'Ã¨ solo quello
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; //potrei anche non farla
										for ($cicloj=45; $cicloj<49; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; // se quello dopo e' uguale, aggiunge in coda l'elemento con quell'ng
										}
										$storyPoly[] = $story0; // il primo array ha tutti gli elementi del primo record
										$story0=array();
										$moreInfo = true;
									}
							}
							else if($j==46 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    } 
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$inTableOther = false;
						$cont++;
						for($j=45;$j<49;$j++) {
							if ($j == 45) {
								if ($arr[$i][$j] != $arr[$i+1][45]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 45; $ciclojother < 49; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyPoly[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][45]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."poly'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."poly' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyPoly)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyPoly = array();
										}
							 			
							 		}
							}
							else if($j==46 && $inTableOther) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
						$print .= "</tr>";
					}
				}
			
			$print .= "<tr><th></th><th></th><th></th><th></th></tr>";

			$inTable = false;
			$moreInfo = false;
			$storyTongue = array();
			if ($tongue) 
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>cleft lip palat:</th></tr>";
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=49;$j<52;$j++) {
							if ($j == 49) {
								if ($arr[0][49] != $arr[1][49]  ) { // se e' diverso dall'ng del secondo elemento, lo stampa perche' c'Ã¨ solo quello
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; //potrei anche non farla
										for ($cicloj=49; $cicloj<52; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; // se quello dopo e' uguale, aggiunge in coda l'elemento con quell'ng
										}
										$storyTongue[] = $story0; // il primo array ha tutti gli elementi del primo record
										$story0=array();
										$moreInfo = true;
									}
							}
							else if($j==50 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {
						$print .= "<tr class 'active'>";
						$inTableOther = false;
						$cont++;
						for($j=49;$j<52;$j++) {
							if ($j == 49) {
								if ($arr[$i][$j] != $arr[$i+1][49]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 49; $ciclojother < 52; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyTongue[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][49]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."tongue'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."tongue' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyTongue)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyTongue = array();
										}
							 			
							 		}
							}
							else if($j==50 && $inTableOther) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }   
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
						$print .= "</tr>";
					}
				}
				$print .= "<tr><th></th><th></th><th></th></tr>";

			$inTable = false;
				$moreInfo = false;
				$storyMti = array();
				if ($mti)
				$print .= "<tr class='success'><th>NG:</th> <th>InsertionDate:</th> <th>em cele:</th> <th>hydroceph:</th> 
				<th>dw:</th> <th>cc hypopl:</th></tr>";	
				
				$cont = 0;
				$story0 = array();
				for($i=0;$i<count($arr);$i++) {
					
					$row = $arr[$i];
					if ($i == $cont) {
						for($j=39;$j<45;$j++) {
							if ($j == 39) {
								if ($arr[0][39] != $arr[1][39]  ) { // se e' diverso dall'ng del secondo elemento, lo stampa perche' c'Ã¨ solo quello
										$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
										$inTable = true;
										
									}
									else {
										$cicloj = $j; //potrei anche non farla
										for ($cicloj=39; $cicloj<45; $cicloj++) { 
											$story0[] = $arr[0][$cicloj]; // se quello dopo e' uguale, aggiunge in coda l'elemento con quell'ng
										}
										$storyMti[] = $story0; // il primo array ha tutti gli elementi del primo record
										$story0=array();
										$moreInfo = true;
									}
							}
							else if($j==40 && $inTable) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else if ($inTable) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
						}
					}
					else {
						$print .= "<tr class='active'>";
						$inTableOther = false;
						$cont++;
						for($j=39;$j<45;$j++) {
							if ($j == 39) {
								if ($arr[$i][$j] != $arr[$i+1][39]) {
							 			$zig = true;
									}
									else {
										$ciclojother = 0;
										for ($ciclojother = 39; $ciclojother < 45; $ciclojother++) {
											$story[] = $arr[$i][$ciclojother]; 
										}
										$storyMti[] = $story;  
										$story = array();
										$moreInfo = true;
									}
									if ($arr[$i][$j] != $arr[$i+1][39]) {
							 			if ( !($moreInfo) ) {
							 				$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
											$inTableOther = true;
							 			}
										else {
										    $print .= "<td class='active'>
 														<div class='panel-group' id='accordion'>
 															<div class='panel panel-default'>
 																<div class='panel-heading'>
 																<h4 class='panel-title'>
 																	<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$arr[$i][$j]."mti'>".$arr[$i][$j] . "</a></h4>
 																</div>
 																<div id='collapse".$arr[$i][$j]."mti' class='panel-collapse collapse'>
  																<div class='panel-body'>". tableDuplicate($storyMti)."</div></div>
  															</div> 
  														</div>
  														</td> ";
 											$inTableOther = true;
 											$moreInfo = false;
											$storyMti = array();
										}
							 			
							 		}
							}
							else if($j==40 && $inTableOther) {
						        $d = new DateTime($arr[$i][$j]);
						        $data = $d->format('Y-m-d');
						        $print .= "<td class='active'>".$data. "</td>";
						    }  
							else if ($inTableOther) {
								$print .= "<td class='active'>".$arr[$i][$j] . "</td>";
							}
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