<?php
//include_once("BD/bd.php");
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
    //foreach(){ ?>
        <a href="pagHotel.php?HotelID="<?php //echo ?>>
            <div class="contenedorHotel">
<!--PROBAR DE GUARDAR SOLO LA IMG SIN RUTA EN LA BD, haber si no peta-->
            <img class="imgHotel" src="../IMG/exe_madrid_norte.jpg">
            <h2 class="nomHotel"><?php echo "Manoliat" ?></h2>
            <p>Desde <span class="percioHotel"><?php echo 50 ?>€</span> por noche</p>
            <p class="calificacionHotel"><?php echo 7 ?>/10</p>
        </div>
        </a><?php
    //}?>
</div>

</body>
</html>
