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
    <p class="calificacionHotel"> <?php echo $hotel[0]->getCalificacion(); ?>/10</p>
    <h1 class="nomHotel"><?php echo $hotel[0]->getNombre(); ?></h1>
    <p class="ubicacionHotel"><?php echo $hotel[0]->getUbicacion() ?></p>
    </div>
    <div class="contenedorCentrar">
    <img class="imgHotel" src="../<?php foreach ($hotel[0]->getIMG() as $img){
        echo $img["IMG"];
    } ?>">
    <p class="precioHotel"><?php echo $hotel[0]->getPrecio(); ?>€</p>
    </div>
    <p class="descripcionHotel"><?php echo $hotel[0]->getDescripcion(); ?></p>

</div>

</body>
</html>