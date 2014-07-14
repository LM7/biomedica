<?php
class Eyes {

	// attributi
	private $ng;
	private $insertionDate;
	private $leberAmaurosis;
	private $retinopathy;
	private $coloboma;

	// costruttore
	public function __construct($ng=0,$insertionDate=0,$leberAmaurosis=0, $retinopathy=0, $coloboma=0) {
		$this -> ng = $ng;
		$this -> insertionDate = $insertionDate;	
		$this -> leberAmaurosis = $leberAmaurosis;
		$this -> retinopathy = $retinopathy;
		$this -> coloboma = $coloboma;
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