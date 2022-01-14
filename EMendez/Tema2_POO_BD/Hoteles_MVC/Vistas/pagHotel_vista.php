<?php

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
</head>
<body>
<nav>
    <h1><a href="../Controladores/Main_controlador.php">NAVEGATOR</a></h1>
    <!--<ul>
        <li><a href="../>Inicias Sesion</a></li>
    </ul>-->
</nav>

<div class="contenedorInfoHotel">
    <div class="contenedorSuperior">
    <p class="calificacionHotel"> <?php echo $hotel[0]->getCalificacion(); ?>/10</p>
    <h1 class="nomHotel"><?php echo $hotel[0]->getNombre(); ?></h1>
    <p class="ubicacionHotel"><?php echo $hotel[0]->getUbicacion() ?></p>
    </div>
    <div class="contenedorCentrar">
    <img class="imgHotel" src="../<?php echo $hotel[0]->getIMG(); ?>">
    <p class="precioHotel"><?php echo $hotel[0]->getPrecio(); ?>€</p>
    </div>
    <p class="descripcionHotel"><?php echo $hotel[0]->getDescripcion() ?></p>

</div>

</body>
</html>