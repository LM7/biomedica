<?php

include 'Excel/Classes/PHPExcel/IOFactory.php';
include 'LoadRecord.php';

date_default_timezone_set("Europe/Rome");

class ReadExcel {
		
	//esempio di path C:\xampp\htdocs\informatica_biomedica\Portale\persistence\indirizzi.xls
	public static function Read($path) {

		try {
			$inputFileType = PHPExcel_IOFactory::identify($path);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader -> load($path);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($path, PATHINFO_BASENAME) . '": ' . $e -> getMessage());
		}

		//  Get worksheet dimensions
		$sheet = $objPHPExcel -> getSheet(0);
		$highestRow = $sheet -> getHighestRow();
		$highestColumn = $sheet -> getHighestColumn();

		$rowAdd = 0;
		for ($row = 2; $row <= $highestRow; $row++) {
			//  Read a row of data into an array
			$rowData = $sheet -> rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
		
			$loadRecord = new LoadRecord();
			$rowAdd += $loadRecord->load($rowData[0],$row);
		}
		
		return $rowAdd;
	}

}
?>