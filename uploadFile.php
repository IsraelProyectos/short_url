<!DOCTYPE html>

<head>

    <meta charset="utf-8">

    <title>Subir excel</title>

</head>

<body>

    <?php
    $carpetaDestino="archivos/";
    

    if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0])

    {



        # recorremos todos los arhivos que se han subido

        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)

        {


            // if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")

            // {


                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))

                {

                    $origen=$_FILES["archivo"]["tmp_name"][$i];

                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];


                    if(@move_uploaded_file($origen, $destino))

                    {

                        echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
                        include_once("readCSVstart.php");

                    }else{

                        echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];

                    }

                }else{

                    echo "<br>No se ha podido crear la carpeta: ".$carpetaDestino;

                }

            // }else{

            //     echo "<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg, png o gif";

            // }

        }

    }else{

        echo "<br>No se ha subido ningun archivo";

    }

    ?>

    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data" name="inscripcion">

        <input type="file" name="archivo[]" multiple="multiple">
		</br>
		</br>
        <input type="submit" value="Enviar"  class="trig">

    </form>

</body>

</html>