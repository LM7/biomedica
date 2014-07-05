<?php
include('../persistence/Query.php');
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
		<img src="logoMendelSS.jpg" id="imglogo" style="margin-left: 8.6cm; margin-top: 0cm" alt="immagine non visualizzata" width="130" height="150"/>
		
		<h3><br>Studio e analisi<br>della Sindrome di Joubert</h3>	
	
		<div class="panel panel-info"style="width:5cm;height:3cm;  margin-top:-2cm;  margin-left: 28cm">
  			<div class="panel-heading">
    		<h3 class="panel-title"> </h3>
			</div>
  			<div class="panel-body">
    		<span class="glyphicon glyphicon-user"></span>
    			<?php
    			session_start();
				if (isset($_SESSION["myusername"]))
					print "Benvenuto <strong> ".$_SESSION["myusername"];
				else
					print "Sessione scaduta";			
    			?>
    			</strong><br><br>
    		<button type="button" class="btn btn-primary btn-sm"style="margin-left: 1.5cm" onclick="location.href='../persistence/Logout.php'">Esci</button>
  			</div>
		</div>
		
		<h2><p style="color: #228B22" class="text-center">Inserisci i codici dei pazienti che vuoi modificare</p></h2>
		
		<form name="form" method="post">
		<input id="myText" type="text" style="width:5cm; margin-top:2cm; margin-left: 14cm" name="writePatient" class="form-control" placeholder="esempio: 310,316,407...">	
		<button id="button"  style="margin-left: 15.5cm; margin-top: 2cm" name="okPatient" class="btn btn-success">Modifica</button>
		</form>
		<div id="mydiv" class='alert alert-danger'  role='alert' style='height:2.5cm; display:none; margin-top:1cm; margin-left:20cm; width:5cm'><strong>Attenzione!</strong><br>Non hai inserito nessun codice </div>
		
		<script>
		$("#button").click(function( event ) {
			var myText = document.getElementById('myText').value;
			if(myText != "") {
				var esprReg = new RegExp("^([0-9][0-9]*,)*([0-9][0-9]*)$");
				if (esprReg.test(myText)) {
					alert("oooooooook");
				}
				else {
					alert("noooo");
				}
			}		
			else{
				event.preventDefault();
				var elem = document.getElementById('mydiv');
				$(elem).show();
			}
		
        
		});
		</script>
		
		<?php
		function show($arr,$patient=0,$cns=0,$eyes=0,$kidneys=0,$liver=0,$mti=0,$polydactyly=0,$tongue=0) {
			//table table-striped	
			$print = '<table class="table table-striped" border=1 cellpadding=3 style="width:25cm; margin-left: 1cm; margin-right: 1cm; margin-top: 1cm">'; 
			$print .= "<tr>";
			if ($patient)
				$print .= "<th>NG:</th> <th>insertion_date:</th> <th>family:</th> <th>sex:</th> <th>consang:</th> <th>cns:</th>
				<th>eyes:</th> <th>kidneys:</th> <th>liver:</th> <th>polydactyly:</th> <th>tongue:</th> <th>heart:</th>
				<th>dysmorphic:</th> <th>mti:</th> <th>notes:</th> <th>diagnosis:</th>";
			
			if ($cns)
				$print .= "<th>ng_cns:</th> <th>insertion_date_cns:</th> <th>breath:</th> <th>id:</th> <th>hypotonia:</th> 
				<th>ataxia:</th> <th>apraxia:</th> <th>nystagmus:</th>";
		
			if ($eyes)
				$print .= "<th>ng_eyes:</th> <th>insertion_date_eyes:</th> <th>leber_amaurosis:</th> <th>retinopathy:</th> 
				<th>coloboma:</th>";
			
			if ($kidneys)
				$print .= "<th>ng_kidneys:</th> <th>insertion_date_kidneys:</th> <th>renal_failure:</th> <th>nph:</th> 
				<th>cystis:</th> <th>eco_blood_alterations:</th>";
			
			if ($liver)
				$print .= "<th>ng_liver:</th> <th>insertion_date_liver:</th> <th>eco_blood_alterations_liver:</th> <th>hf:</th>";	
			
			if ($mti)
				$print .= "<th>ng_mti:</th> <th>insertion_date_mti:</th> <th>em_cele:</th> <th>hydroceph:</th> 
				<th>dw:</th> <th>cc_hypopl:</th>";	
			
			if ($polydactyly)
				$print .= "<th>ng_polydactyly:</th> <th>insertion_date_polydactyly:</th> <th>postaxial:</th> <th>mesa_preaxial:</th>";	
			
			if ($tongue)
				$print .= "<th>ng_tongue:</th> <th>insertion_date_tongue:</th> <th>cleft_lip_palat:</th>";	
			
			$print .= "</tr> ";
			for($i=0;$i<count($arr);$i++) {
				$print .= "<tr>";
				$row = $arr[$i];
				for($j=0;$j<count($row)/2;$j++) {
					$print .= "<td>".$arr[$i][$j] . "</td> "; 
				}
			$print .= "</tr>";
			}
			$print .= "</table>"; 
			return $print;
		}
		
		/*$q = new Query();
		$patient = new Patient(0,306);
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
		
</html>