<?php
session_start();
$user = $_SESSION["user"];
$inicio = $_SESSION["Ini"];
/*
echo "<br>";
echo "<pre>";
var_dump($hotel[0]->getIMG()[0]);
echo "<br>";
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>NAVEGATOR</title>
    <link type="text/css" rel="stylesheet" href="../A_Estilos/estilosHotel.css">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
    <!--PONER EL LINK DE BOOSTRAP PARA HACER RESPONSIVE LA PAGINA-->
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
            <li id="LI" class="nav-item"><a id="A" class="nav-link active"
                                            href="../Controladores/IniSesion_controlador.php">Inicio
                    Sesion</a></li>
            <?php
        } ?>
    </ul>

</nav>

<div class="contenedorInfoHotel">
    <div class="contenedorSuperior">
        <?php
        $calificacion = $hotel[0]->getCalificacion();
        if( $calificacion > 7 && $calificacion <= 10 ) {
            ?><p class="calificacionHotel" style="background-color:green"><?php
            echo $calificacion ?>/10</p><?php
        } else if( $calificacion >= 5 && $calificacion <= 7 ) {
            ?><p class="calificacionHotel" style="background-color:yellow"><?php
            echo $calificacion ?>/10</p><?php
        } else {
            ?><p class="calificacionHotel" style="background-color:red"><?php
            echo $calificacion ?>/10</p><?php
        }
        ?>
        <h1 class="nomHotel"><?php
            echo $hotel[0]->getNombre(); ?></h1>
        <p class="estrellasHotel"> <?php
            $estrellas = $hotel[0]->getEstrellas();
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
        <p class="ubicacionHotel"><?php
            echo $hotel[0]->getUbicacion() ?></p>
        <p class="direccionHotel"><?php
            echo $hotel[0]->getDireccion() ?></p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner"><?php
                        for( $i = 0; $i < count( $hotel[0]->getIMG() ); $i++ ) {
                            ?>
                            <div class="carousel-item active">
                            <img class="d-block w-50" width="850px" height="700px" src="../<?php
                            foreach( $hotel[0]->getIMG() as $img ) {
                                echo $img["IMG"];
                            } ?>">
                            </div><?php
                        } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls"
                            data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls"
                            data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <p class="precioHotel"><?php
        echo $hotel[0]->getPrecio(); ?>€</p>
    <p class="descripcionHotel"><?php
        echo $hotel[0]->getDescripcion(); ?></p>

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