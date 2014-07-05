<?php

include 'ReadExcel.php';

class FromExcelToDB {
	public function load($path)
	{
		$log = new Log();
		$log->emptyAll();
		
		//$path = 'db_clinico.xlsx';
		$readExcel = new ReadExcel();
		$recordAdd = $readExcel->read($path);
	
		return ("Sono stati aggiunti $recordAdd record" . "<br />");
	
	
		//echo ($log->read());
	}
}


?>