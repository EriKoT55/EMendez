<?php
include_once("Persona.php");
include_once("Pelicula.php");
include_once("Genero.php");
include_once("BD.php");

global $ObjPersona;

if (isset($_GET["PersonaID"])){
    $PersonaID=$_GET["PersonaID"];
}
$persona=$ObjPersona[$PersonaID];

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
<div >
    <span class="icon"><i class="fa fa-search"></i></span>
    <input type="search" id="buscar" placeholder="Search..." />
</div>
<!--Cambiar cada propiedad de pelicula por la de persona-->
<div class="contenedorPrs">
    <h4><?php echo $persona->getNombreCompleto();?></h4>
    <p>Fecha de nacimiento: <?php echo $persona->getFechaNacimiento();?></p>
    <p><?php echo $persona->getTrabajo();?></p>
    <img src="<?php echo $persona->getIMG();?>">
        <p>Peliculas en las cuales trabajo: <?php $textA=""; foreach ($persona->getPeliculas() as $pelicula){
                $textA.=$pelicula.", ";
            }
            //Elimina los dos ultimos caracteres, en ese caso la coma que sobra y el espacio de despues
            $peliculas= substr($textA,0, -2);
            echo $peliculas;
            ?>
        </p>
    <p>
        <?php echo $persona->getDescripcion(); ?>
    </p>

</div>
</body>
</html>
