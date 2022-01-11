<?php
include_once("Clases/bd.php");

$conn= new bd();
$conn->local();
session_start();

$PersonaID=$_GET["PersonaID"];

if (isset($PersonaID)){
    //FUNCION SIN CREAR
    $persona=$conn->cogerPersona();
}4

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="estilosPers.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
</head>
<body>


<div class="contenedorPrs">
    <h4><?php echo $persona->getNombreCompleto();?></h4>
    <p>Fecha de nacimiento: <?php echo $persona->getFechaNacimiento();?></p>
    <p><?php echo $persona->getTrabajo();?></p>
    <img src="<?php echo $persona->getIMG();?>">
        <p>Peliculas en las cuales trabajo: <?php $textA=""; foreach ($persona->getPeliculas() as $pers){
                $textA.=$pers.", ";
            }
            //Elimina los dos ultimos caracteres, en ese caso la coma que sobra y el espacio de despues
            $personas= substr($textA,0, -2);
            echo $personas;
            ?>
        </p>
    <p>
        <?php echo $persona->getDescripcion(); ?>
    </p>

</div>
</body>
</html>
