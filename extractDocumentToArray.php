<?php
/**
* Israel
*/
require_once 'archivos/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
class ShortUrl
{
	function readCSV($csvFile){
	    $csv_files = fopen($csvFile, 'r');
	    while (!feof($csv_files) ) {
	        $array_csv[] = fgetcsv($csv_files, 1024);
	    }
	    fclose($csv_files);
	    return $array_csv;
	}

	function readXLS($xlsFile){

		// $data = new Spreadsheet_Excel_Reader();
		// $data->setOutputEncoding('CP1251');
		// $data->read($xlsFile);
		// $array_xls = array();
		// for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
		// 	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		// 		$xlsData = $data->sheets[0]['cells'][$i][$j];
		// 		array_push($array_xls, $xlsData);
		// 	}
		// }
		// //unlink("archivos/excel.xls");
		$objPHPExcel = PHPExcel_IOFactory::load($xlsFile);
	
		//Asigno la hoja de calculo activa
		$objPHPExcel->setActiveSheetIndex(0);
		//Obtengo el numero de filas del archivo
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		
		
		$array_xls = array();
		for ($i = 1; $i <= $numRows; $i++) {
			
			$url = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			
			array_push($array_xls, $url);
		}
		unlink($xlsFile);
		return $array_xls;
	}
}
?>