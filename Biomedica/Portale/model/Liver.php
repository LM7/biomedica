<?php
class Liver {

	// attributi
	private $ng;
	private $insertionDate;
	private $ecoBloodAlterations;
	private $hf;

	// costruttore
	public function __construct($ng=0,$insertionDate=0,$ecoBloodAlterations=0, $hf=0) {
		$this -> ng = $ng;	
		$this -> insertionDate = $insertionDate;
		$this -> ecoBloodAlterations = $ecoBloodAlterations;
		$this -> hf = $hf;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this -> $property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this -> $property = $value;
		}
	}

}
?>