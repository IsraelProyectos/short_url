<?php
   $archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
   if ($archivo) {
      $ruta_destino_archivo = "archivos/{$archivo['name']}";
      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
      echo 'archivo subido correctamente';
      include_once("readCSVstart.php");
   }else{

   	  echo 'el archivo no se ha podido subir';
   }
?>
