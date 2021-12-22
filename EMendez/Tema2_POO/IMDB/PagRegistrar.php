<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosReg.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<!--Al terminar de iniciar session / registrarse lo mande a la pagina de inicio-->
<!--Si es demasiado ambicioso eso podria mostrar un mensaje de registro/inicio session satisfactorio
    y que el clicara en el nav para irse al inicio.
-->
<nav>
    <!--Meter el link a la pag principal-->
</nav>
<div class="contenedorRegistrar">
<h2>Registro</h2>
    <form action="PagRegistrar.php" method="post">
        <input pattern="" class="nombre" type="text" placeholder="Nombre completo">
        <input pattern="[0-9]{4}\-[0-9]{2}\-[0-9]{2}$" class="fecha" type="text" placeholder="anyo-mes-dia">
        <input class="descripcion" type="text" placeholder="descripcion">
        <input pattern="[A-Za-z]+\@[a-z]\.[a-z]" class="correo" type="email" placeholder="Correo" required>
        <input pattern="" class="contra" type="password" placeholder="Contrasenya" required>
        <input class="contra" type="password" placeholder=" Repite Contrasenya" required>
        <input class="reg" type="submit" value="Registrarse">
    </form>
</div>
<?php



?>
</body>
</html>
