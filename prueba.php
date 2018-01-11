<?php
ini_set('error_reporting', E_ALL-E_NOTICE);
ini_set('display_errors', 1);
$array = array('isra','carlos','jesus');

//print_r($array)."</br>";

array_diff($array, ["carlos"]);
$my_array = array_values($array); // 'reindex' array


print_r($my_array);
echo($my_array[1]);
// $lista_simple = array_values(array_unique($array));

// print_r($lista_simple);

?>