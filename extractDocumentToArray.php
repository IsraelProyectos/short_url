<?php
/**
* Israel
*/
include_once("archivos/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
include_once("MySQLConnection.php");
class ShortUrl
{
	function readCSV($csvFile){
		$array_csv = array();
	    $csv_files = fopen($csvFile, 'r');
	    $tiempo_inicio=microtime(true);
	    while (($datos = fgetcsv($csv_files, ",")) == true) {
	        //$array_csv = fgetcsv($csv_files, 1024);
	        for ($i=0; $i < count($csv_files) ; $i++) { 
	        	array_push($array_csv, $datos[$i]);
	        }
	        
	    }
	    fclose($csv_files);

	    $tiempo_fin=microtime(true);

		echo "El array se ha generado en ".($tiempo_fin-$tiempo_inicio)." segundos"."</br>";
		//echo count($array_xls)."</br>";
		$array_excel_unique = array_values(array_unique($array_csv));
		//echo count($array_excel_unique)."</br>";
		$excel_unique = array();
		$connectToBD = new MySQLConnection();
		$openConnection = $connectToBD->connectToMySQL('db480544677.db.1and1.com','dbo480544677','lokomotiv1973','db480544677');
		$tiempo_iniciodos=microtime(true);

		foreach ($array_excel_unique as $fileXls) {
			// for ($i=0; $i < count($fileXls) ; $i++) {
			// 	$file = $fileXls[0]; 
				$query_exist_register = "select Id from short_url where upper(Large_Url) = upper('".$fileXls."') " ;
				$exist_register = $connectToBD->executeQuery($query_exist_register);
				if ($exist_register->num_rows == 0) {
				array_push($excel_unique, $fileXls);	
		    	}
			//}
			
		}
		$closeConnection = $connectToBD->disconnectMySQL($openConnection);
		echo 'conexion cerrada'.'</br>';
		$tiempo_findos=microtime(true);
		echo "La comprobacion en BBDD se realizo en ".($tiempo_findos-$tiempo_iniciodos)." segundos"."</br>";
		unlink($csvFile);
	    return $excel_unique;
	}

	function readXLS($xlsFile){
		$objPHPExcel = PHPExcel_IOFactory::load($xlsFile);
	
		//Asigno la hoja de calculo activa
		$objPHPExcel->setActiveSheetIndex(0);
		//Obtengo el numero de filas del archivo
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		
		
		$array_excel = array();
		$tiempo_inicio=microtime(true);
		for ($i = 1; $i <= $numRows; $i++) {
			
			$url = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			
			array_push($array_excel, $url);
		}
		
		$tiempo_fin=microtime(true);

		echo "El array se ha generado en ".($tiempo_fin-$tiempo_inicio)." segundos"."</br>";
		//echo count($array_xls)."</br>";
		$array_excel_unique = array_values(array_unique($array_excel));
		//echo count($array_excel_unique)."</br>";
		$excel_unique = array();
		$connectToBD = new MySQLConnection();
		$openConnection = $connectToBD->connectToMySQL('db480544677.db.1and1.com','dbo480544677','lokomotiv1973','db480544677');
		$tiempo_iniciodos=microtime(true);
		foreach ($array_excel_unique as $fileXls) {
			$query_exist_register = "select Id from short_url where upper(Large_Url) = upper('".$fileXls."') " ;
			$exist_register = $connectToBD->executeQuery($query_exist_register);
			if ($exist_register->num_rows == 0) {
				array_push($excel_unique, $fileXls);	
		    }
		}
		$closeConnection = $connectToBD->disconnectMySQL($openConnection);
		echo 'conexion cerrada'.'</br>';
		$tiempo_findos=microtime(true);
		echo "La comprobacion en BBDD se realizo en ".($tiempo_findos-$tiempo_iniciodos)." segundos"."</br>";
		unlink($xlsFile);
		//print_r($excel_new);
		return $excel_unique;
	}
}
?>