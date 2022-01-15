<?php
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
    <meta charset="UTF-8">
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
<body>
<nav>
    <h3><a href="../Controladores/Main_controlador.php">NAVEGATOR</a></h3>
    <!--<ul>
        <li><a href="../>Inicias Sesion</a></li>
    </ul>-->
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
    <div class="contenedorCentral">
        <img class="imgHotel" src="../<?php
        foreach( $hotel[0]->getIMG() as $img ) {
            echo $img["IMG"];
        } ?>">
        <p class="precioHotel"><?php
            echo $hotel[0]->getPrecio(); ?>€</p>
    </div>
    <p class="descripcionHotel"><?php
        echo $hotel[0]->getDescripcion(); ?></p>

</div>

</body>
</html>