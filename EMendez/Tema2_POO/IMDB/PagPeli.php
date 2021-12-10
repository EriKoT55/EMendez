<?php
include_once("Persona.php");
include_once("Pelicula.php");
include_once("Genero.php");
include_once("BD.php");

//Coger los datos para poder trabajar el Obj
global $ObjPelicula;
global $ObjPersona;

if (isset($_GET["PeliculaID"])) {
    $PeliculaID = $_GET["PeliculaID"] - 1;
}
$pelicula = $ObjPelicula[$PeliculaID];

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
<div>
    <span class="icon"><i class="fa fa-search"></i></span>
    <input type="search" id="buscar" placeholder="Search..."/>
</div>

<div class="contenedorPl">
    <h4><?php echo $pelicula->getNombre(); ?></h4>
    <p>Fecha de salida(españa): <?php echo $pelicula->getFechaSalida(); ?></p>
    <p><?php echo $pelicula->getDuracion(); ?> min</p>
    <img src="<?php echo $pelicula->getIMG(); ?>">
    <div class="trailer">
        <iframe width="560" height="315" src="<?php echo $pelicula->getTrailer(); ?>?autoplay=1&mute=0" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
    <p>| <?php for ($i = 0; $i < count($pelicula->getGeneros()); $i++) {
            echo $pelicula->getGeneros()[$i] . " | ";
        } ?></p>
    <a href="PagPers.php?PersonaID=<?php
        /*for($i=0;$i<count($ObjPersona);$i++){
            $persona[]=$ObjPersona[$i];
        } Debo mejorar el rendimiento de la aplicacion y reestructurar BD.php para una buena escalabilidad
        echo $persona->getPersonaID();*/
    ?>">
        <p>Director:
            <?php
            $textD = "";
            foreach ($pelicula->getDirectores() as $director) {
                $textD .= $director . ", ";
            }
            //Elimina los dos ultimos caracteres, en ese caso la coma que sobra y el espacio de despues
            $directores = substr($textD, 0, -2);
            echo $directores;
            ?>
        </p>
        <p>Actores: <?php $textA = "";
            foreach ($pelicula->getActores() as $actor) {
                $textA .= $actor . ", ";
            }
            //Elimina los dos ultimos caracteres, en ese caso la coma que sobra y el espacio de despues
            $actores = substr($textA, 0, -2);
            echo $actores;
            ?>
        </p>
    </a>
    <p>
        <?php echo $pelicula->getSinopsis(); ?>
    </p>


</div>

</body>
</html>
