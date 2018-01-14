<?php
ini_set('error_reporting', E_ALL-E_NOTICE);
ini_set('display_errors', 1);
include_once('extractDocumentToArray.php');
include_once('MySQLConnection.php');
class readFileStart
{
	function startRead($file){
		$csvFile = $file;
		$xlsFile = $file;
		$ShortUrl = new ShortUrl();
		$extension = explode(".", $file);
		$extensionFile = end($extension);
		
		$connectToBD = new MySQLConnection();
		$openConnection = $connectToBD->connectToMySQL('db480544677.db.1and1.com','dbo480544677','lokomotiv1973','db480544677');
		if ($extensionFile == "csv") {
			$arrayCSV = $ShortUrl->readCSV($csvFile);
			$executeQuery = $connectToBD->query($arrayCSV);
			// foreach ($arrayCSV as $fileCSV) {
			// 	echo $fileCSV."</br>";
			// }
		}
		elseif ($extensionFile == "xlsx") {
			$arrayXLS = $ShortUrl->readXLS($xlsFile);
			$executeQuery = $connectToBD->query($arrayXLS);
		}
		else{
			echo "El archivo a cargar no es correcto </br>";
		}
		//$numero = 0;
		// foreach ($arrayXLS as $name) {
		// 	echo $name."</br>";
		// 	//$numero += 1;
		// }
		//echo $numero;
		//print_r($arrayXLS);
		$closeConnection = $connectToBD->disconnectMySQL($openConnection);
		echo 'conexion terminada';
		//print_r($arrayCSV[0][0]);
		//print_r($arrayXLS[0]);
	}
}
?>