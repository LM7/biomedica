<?php
class Patient {

	// attributi
	private $family;
	private $ng;
	private $insertionDate;
	private $sex;
	private $consang;
	private $cns;
	private $eyes;
	private $kidneys;
	private $liver;
	private $polydactyly;
	private $tongue;
	private $heart;
	private $dysmorphic;
	private $mti;
	private $notes;
	private $diagnosis;

	// costruttore
	public function __construct($family=0, $ng=0, $insertionDate=0, $sex=0, $consang=0, $cns=0, $eyes=0, $kidneys=0, $liver=0, $polydactyly=0, $tongue=0, $heart=0, $dysmorphic=0, $mti=0, $notes=0, $diagnosis=0) {
		$this -> family = $family;
		$this -> ng = $ng;
		$this -> insertionDate = $insertionDate;
		$this -> sex = $sex;
		$this -> consang = $consang;
		$this -> cns = $cns;
		$this -> eyes = $eyes;
		$this -> kidneys = $kidneys;
		$this -> liver = $liver;
		$this -> polydactyly = $polydactyly;
		$this -> tongue = $tongue;
		$this -> heart = $heart;
		$this -> dysmorphic = $dysmorphic;
		$this -> mit = $mti;
		$this -> notes = $notes;
		$this -> diagnosis = $diagnosis;
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