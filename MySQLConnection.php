<?php
/**
* Israel
*/
ini_set('error_reporting', E_ALL-E_NOTICE);
ini_set('display_errors', 1);
class MySQLConnection{

	var $host;
    var $username;
    var $password;
    var $database;
    public $connection;

	function connectToMySQL($host, $userName, $password, $database){
		$this->host = $host;
        $this->username = $userName;
        $this->password = $password;
        $this->database = $database;

        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database) or die('Error connecting to DB'); 
        return $this->connection;       
	}

	function disconnectMySQL($connection){
		$connection->close();			
	}

	function query($xlsFile){
		$tiempo_inicio=microtime(true);
		//Mirar mayusculas, ninusculas en MySQL
		$lastRegister = "select MAX(Id) as id_maximo from short_url";
		$print_last_register = $this->executeQuery($lastRegister);
		$row = mysqli_fetch_array($print_last_register);
		$max_id = $row[0];
		//print_r($xlsFile);
		foreach ($xlsFile as $fileXls) {
			//$fileXls = strtoupper($fileXls);


			// $query_exist_register = "select Id from short_url where upper(Large_Url) = upper('".$fileXls."') " ;
			// //echo $query_exist_register;
			// $exist_register = $this->executeQuery($query_exist_register);
			// if ($exist_register->num_rows == 0) {
				$max_id = $max_id + 1;
				$query = "insert into short_url(Large_url, Short_url) values('".$fileXls."', 'www.volskwagen' '".$max_id."' '.es' )";
				//echo $fileXls. '</br>';
				$insert = $this->executeQuery($query);
			// }else{
				
			// 	//echo 'La direccion ' .$fileXls. ' ya existe en la base de datos </br>';	
			// }
		}
		$tiempo_fin=microtime(true);

		echo "La introduccion a la BBDD ha tardado ".($tiempo_fin-$tiempo_inicio)." segundos"."</br>";

	}

	function executeQuery($query){
		//echo $query;
		//echo $connection;
		$query_result = mysqli_query($this->connection, $query) or die('Error al ejecutar la query');
		//echo mysqli_num_rows($query_result);
		return $query_result;
	}
}
?>