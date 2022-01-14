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
<nav >
    <h3><a href="../Controladores/Main_controlador.php">NAVEGATOR</a></h3>
    <form>

    </form>
    <!--<ul>
        <li></li>
    </ul>-->
</nav>
<!--PONER LAS ESTRELLAS, PERO DEJALO PARA LO ULTIMO-->
<div class="contenedorHoteles row justify-content-center"><?php
    foreach($hoteles as $hotel){ ?>
        <div class="contenedorHotel">
            <a href="../Controladores/Hotel_controlador.php?HotelID=<?php echo $hotel->getHotelID(); ?>">
            <img class="imgHotel" src="../<?php foreach ($hotel->getIMG() as $img){
                echo $img["IMG"];
            } ?>">
            <p class="calificacionHotel"><?php echo $hotel->getCalificacion(); ?>/10</p>
            <p class="percioHotel">Desde <span ><?php echo $hotel->getPrecio(); ?>€</span> por noche</p>
            <p class="ubicacionHotel"><?php echo $hotel->getUbicacion(); ?></p>
            <h2 class="nomHotel"><?php echo $hotel->getNombre(); ?></h2>
            </a>
        </div><?php
    }?>
</div>

</body>
</html>