<?php
include_once ("Clases/bd.php");

$conn= new bd();
$conn->local();
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
        <input name="user" class="user" type="text" placeholder="Nombre Usuario" required>
        <input name="correo" class="correo" type="email" placeholder="Correo" required>
        <input name="passwd" class="passwd" type="password" placeholder="Contrasenya" required>
        <input  class="ini" type="submit" value="Iniciar Sesion">
    </form>
    <div class="link">
        <a  href="PagRegistrar.php">Registrar aqui</a>
    </div>
</div>
<?php

$usrValido="";
$correoValido="";
$contraValida="";

if(isset($_POST["user"])){

    if(isset($_POST["user"])){
        //Me devuelve la longitud del string dado strlen
        if(strlen($_POST["user"])<45){
            $usrValido=$_POST["user"];
        }else{
            echo "
                 <script>
                     window.alert('El nombre de usuario no debe pasar de 45 caracteres');
                 </script>
                ";
        }
    }
}

if(isset($_POST["correo"])){

    if(isset($_POST["correo"])){
        //Me devuelve la longitud del string dado strlen
        if(strlen($_POST["correo"])<150){
            $correoValido=$_POST["correo"];
        }else{
            echo "
                 <script>
                     window.alert('El correo no puede pasar de 150 caracteres');
                 </script>
                ";
        }
    }
}

if(isset($_POST["passwd"])){

    if(isset($_POST["passwd"])){
        if( strlen($_POST["passwd"]) < 100 ){
            $contraValida=$_POST["passwd"];
        }else{
            echo "
               <script>
                     window.alert('La contraseña no coincide y/o no puede pasar de 100 caracteres');
                </script>
                ";
        }
    }
}

if(isset($_POST["user"]) && isset($_POST["correo"]) && isset($_POST["passwd"])){
    if(isset($usrValido) && isset($correoValido) && isset($contraValida)){
        if($conn->userExists($usrValido,$correoValido,$contraValida)){
            //Me redirige a la pagina de las peliculas, donde debere comprobar si esta logeado, si es así
            //En clase funciono y ahora peta
            //header("Location: PagMain.php");
        }else{
            echo "
                 <script>
                     window.alert('Alguno de los datos introducidos no es correcto');
                 </script>
                ";
        }
    }
}


?>
</body>
</html>
