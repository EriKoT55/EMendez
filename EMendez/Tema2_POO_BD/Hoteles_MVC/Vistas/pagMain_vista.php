<?php
//include_once("BD/bd.php");
//var_dump($hoteles->getHotelID());
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NAVEGATOR</title>
    <link type="text/css" rel="stylesheet" href="../A_Estilos/estilosMain.css">
</head>
<body>
<nav>
    <ul>
        <!--<li></li>-->
    </ul>
</nav>

<div class="contenedorHoteles"><?php
    foreach($hoteles as $hotel){ ?>
        <a href="../Controladores/Hotel_controlador.php?HotelID=<?php echo $hotel->getHotelID(); ?>">
            <div class="contenedorHotel">
<!--PROBAR DE GUARDAR SOLO LA IMG SIN RUTA EN LA BD, haber si no peta-->
            <img class="imgHotel" src="../<?php echo $hotel->getIMG(); ?>">
            <h2 class="nomHotel"><?php echo $hotel->getNombre(); ?></h2>
            <p>Desde <span class="percioHotel"><?php echo $hotel->getPrecio(); ?>€</span> por noche</p>
            <p class="calificacionHotel"><?php echo $hotel->getCalificacion(); ?>/10</p>
        </div>
        </a><?php
    }?>
</div>

</body>
</html>
