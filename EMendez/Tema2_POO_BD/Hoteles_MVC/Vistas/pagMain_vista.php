<?php
//include_once("BD/bd.php");
/*
echo "<br>";
echo "<pre>";
var_dump($hoteles);
echo "<br>";
*/
/** COMINACION DE COLORES
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
<body>
<nav>
    <h3><a href="../Controladores/Main_controlador.php">NAVEGATOR</a></h3>
    <form>

    </form>
    <!--<ul>
        <li></li>
    </ul>-->
</nav>

<div id="contenedorHoteles" class=" row justify-content-center"><?php
    foreach( $hoteles as $hotel ) { ?>
        <div class="contenedorHotel">
        <a href="../Controladores/Hotel_controlador.php?HotelID=<?php
        echo $hotel->getHotelID(); ?>">
            <img class="imgHotel" src="../<?php
            foreach( $hotel->getIMG() as $img ) {
                echo $img["IMG"];
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

</body>
</html>