<?php
include_once("Persona.php");
include_once("Pelicula.php");
include_once("Genero.php");
include_once("BD.php");

//Coger los datos para poder trabajar el Obj
global $ObjPelicula;

$pelicula=0;
$PeliculaID=0;

if (isset($_GET["PeliculaID"])){
    $PeliculaID=$_GET["PeliculaID"];
}
$pelicula=$ObjPelicula[$PeliculaID];
/*echo "<br>";
echo "<pre>";
var_dump($pelicula);
echo"<br>";*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosPeli.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div >
    <span class="icon"><i class="fa fa-search"></i></span>
    <input type="search" id="buscar" placeholder="Search..." />
</div>

    <div class="contenedorPl">
        <h4><?php echo $pelicula->getNombre();?></h4>
        <p>Fecha de salida(españa):<?php echo $pelicula->getFechaSalida();?></p>
        <p><?php echo $pelicula->getDuracion();?> min</p>
        <img src="<?php echo $pelicula->getIMG();?>">
        <p><?php for($i=0;$i<count($pelicula->getGeneros());$i++){
            echo $pelicula->getGeneros()[$i]." | "; //Mirar como puedo quitar el ultimo
            }?></p>
        <p>
            <?php echo $pelicula->getSinopsis() ;?>
        </p>
        <p>Director: <?php /*foreach ($pelicula->getDirectores() as $directores){
                echo $directores;
            }*/?> </p>
        <p>Actores: </p>
        <div class="trailer">
            <iframe src="<?php echo $pelicula->getTrailer(); ?>?autoplay=1&mute=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

</body>
</html>
