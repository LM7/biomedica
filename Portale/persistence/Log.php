<?php

class Log {
	
	public function __construct() {
	}
	
	
	public static function emptyAll() {
		$var=fopen("../persistence/log.txt","w");
		fclose($var);
	}
	
	public static function write($s) {
		$var=fopen("../persistence/log.txt","a");
		fwrite($var, $s);
		fclose($var);
	}
	
	public static function read() {
		$var=fopen("../persistence/log.txt","r");
		$s = "";
		if(filesize("../persistence/log.txt") > 0) {
			$leggi=fread($var,filesize("../persistence/log.txt"));
			$s=nl2br($leggi);
		}
		fclose($var);
		return $s;
	}
	
	
}

?>