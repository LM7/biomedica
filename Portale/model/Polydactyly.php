<?php
class Polydactyly {

	// attributi
	private $ng;
	private $insertionDate;
	private $postaxial;
	private $mesaPreaxial;

	// costruttore
	public function __construct($ng=0,$insertionDate=0,$postaxial=0, $mesaPreaxial=0) {
		$this -> ng = $ng;	
		$this -> insertionDate = $insertionDate;
		$this -> postaxial = $postaxial;
		$this -> mesaPreaxial = $mesaPreaxial;
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