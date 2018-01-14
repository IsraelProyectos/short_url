<?php
   ini_set('error_reporting', E_ALL-E_NOTICE);
   ini_set('display_errors', 1);
   include_once("readFilestart.php");
   $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
   foreach ($archivo as $fileExtension) {
      $extension = explode(".", $fileExtension);
      $extensionFile = end($extension);
      break;
   }

   if ($archivo == true && ($extensionFile == 'csv' || $extensionFile == 'xlsx' )) {
      $ruta_destino_archivo = "archivos/{$archivo['name']}";
      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
      echo 'archivo subido correctamente'. "</br>";
      
      $readFilestart = new readFileStart();
	   $arrayXLS = $readFilestart->startRead($ruta_destino_archivo, $extensionFile);
   }else{
      if ($archivo == false) {
         echo 'No has cargado ningun archivo';
      }
      else{
         echo 'El formato del archivo no es el correcto';
      }
   	  
   }
?>
