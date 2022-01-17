<?php
session_start();
$user = $_SESSION["user"];
$inicio = $_SESSION["Ini"];


/** COMBINACION DE COLORES
 * https://color.adobe.com/es/create/color-wheel
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NAVEGATOR</title>
    <link type="text/css" rel="stylesheet" href="../A_Estilos/estilosMain.css">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
    <!-- LINK BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body id="body">

<nav id="nav" class="navbar navbar-expand-lg ">

    <h3 id="h3"><a href="../Controladores/Main_controlador.php">NAVEGATOR</a></h3>

    <ul class="nav nav-tabs mr-2">
        <?php
        if( $inicio==true ) { ?>
            <li id="dropLI" class="nav-item dropdown ">
                <a id="dropA" class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown"
                   aria-expanded="false">
                    <?php
                    echo $user ?>
                </a>
                <div id="dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a id="divDropA" class="dropdown-item" href="?cerrarSesion=true">Cerrar Sesion</a>
                </div>
            </li>
            <?php
        } else { ?>
            <li id="LI" class="nav-item"><a id="A" class="nav-link active" href="../Controladores/IniSesion_controlador.php">Inicio
                    Sesion</a></li>
            <?php
        } ?>
    </ul>
</nav>

<div id="contenedorHoteles" class=" row justify-content-center"><?php
    foreach( $hoteles as $hotel ) { ?>
        <div class="contenedorHotel">
        <a href="../Controladores/Hotel_controlador.php?HotelID=<?php echo $hotel->getHotelID(); ?>">
            <img class="imgHotel" src="../<?php
            foreach( $hotel->getIMG()[0] as $img ) {
                echo $img;
            } ?>">
            <?php
            $calificacion = $hotel->getCalificacion();
            if( $calificacion > 7 && $calificacion <= 10 ) {
                ?><p class="calificacionHotel" style="background-color:green"><?php
                echo $calificacion ?>/10</p><?php
            } else if( $calificacion >= 5 && $calificacion <= 7 ) {
                ?><p class="calificacionHotel" style="background-color:#d0be00"><?php
                echo $calificacion ?>/10</p><?php
            } else {
                ?><p class="calificacionHotel" style="background-color:red"><?php
                echo $calificacion ?>/10</p><?php
            }
            ?>
            <p class="percioHotel">Desde <span><?php
                    echo $hotel->getPrecio(); ?>€</span> por noche</p>
            <p class="ubicacionHotel"><?php
                echo $hotel->getUbicacion(); ?></p>
            <p class="estrellasHotel"> <?php
                $estrellas = $hotel->getEstrellas();
                if( $estrellas==1 ) {
                    echo "⭐";
                } else if( $estrellas==2 ) {
                    echo "⭐⭐";
                } else if( $estrellas==3 ) {
                    echo "⭐⭐⭐";
                } else if( $estrellas==4 ) {
                    echo "⭐⭐⭐⭐";
                } else {
                    echo "⭐⭐⭐⭐⭐";
                } ?></p>
            <h4 class="nomHotel"><?php
                echo $hotel->getNombre(); ?></h4>

        </a>
        </div><?php
    } ?>
</div>

<!-- SCRIPTS BOOTSTRAP-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
</body>
</html>