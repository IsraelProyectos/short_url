<?php
include_once('leer_excel.php');
$csvFile = 'nombres.csv';
$xlsFile = 'excel.xls';
$ShortUrl = new ShortUrl();
//$arrayCSV = $ShortUrl->readCSV($csvFile);
$arrayXLS = $ShortUrl->readXLS($xlsFile);
//print_r($arrayCSV[0][0]);
//print_r($arrayXLS[0]);
foreach ($arrayXLS as $name) {
	echo $name. "</br>";
}
?>