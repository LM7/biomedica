<?php
class Cns {

	// attributi
	private $ng;
	private $insertionDate;
	private $breath;
	private $id;
	private $hypotonia;
	private $ataxia;
	private $apraxia;
	private $nystagmus;

	// costruttore
	public function __construct($ng=0, $insertionDate=0, $breath=0, $id=0, $hypotonia=0, $ataxia=0, $apraxia=0, $nystagmus=0) {
		$this -> ng = $ng;	
		$this -> insertionDate = $insertionDate;
		$this -> breath = $breath;
		$this -> id = $id;
		$this -> hypotonia = $hypotonia;
		$this -> ataxia = $ataxia;
		$this -> apraxia = $apraxia;
		$this -> nystagmus = $nystagmus;
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