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
</head>
<body>
<nav >
    <h1><a href="../Controladores/Main_controlador.php">NAVEGATOR</a></h1>
    <form>

    </form>
    <!--<ul>
        <li></li>
    </ul>-->
</nav>

<div class="contenedorHoteles"><?php
    foreach($hoteles as $hotel){ ?>
    <a href="../Controladores/Hotel_controlador.php?HotelID=<?php echo $hotel->getHotelID(); ?>">
        <div class="contenedorHotel">
            <!--PROBAR DE GUARDAR SOLO LA IMG SIN RUTA EN LA BD, haber si no peta-->
            <img class="imgHotel" src="../<?php echo $hotel->getIMG(); ?>">
            <p class="calificacionHotel"><?php echo $hotel->getCalificacion(); ?>/10</p>
            <p class="percioHotel">Desde <span ><?php echo $hotel->getPrecio(); ?>€</span> por noche</p>
            <p class="ubicacionHotel"><?php echo $hotel->getUbicacion(); ?></p>
            <h2 class="nomHotel"><?php echo $hotel->getNombre(); ?></h2>

        </div>
        </a><?php
    }?>
</div>

</body>
</html>