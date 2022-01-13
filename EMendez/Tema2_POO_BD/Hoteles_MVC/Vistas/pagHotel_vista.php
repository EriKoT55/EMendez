<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NAVEGATOR</title>
    <link type="text/css" rel="stylesheet" href="../A_Estilos/estilosHotel.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="../Controladores/Main_controlador.php">Pagina Principal</a></li>
    </ul>
</nav>

<div class="contenedorInfoHotel">
    <h1 class="nomHotel"><?php echo $hotel[0]->getNombre(); ?></h1>
    <img class="imgHotel" src="../<?php echo $hotel[0]->getIMG(); ?>">
    <p class="precioHotel"><?php echo $hotel[0]->getPrecio(); ?></p>
    <p class="calificacionHotel"> <?php echo $hotel[0]->getCalificacion(); ?></p>
    <p class="ubicacionHotel"><?php echo $hotel[0]->getUbicacion() ?></p>
    <p class="descripcionHotel"><?php echo $hotel[0]->getDescripcion() ?></p>
</div>

</body>
</html>
