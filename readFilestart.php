<?php
ini_set('error_reporting', E_ALL-E_NOTICE);
ini_set('display_errors', 1);
include_once('extractDocumentToArray.php');
include_once('MySQLConnection.php');
class readFileStart
{
	function startRead($file){
		$csvFile = 'nombres.csv';
		$xlsFile = $file;
		$ShortUrl = new ShortUrl();
		// //$arrayCSV = $ShortUrl->readCSV($csvFile);
		$arrayXLS = $ShortUrl->readXLS($xlsFile);
		$connectToBD = new MySQLConnection();
		$openConnection = $connectToBD->connectToMySQL('localhost', 'emailings', 'DksQcaPP1waV', 'emailings');
		//$numero = 0;
		// foreach ($arrayXLS as $name) {
		// 	echo $name."</br>";
		// 	//$numero += 1;
		// }
		//echo $numero;
		//print_r($arrayXLS);
		$executeQuery = $connectToBD->query($arrayXLS);
		$closeConnection = $connectToBD->disconnectMySQL($openConnection);
		echo 'conexion terminada';
		//print_r($arrayCSV[0][0]);
		//print_r($arrayXLS[0]);
	}
}
?>