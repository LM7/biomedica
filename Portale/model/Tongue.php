<?php
class Tongue {

	// attributi
	private $ng;
	private $insertionDate;
	private $cleftLipPalat;
	

	// costruttore
	public function __construct($ng=0, $insertionDate=0, $cleftLipPalat=0) {
		$this -> ng = $ng;
		$this -> insertionDate = $insertionDate;
		$this -> cleftLipPalat = $cleftLipPalat;
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