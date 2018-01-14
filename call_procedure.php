<?php
// ini_set('error_reporting', E_ALL-E_NOTICE);
// ini_set('display_errors', 1);
$mysqli = new mysqli('db480544677.db.1and1.com','dbo480544677','lokomotiv1973','db480544677');

 
/*Y llamamos al procedimiento para recoger los datos*/
/*Si falla imprimimos el error*/
if (!($sentencia = $mysqli->prepare("CALL prueba()"))) {
    echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$sentencia->execute()) {
    echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
}

do {
    if ($resultado = $sentencia->get_result()) {
        $result = mysqli_fetch_all($resultado);
        mysqli_free_result($resultado);
    } else {
        if ($sentencia->errno) {
            echo "Store failed: (" . $sentencia->errno . ") " . $sentencia->error;
        }
    }
} while ($sentencia->more_results() && $sentencia->next_result());

foreach ($result as $id) {
	foreach ($id as $re) {
        echo $re;
    }
	echo "</br>";
	echo "</br>";
	echo "</br>";
}
/*El bucle se ejecuta mientras haya más
 
/*E imprimimos el resultado para ver que el ejemplo ha funcionado*/
// $test = $res->fetch_assoc();
// foreach ($test as $register) {
// 	echo $register."</br>";
// }
//var_dump($res->fetch_assoc());

?>