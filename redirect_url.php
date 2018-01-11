<?php
	include_once('MySQLConnection.php');
	$url = $_POST["url"];
	$connectToBD = new MySQLConnection();
	$openConnection = $connectToBD->connectToMySQL('localhost', 'emailings', 'DksQcaPP1waV', 'emailings');

	$get_large_url = "select large_url from short_url where short_url = '".$url."'";
	$executeQuery = $connectToBD->executeQuery($get_large_url);
	$arr = array();
	while($obj = mysqli_fetch_array($executeQuery)) {
	  $arr = $obj;
	}
	header("Location: ".$arr[0]);

	$closeConnection = $connectToBD->disconnectMySQL($openConnection);
?>