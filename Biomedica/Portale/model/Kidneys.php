<?php
class Kidneys {

	// attributi
	private $ng;
	private $insertionDate;
	private $renalFailure;
	private $nph;
	private $cystis;
	private $ecoBloodAlterations;

	// costruttore
	public function __construct($ng=0,$insertionDate=0,$renalFailure=0, $nph=0, $cystis=0, $ecoBloodAlterations=0) {
		$this -> ng = $ng;	
		$this -> insertionDate = $insertionDate;
		$this -> renalFailure = $renalFailure;
		$this -> nph = $nph;
		$this -> cystis = $cystis;
		$this -> ecoBloodAlterations = $ecoBloodAlterations;
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