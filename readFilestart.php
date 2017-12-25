<?php
include_once('leer_excel.php');
include_once('MySQLConnection.php');
$csvFile = 'nombres.csv';
$xlsFile = 'excel.xls';
$ShortUrl = new ShortUrl();
//$arrayCSV = $ShortUrl->readCSV($csvFile);
$arrayXLS = $ShortUrl->readXLS($xlsFile);
$connectToBD = new MySQLConnection();
$openConnection = $connectToBD->connectToMySQL('db480544677.db.1and1.com','dbo480544677','lokomotiv1973','db480544677');
// foreach ($arrayXLS as $name) {
// 	echo $name. "</br>";
// }
$executeQuery = $connectToBD->query($arrayXLS);
$closeConnection = $connectToBD->disconnectMySQL($openConnection);
echo 'conexion terminada';
//print_r($arrayCSV[0][0]);
//print_r($arrayXLS[0]);
?>