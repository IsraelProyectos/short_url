<?php
ini_set('error_reporting', E_ALL-E_NOTICE);
ini_set('display_errors', 1);
include_once('extractDocumentToArray.php');
include_once('MySQLConnection.php');
class readFileStart
{
	function startRead($file, $extensionFile){
		$csvFile = $file;
		$xlsFile = $file;
		$ShortUrl = new ShortUrl();
		
		$connectToBD = new MySQLConnection();
		$openConnection = $connectToBD->connectToMySQL('localhost', 'emailings', 'DksQcaPP1waV', 'emailings');
		// if ($extensionFile == "csv") {
		// 	$arrayCSV = $ShortUrl->readCSV($csvFile);
		// 	$executeQuery = $connectToBD->query($arrayCSV);
		// 	// foreach ($arrayCSV as $fileCSV) {
		// 	// 	echo $fileCSV."</br>";
		// 	// }
		// }
		// elseif ($extensionFile == "xlsx") {
		// 	$arrayXLS = $ShortUrl->readXLS($xlsFile);
		// 	$executeQuery = $connectToBD->query($arrayXLS);
		// }
		switch ($extensionFile) {
			case 'csv':
				$arrayCSV = $ShortUrl->readCSV($csvFile);
				$executeQuery = $connectToBD->query($arrayCSV);
				break;
		    case 'xlsx':
		    	$arrayXLS = $ShortUrl->readXLS($xlsFile);
				$executeQuery = $connectToBD->query($arrayXLS);
		    	break;
			
			default:
				echo 'El formato del archivo no es correcto.';
				break;
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