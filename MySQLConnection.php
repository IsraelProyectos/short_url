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

	function query($document){
		$tiempo_inicio=microtime(true);
		//Mirar mayusculas, ninusculas en MySQL
		$lastRegister = "select MAX(Id) as id_maximo from short_url";
		$print_last_register = $this->executeQuery($lastRegister);
		$row = mysqli_fetch_array($print_last_register);
		$max_id = $row[0];
		
		if (count($document) == 0) {
			echo "El archivo de direcciones ya ha sido subido </br>";
		}
		else{
			foreach ($document as $documentFile) {
				// for ($i=0; $i < count($documentFile); $i++) { 
				// 	$file = $documentFile[0];
				// }
				//$documentFile = strtoupper($documentFile);
					$max_id = $max_id + 1;
					$query = "insert into short_url(Large_url, Short_url) values('".$documentFile."', 'www.volskwagen' '".$max_id."' '.es' )";
					//echo $documentFile. '</br>';
					$insert = $this->executeQuery($query);
			}
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