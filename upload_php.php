<?php
   ini_set('error_reporting', E_ALL-E_NOTICE);
   ini_set('display_errors', 1);
   include_once("readFilestart.php");
   $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
   if ($archivo) {
      $ruta_destino_archivo = "archivos/{$archivo['name']}";
      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
      echo 'archivo subido correctamente'. "</br>";
      
      $readFilestart = new readFileStart();
	  $arrayXLS = $readFilestart->startRead($ruta_destino_archivo);
   }else{

   	  echo 'el archivo no se ha podido subir';
   }
?>
