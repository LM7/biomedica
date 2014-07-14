<?php

include '../persistence/Log.php';

class LoadRecord {
	
	private static function insertX($record) {
		//-3 perche' lui conta 40 colonne anche l'ultima vuota
		for($i=5;$i<37;$i++) {				
		if($record[$i]==null || ($record[$i] != 'y' && $record[$i] != 'n'))
			$record[$i] = 'x';	
		}
		return $record;
	}
	
	public static function Load($record,$row=1) {
		$log = new Log();
		if(count($record)<39) {
			$log->emptyAll();
			//$log->write('Il file Excel non rispetta lo standard'. "<br /> <br />");	
			throw new Exception("Il file Excel non rispetta lo standard");			
		}
		$lr = new LoadRecord();
		$record = $lr->insertX($record);	
		list($FAMILY, $NG, $YOB, $last_evaluation, $sex, $consang, $CNS, $breath, $id, $hypotonia, $ataxia, $apraxia, $nystagmus,
$EYES, $leber_amaurosis, $retinopathy, $coloboma, $KIDNEYS, $renal_failure, $nph, $Cystis, $eco_blood_alterations,
$LIVER, $eco_blood_alterations_liver, $hf, $POLYDACTYLY, $postaxial, $mesa_preaxial, $TONGUE, $cleft_lip_palate,
$HEART, $DYSMORPHIC_FEATURES, $MTI, $em_cele, $hydroceph, $dw, $cc_hypopl, $Notes, $Diagnosis) = $record;
	
		$success = 0;
		
		if($NG != null && is_numeric($NG)){	
			$mysqli = new mysqli('localhost', 'root', '', 'clinical_data');
			$mysqli->autocommit(true);
						
			date_default_timezone_set("Europe/Rome");
			//$insertion_date = date("Y-m-d H:i:s");
			$insertion_date = date("Y-m-d");
			
			//riempie tabella patient
			
			$Notes = str_replace("'"," ",$Notes);
            $Notes = str_replace('"'," ",$Notes);
            $Diagnosis = str_replace("'"," ",$Diagnosis);
            $Diagnosis = str_replace('"'," ",$Diagnosis);
			
			$query= sprintf("INSERT INTO patient (ng, insertion_date, family, sex, consang, cns, eyes, kidneys, liver, polydactyly, 
			tongue, heart, dysmorphic, mti, notes, diagnosis) VALUES 
			('%s', '%s', '%s','%s', '%s', '%s','%s', '%s', '%s','%s', '%s', '%s','%s', '%s', '%s','%s')",$NG,$insertion_date,$FAMILY,
			$sex,$consang,$CNS,$EYES,$KIDNEYS,$LIVER,$POLYDACTYLY,$TONGUE,$HEART,$DYSMORPHIC_FEATURES,$MTI,$Notes,$Diagnosis);
		
			$dati=$mysqli->query($query);
			if($dati) {
				$success++;
			}
			else {
				$log->write( " fallimentoPatient riga: ".$row . "<br />");
			}
			
			if($success > 0) {
				$query= sprintf("INSERT INTO cns(ng_cns, insertion_date_cns, breath, id, hypotonia, ataxia, apraxia, nystagmus) VALUES 
				('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",$NG, $insertion_date, $breath , $id, $hypotonia, $ataxia, $apraxia, $nystagmus);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoCNS riga: ".$row . "<br />");	
					
					
				$query= sprintf("INSERT INTO eyes(ng_eyes, insertion_date_eyes, leber_amaurosis, retinopathy, coloboma) VALUES 
				('%s', '%s', '%s', '%s', '%s')",$NG, $insertion_date, $leber_amaurosis, $retinopathy, $coloboma);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoEYES riga: ".$row . "<br />");		
				
				
				$query= sprintf("INSERT INTO kidneys(ng_kidneys, insertion_date_kidneys, renal_failure, nph, cystis, eco_blood_alterations) VALUES 
				('%s', '%s', '%s', '%s', '%s', '%s')",$NG, $insertion_date, $renal_failure, $nph, $Cystis, $eco_blood_alterations);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoKIDNEYS riga: ".$row . "<br />");	
				
				
				$query= sprintf("INSERT INTO liver(ng_liver, insertion_date_liver, eco_blood_alterations_liver, hf) VALUES 
				('%s', '%s', '%s', '%s')",$NG, $insertion_date, $eco_blood_alterations_liver, $hf);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoLIVER riga: ".$row . "<br />");	
				
				
				$query= sprintf("INSERT INTO polydactyly (ng_polydactyly, insertion_date_polydactyly, postaxial, mesa_preaxial) VALUES 
				('%s', '%s', '%s', '%s')",$NG, $insertion_date, $postaxial, $mesa_preaxial);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoPOLYDACTYLY riga: ".$row . "<br />");	
				
				
				$query= sprintf("INSERT INTO tongue(ng_tongue, insertion_date_tongue, cleft_lip_palat) VALUES
				('%s', '%s', '%s')",$NG, $insertion_date, $cleft_lip_palate);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoTONGUE riga: ".$row . "<br />");				
				
				
				$query= sprintf("INSERT INTO mti(ng_mti, insertion_date_mti, em_cele, hydroceph, dw, cc_hypopl) VALUES 
				('%s', '%s', '%s', '%s', '%s', '%s')",$NG, $insertion_date, $em_cele, $hydroceph, $dw, $cc_hypopl);
			
				$dati=$mysqli->query($query);
				if($dati)
					$success++;
				else 
					$log->write( " fallimentoMTI riga: ".$row . "<br />");
								
			}
			$mysqli->close();			
		}
		
		else {
			$log->write( " fallimento NG e' vuoto o non e' un numero riga: ".$row . "<br />");
		}

		if($success == 8)
			return 1;
		else
			return 0;
		
	}

}

?>