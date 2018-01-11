<?php
/**
* Israel
*/
include_once("archivos/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
include_once("MySQLConnection.php");
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
		$objPHPExcel = PHPExcel_IOFactory::load($xlsFile);
	
		//Asigno la hoja de calculo activa
		$objPHPExcel->setActiveSheetIndex(0);
		//Obtengo el numero de filas del archivo
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		
		
		$array_xls = array();
		$tiempo_inicio=microtime(true);
		for ($i = 1; $i <= $numRows; $i++) {
			
			$url = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			
			array_push($array_xls, $url);
		}
		
		$tiempo_fin=microtime(true);

		echo "El array se ha generado en ".($tiempo_fin-$tiempo_inicio)." segundos"."</br>";
		//echo count($array_xls)."</br>";
		$lista_simple = array_values(array_unique($array_xls));
		//echo count($lista_simple)."</br>";
		$excel_new = array();
		$connectToBD = new MySQLConnection();
		$openConnection = $connectToBD->connectToMySQL('localhost', 'emailings', 'DksQcaPP1waV', 'emailings');
		$tiempo_iniciodos=microtime(true);
		foreach ($lista_simple as $fileXls) {
			$query_exist_register = "select Id from short_url where upper(Large_Url) = upper('".$fileXls."') " ;
			$exist_register = $connectToBD->executeQuery($query_exist_register);
			if ($exist_register->num_rows == 0) {
				array_push($excel_new, $fileXls);	
		    }
		}
		$closeConnection = $connectToBD->disconnectMySQL($openConnection);
		echo 'conexion cerrada'.'</br>';
		$tiempo_findos=microtime(true);
		echo "La comprabacion en BBDD se realizo en ".($tiempo_findos-$tiempo_iniciodos)." segundos"."</br>";
		unlink($xlsFile);
		//print_r($excel_new);
		return $excel_new;
	}
}
?>