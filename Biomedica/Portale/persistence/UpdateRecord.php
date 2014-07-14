<?php

include '../persistence/Query.php';

class UpdateRecord {
	
	public static function Update($record,$row=1) {
		
		$log = new Log();
	
	list($NG, $insertion_date, $FAMILY, $YOB, $last_evaluation, $sex, $consang, $CNS, $breath, $id, $hypotonia, $ataxia, $apraxia, $nystagmus,
$EYES, $leber_amaurosis, $retinopathy, $coloboma, $KIDNEYS, $renal_failure, $nph, $Cystis, $eco_blood_alterations,
$LIVER, $eco_blood_alterations_liver, $hf, $POLYDACTYLY, $postaxial, $mesa_preaxial, $TONGUE, $cleft_lip_palate,
$HEART, $DYSMORPHIC_FEATURES, $MTI, $em_cele, $hydroceph, $dw, $cc_hypopl, $Notes, $Diagnosis) = $record;
	
		$success = 0;
		
		if($NG != null && is_numeric($NG)){	
			$mysqli = new mysqli('localhost', 'root', '', 'clinical_data');
            
            if (mysqli_connect_errno()) {
                $log->write(mysqli_connect_error() . "<br />");
                die;
            }
			$mysqli->autocommit(true);
						
			$Notes = str_replace("'"," ",$Notes);
            $Notes = str_replace('"'," ",$Notes);
            $Diagnosis = str_replace("'"," ",$Diagnosis);
            $Diagnosis = str_replace('"'," ",$Diagnosis);
			
			$query= sprintf("UPDATE patient SET ng='".$NG."' , insertion_date='".$insertion_date."', family='".$FAMILY.
			"', sex='".$sex."', consang='".$consang."', cns='".$CNS."' , eyes='".$EYES."', kidneys='".$KIDNEYS.
			"', liver='".$LIVER."', polydactyly='".$POLYDACTYLY."', tongue='".$TONGUE."', heart='".$HEART."', dysmorphic='"
			.$DYSMORPHIC_FEATURES."', mti='".$MTI."', notes='".$Notes."', diagnosis='".$Diagnosis."' WHERE ng='".$NG.
			"' AND insertion_date='".$insertion_date."'");
		
			$dati=$mysqli->query($query);
			if($dati) {
				$success++;
			}
			else {
				$log->write( "fallimentoPatient riga: ".$row . "<br />");
			}
			
			if($success > 0) {
				$query= sprintf("UPDATE cns SET ng_cns='".$NG."', insertion_date_cns='".$insertion_date."', breath='".
				$breath."', id='".$id."', hypotonia='".$hypotonia."', ataxia='".$ataxia."', apraxia='".$apraxia.
				"', nystagmus='".$nystagmus."' WHERE ng_cns='".$NG."' AND insertion_date_cns='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoCNS riga: ".$row . "<br />");	
					
					
				$query= sprintf("UPDATE eyes SET ng_eyes='".$NG."', insertion_date_eyes='".$insertion_date.
				"', leber_amaurosis='".$leber_amaurosis."', retinopathy='".$retinopathy."', coloboma='".$coloboma.
				"' WHERE ng_eyes='".$NG."' AND insertion_date_eyes='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoEYES riga: ".$row . "<br />");		
				
				
				$query= sprintf("UPDATE kidneys SET ng_kidneys='".$NG."', insertion_date_kidneys='".$insertion_date.
				"', renal_failure='".$renal_failure."', nph='".$nph."', cystis='".$Cystis."', eco_blood_alterations='".
				$eco_blood_alterations."' WHERE ng_kidneys='".$NG."' AND insertion_date_kidneys='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoKIDNEYS riga: ".$row . "<br />");	
				
				
				$query= sprintf("UPDATE liver SET ng_liver='".$NG."', insertion_date_liver='".$insertion_date.
				"', eco_blood_alterations_liver='".$eco_blood_alterations_liver."', hf='".$hf.
				"' WHERE ng_liver='".$NG."' AND insertion_date_liver='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoLIVER riga: ".$row . "<br />");	
				
				
				$query= sprintf("UPDATE polydactyly SET ng_polydactyly='".$NG."', insertion_date_polydactyly='".
				$insertion_date."', postaxial='".$postaxial."', mesa_preaxial='".$mesa_preaxial.
				"' WHERE ng_polydactyly='".$NG."' AND insertion_date_polydactyly='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoPOLYDACTYLY riga: ".$row . "<br />");	
				
				
				$query= sprintf("UPDATE tongue SET ng_tongue='".$NG."', insertion_date_tongue='".$insertion_date.
				"', cleft_lip_palat='".$cleft_lip_palate."' WHERE ng_tongue='".$NG."' AND insertion_date_tongue='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoTONGUE riga: ".$row . "<br />");				
				
				
				$query= sprintf("UPDATE mti SET ng_mti='".$NG."', insertion_date_mti='".$insertion_date.
				"', em_cele='".$em_cele."', hydroceph='".$hydroceph."', dw='".$dw."', cc_hypopl='".$cc_hypopl.
				"' WHERE ng_mti='".$NG."' AND insertion_date_mti='".$insertion_date."'");
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( "fallimentoMTI riga: ".$row . "<br />");
								
			}
			$mysqli->close();			
		}
		
		else {
			$log->write( "fallimento NG e'vuoto o non e' un numero riga: ".$row . "<br />");
		}
		
		if($success == 8)
			return 1;
		else
			return 0;
		
	}

}

?>