<?php
/**
* Israel
*/
require_once 'Excel/reader.php';
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

		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($xlsFile);
		$array_xls = array();
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
				$xlsData = $data->sheets[0]['cells'][$i][$j];
				array_push($array_xls, $xlsData);
			}
		}
		return $array_xls;
	}
}
?>