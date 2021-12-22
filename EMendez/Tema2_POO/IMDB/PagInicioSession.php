<?php
include_once ("Clases/bd.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosIni.css">
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
    <div class="contenedorUL">
        <ul>
            <li><a href="PagMain.php">Pagina Principal</a></li>

        </ul>
    </div>
</nav>
<div class="contenedorInicioSession">
<h2>Iniciar Sesion</h2>
    <form action="PagInicioSession.php" method="post">
        <input class="user" type="text" placeholder="Nombre Usuario" required>
        <input class="correo" type="email" placeholder="Correo" required>
        <input class="contra" type="password" placeholder="Contrasenya" required>
        <input  class="ini" type="submit" value="Iniciar Sesion">
    </form>
    <div class="link">
        <a  href="PagRegistrar.php">Registrar aqui</a>
    </div>
</div>
<?php



?>
</body>
</html>
