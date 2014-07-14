<?php

include '../persistence/Log.php';
include '../model/Patient.php';
include '../model/Cns.php';
include '../model/Eyes.php';
include '../model/Kidneys.php';
include '../model/Liver.php';
include '../model/Mti.php';
include '../model/Polydactyly.php';
include '../model/Tongue.php';

class Query {
	
		public static function add_constraints($arr,$bool=" AND ") {
		$query = "";	
		$first = true;	
		if($bool == "OR" || $bool == " or " || $bool == "or")
			$bool = " OR ";
		if($bool != " OR " && $bool != " AND ")
			$bool = " AND ";
		foreach(array_keys($arr) as $key){
    		$value = $arr[$key];
			// entra solo se value diverso da 0
    		if($value) {
    			if($first) {
    				$first = false;
					$query .= $key." = "."'".$value."'";
    			}
				else {
					$query .= $bool.$key." = "."'".$value."'";
				}
    		}
		}
		return $query;
	}
	
	public function add_from($arr)
	{
		$query = " FROM ";
		$first = true;
		foreach(array_keys($arr) as $key){
    		$value = $arr[$key];
			// entra solo se value diverso da 0
    		if($value) {
    			if($first) {
    				$first = false;
					$query .= $key." ";
    			}
				else {
					$query .= ", ".$key." ";
				}
    		}
		}
		return $query;
	}
	
	public function queryMultyNG($array) {
		if(!isset($array) || count($array)<1) {
			$log = new Log();
			$log->emptyAll();
			$log->write('Errore non ci sono codici'. "<br /> <br />");	
			throw new Exception("Errore non ci sono codici");
		}
		$q = new Query();
		$patient = new Patient();
		$cns = new Cns();
		$eyes = new Eyes();
		$kidneys = new Kidneys();
		$liver = new Liver();
		$mti = new Mti();
		$polydactyly = new Polydactyly();
		$tongue = new Tongue();
		$query = $q -> internalQueryMultiple($patient,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
		
		if(!strstr($query,"WHERE")) {
			$query .= " WHERE (ng='".$array[0]."'";
		}
		else {
			$query .= " AND (ng='".$array[0]."'";
		}
		if(count($array)>1){
			for($i=1;$i<count($array);$i++) {
				$query .= " OR ng='".$array[$i]."'";
			}
		}
		$query .= ")";
		//echo $query;
		return $q -> connect_query($query);
	} 
	
	public function queryMultiple($patient,$cns=0,$eyes=0,$kidneys=0,$liver=0,$mti=0,$polydactyly=0,$tongue=0)
	{
		$q = new Query();
		$query = $q->internalQueryMultiple($patient,$cns,$eyes,$kidneys,$liver,$mti,$polydactyly,$tongue);
		//da togliere la stampa
		//echo $query;
		return $q -> connect_query($query);
	}
	
	public function internalQueryMultiple($patient,$cns=0,$eyes=0,$kidneys=0,$liver=0,$mti=0,$polydactyly=0,$tongue=0)
	{
		$query = "SELECT *";
		$queryArr = array('patient'=>$patient,'cns'=>$cns,'eyes'=>$eyes,'kidneys'=>$kidneys,'liver'=>$liver,
		'mti'=>$mti,'polydactyly'=>$polydactyly,'tongue'=>$tongue);
		
		$q = new Query();
		$from = $q -> add_from($queryArr);
		$query = $query.$from;
		$first = TRUE;
		$multiple = 0;
		//"ng=ng_cns and insertion_date=insertion_date_cns"
		$externalKey_ng = "";
		$externalKey_date = "";
		$externalKey = array();
		
		if($patient) {
			$multiple++;
			$result = $q -> queryPatient($patient->__get("ng"), $patient->__get("insertionDate"), $patient->__get("family"),
		$patient->__get("sex"), $patient->__get("consang"),$patient->__get("cns"), $patient->__get("eyes"), $patient->__get("kidneys"), 
		$patient->__get("liver"), $patient->__get("polydactyly"), $patient->__get("tongue"), $patient->__get("heart"),
		$patient->__get("dysmorphic"), $patient->__get("mti"), $patient->__get("notes"),$patient->__get("diagnosis"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng=";
				$externalKey_date = "insertion_date=";
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($cns) {
			$multiple++;
			$result = $q -> queryCns($cns->__get("ng"),$cns->__get("insertionDate"),$cns->__get("breath"),$cns->__get("id"),
			$cns->__get("hypotonia"),$cns->__get("ataxia"),$cns->__get("apraxia"),$cns->__get("nystagmus"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_cns=";
				$externalKey_date = "insertion_date_cns=";
			}
			else {
				$ek = array('ng_cns','insertion_date_cns');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($eyes) {
			$multiple++;
			$result = $q -> queryEyes($eyes->__get("ng"),$eyes->__get("insertionDate"),$eyes->__get("leberAmaurosis"), 
			$eyes->__get("retinopathy"), $eyes->__get("coloboma"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_eyes=";
				$externalKey_date = "insertion_date_eyes=";
			}
			else {
				$ek = array('ng_eyes','insertion_date_eyes');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($kidneys) {
			$multiple++;
			$result = $q -> queryKidneys($kidneys->__get("ng"),$kidneys->__get("insertionDate"),$kidneys->__get("renalFailure"), 
			$kidneys->__get("nph"), $kidneys->__get("cystis"), $kidneys->__get("ecoBloodAlterations"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_kidneys=";
				$externalKey_date = "insertion_date_kidneys=";
			}
			else {
				$ek = array('ng_kidneys','insertion_date_kidneys');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($liver) {
			$multiple++;
			$result = $q -> queryLiver($liver->__get("ng"),$liver->__get("insertionDate"),
			$liver->__get("ecoBloodAlterations"), $liver->__get("hf"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_liver=";
				$externalKey_date = "insertion_date_liver=";
			}
			else {
				$ek = array('ng_liver','insertion_date_liver');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($mti) {
			$multiple++;
			$result = $q -> queryMti($mti->__get("ng"),$mti->__get("insertionDate"), $mti->__get("emCele"), 
			$mti->__get("hydroceph"), $mti->__get("dw"), $mti->__get("ccHypopl"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_mti=";
				$externalKey_date = "insertion_date_mti=";
			}
			else {
				$ek = array('ng_mti','insertion_date_mti');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($polydactyly) {
			$multiple++;
			$result = $q -> queryPolydactyly($polydactyly->__get("ng"),$polydactyly->__get("insertionDate"),
			$polydactyly->__get("postaxial"), $polydactyly->__get("mesaPreaxial"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_polydactyly=";
				$externalKey_date = "insertion_date_polydactyly=";
			}
			else {
				$ek = array('ng_polydactyly','insertion_date_polydactyly');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		if($tongue) {
			$multiple++;
			$result = $q -> queryTongue($tongue->__get("ng"), $tongue->__get("insertionDate"), $tongue->__get("cleftLipPalat"));							
			if($first) {
				$first = FALSE;
				$externalKey_ng = "ng_tongue=";
				$externalKey_date = "insertion_date_tongue=";
			}
			else {
				$ek = array('ng_tongue','insertion_date_tongue');
				$externalKey[] = $ek;
			}
			if($result) {
				if(strstr($query,"WHERE"))
					$query .= " AND ";
				else 
					$query .= " WHERE ";
				
				$query .= $result;
			}
		}
		
		if($multiple>=2) {
			for($i=0;$i<count($externalKey);$i++) {
				if(!strstr($query,"WHERE")) {
					$query .= " WHERE ";
				}
				else {
					$query .= " AND ";
				}
				$ngAndDate = $externalKey[$i];
				$query .= $externalKey_ng.$ngAndDate[0];
				$query .= " AND ".$externalKey_date.$ngAndDate[1];
			}
		}
		
		return $query;
	}
	
	public static function queryPatient($ng=0,$insertion_date=0,$family=0,$sex=0,$consang=0,$cns=0,$eyes=0,
	$kidneys=0,$liver=0,$polydactyly=0,$tongue=0,$heart=0,$dysmorphic=0,$mti=0,$notes=0,$diagnosis=0,$bool=" AND ") {
		
		$queryArr = array('ng' => $ng, 'insertion_date'=>$insertion_date, 'family'=>$family, 'sex'=>$sex, 
		'consang'=>$consang, 'cns'=>$cns, 'eyes'=>$eyes, 'kidneys'=>$kidneys, 'liver'=>$liver,
		'polydactyly'=>$polydactyly, 'tongue'=>$tongue, 'heart'=>$heart, 'dysmorphic'=>$dysmorphic,
		'mti'=>$mti, 'notes'=>$notes,'diagnosis'=>$diagnosis);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}
	
	public static function queryCns($ng_cns=0,$insertion_date_cns=0,$breath=0,$id=0,$hypotonia=0,$ataxia=0,
	$apraxia=0,$nystagmus=0,$bool=" AND ") {
		
		$queryArr = array('ng_cns'=>$ng_cns, 'insertion_date_cns'=>$insertion_date_cns, 'breath'=>$breath, 'id'=>$id,
		'hypotonia'=>$hypotonia,'ataxia'=>$ataxia,'apraxia'=>$apraxia,'nystagmus'=>$nystagmus);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}

	public static function queryEyes($ng_eyes=0,$insertion_date_eyes=0,$leber_amaurosis=0,$retinopathy=0,
	$coloboma=0,$bool=" AND ") {
		
		$queryArr = array('ng_eyes'=>$ng_eyes, 'insertion_date_eyes'=>$insertion_date_eyes, 'leber_amaurosis'=>$leber_amaurosis,
		'retinopathy'=>$retinopathy,'coloboma'=>$coloboma);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}
	
	public static function queryKidneys($ng_kidneys=0,$insertion_date_kidneys=0,$renal_failure=0,$nph=0,
	$cystis=0,$eco_blood_alterations=0,$bool=" AND ") {
		
		$query = "SELECT * FROM kidneys";
		$queryArr = array('ng_kidneys'=>$ng_kidneys,'insertion_date_kidneys'=>$insertion_date_kidneys,
		'renal_failure'=>$renal_failure,'nph'=>$nph,'cystis'=>$cystis,'eco_blood_alterations'=>$eco_blood_alterations);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
		$query = $query.$constrains;
		//ovviamente da togliere in seguito
		//echo $query;
		//return $q -> connect_query($query);
		return $query;
	}
	
	public static function queryLiver($ng_liver=0,$insertion_date_liver=0,$eco_blood_alterations_liver=0,$hf=0,$bool=" AND ") {
		
		$query = "SELECT * FROM liver";
		$queryArr = array('ng_liver'=>$ng_liver,'insertion_date_liver'=>$insertion_date_liver,
		'eco_blood_alterations_liver'=>$eco_blood_alterations_liver,'hf'=>$hf);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}
	
	public static function queryMti($ng_mti=0,$insertion_date_mti=0,$em_cele=0,$hydroceph=0,$dw=0,$cc_hypopl=0,$bool=" AND ") {
		
		$query = "SELECT * FROM mti";
		$queryArr = array('ng_mti'=>$ng_mti, 'insertion_date_mti'=>$insertion_date_mti, 'em_cele'=>$em_cele,
		'hydroceph'=>$hydroceph,'dw'=>$dw,'cc_hypopl'=>$cc_hypopl);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}
	
	public static function queryPolydactyly($ng_polydactyly=0,$insertion_date_polydactyly=0,$postaxial=0,
	$mesa_preaxial=0,$bool=" AND ") {
		
		$query = "SELECT * FROM polydactyly";
		$queryArr = array('ng_polydactyly'=>$ng_polydactyly, 'insertion_date_polydactyly'=>$insertion_date_polydactyly,
		'postaxial'=>$postaxial, 'mesa_preaxial'=>$mesa_preaxial);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}

	public static function queryTongue($ng_tongue=0,$insertion_date_tongue=0,$cleft_lip_palat=0,$bool=" AND ") {
		
		$query = "SELECT * FROM tongue";
		$queryArr = array('ng_tongue'=>$ng_tongue, 'insertion_date_tongue'=>$insertion_date_tongue,
		'cleft_lip_palat'=>$cleft_lip_palat);
		
		$q = new Query();
		return $q -> add_constraints($queryArr,$bool);
	}
	
	public static function connect_query($query) {
		$arr = array(); 
		$log = new Log();
		$log->emptyAll();
		
        $mysqli = mysqli_connect('localhost', 'root', '', 'clinical_data');
        if (mysqli_connect_errno()) {
            $log->write(mysqli_connect_error() . "<br />");
            die;
        }
        if ($result = $mysqli->query($query)) {
            while($info = $result->fetch_array()) {
                $arr[] = $info;
            }
            $result->close(); 
        }
        else 
            $log->write($mysqli->error . "<br />");
        
        $mysqli->close();
		return $arr;
	}


}
?>

