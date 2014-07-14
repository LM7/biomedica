<?php
class Mti {

	// attributi
	private $ng;
	private $insertionDate;
	private $emCele;
	private $hydroceph;
	private $dw;
	private $ccHypopl;
	

	// costruttore
	public function __construct($ng=0,$insertionDate=0, $emCele=0, $hydroceph=0, $dw=0, $ccHypopl=0) {
		$this -> ng = $ng;
		$this -> insertionDate = $insertionDate;
		$this -> emCele = $emCele;
		$this -> hydroceph = $hydroceph;
		$this -> dw = $dw;
		$this -> ccHypopl = $ccHypopl;
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