<?php
include_once( "Clases/bd.php" );

$conn = new bd();
$conn->local();
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
<!--Si es demasiado ambicioso, eso podria mostrar un mensaje de registro/inicio session satisfactorio
    y que el clicara en el nav para irse al inicio.
-->
<nav>
    <!--Meter el link a la pag principal-->
    <div class="contenedorUL">
        <ul>
            <li><a href="PagMain.php">Pagina Principal</a></li>
            <li><a href="PagInicioSession.php">Iniciar Sesion</a></li>
        </ul>
    </div>
</nav>
<div class="contenedorRegistrar">
    <h2>Registro</h2>
    <form action="PagRegistrar.php" method="post">
        <!--<input name="nombre"  class="nombre" type="text" placeholder="Nombre completo">-->
        <input name="user" class="user" type="text" placeholder="Nombre Usuario" required>
        <!-- <input name="nacimiento" pattern="[0-9]{4}\-[0-9]{2}\-[0-9]{2}$" class="fecha" type="text" placeholder="anyo-mes-dia">
         <input name="descripcion" class="descripcion" type="text" placeholder="descripcion">
         TAMBIEN QUE PUEDA METER UNA IMG -->
        <input name="correo" pattern="[A-Za-z]+\@[a-z]\.[a-z]" class="correo" placeholder="Correo" required>
        <!--type="email" -->
        <input name="passwd" class="contra" type="password" placeholder="Contrasenya" required>
        <input name="confirm" class="contra" type="password" placeholder="Repite Contrasenya" required>
        <input class="reg" type="submit" value="Registrarse">
    </form>
</div>
<?php
$usrValido = "";
$correoValido = "";
$contraValida = "";


if( isset( $_POST["user"] ) ) {
    //Me devuelve la longitud del string dado strlen
    if( strlen( $_POST["user"] ) < 45 ) {
        $usrValido = $_POST["user"];
    } else {
        echo "
                 <script>
                     window.alert('El nombre de usuario no debe pasar de 45 caracteres');
                 </script>
                 
                 <!-- #IDEA
                    SE PODRIA PONER EL FONDO DIFUMINADO EN VEZ DE NEGRO AL SALIR EL ALERT, QUE SALIERA LA PAGINA
                    COMO SI ESTUVIERA DEBAJO DEL ALERT
                 -->
                ";
    }
}


if( isset( $_POST["correo"] ) ) {
    //Me devuelve la longitud del string dado strlen
    if( strlen( $_POST["correo"] ) < 150 ) {
        $correoValido = $_POST["correo"];
    } else {
        echo "
                 <script>
                     window.alert('El correo no puede pasar de 150 caracteres');
                 </script>
                 
                 <!-- #IDEA
                    SE PODRIA PONER EL FONDO DIFUMINADO EN VEZ DE NEGRO AL SALIR EL ALERT, QUE SALIERA LA PAGINA
                    COMO SI ESTUVIERA DEBAJO DEL ALERT
                  --> 
                ";

    }
}


if( isset( $_POST["passwd"] ) ) {
    if( isset( $_POST["passwd"] ) && isset( $_POST["confirm"] ) ) {
        if( $_POST["passwd"]==$_POST["confirm"] && strlen( $_POST["passwd"] ) < 100 && strlen( $_POST["confirm"] ) < 100 ) {
            //Encripto la contrase??a con password_hash, recomendada su utilizacion (PHP Manual)
            //HASEO LAS DOS CONTRASE??AS PARA QUE ESTE PROTEGIDA
            $contraValida = password_hash( $_POST["passwd"], PASSWORD_DEFAULT );
        } else {
            echo "
               <script>
                     window.alert('La contrase??a no coincide y/o no puede pasar de 100 caracteres');
                </script>
                <!-- #IDEA
                    SE PODRIA PONER EL FONDO DIFUMINADO EN VEZ DE NEGRO AL SALIR EL ALERT, QUE SALIERA LA PAGINA 
                    COMO SI ESTUVIERA DEBAJO DEL ALERT
                -->
                ";
        }
    }
}

if( isset( $_POST["user"] ) && isset( $_POST["correo"] ) && isset( $_POST["passwd"] ) ) {
    if( isset( $usrValido ) && isset( $correoValido ) && isset( $contraValida ) ) {
        if( $conn->insertUsr( $usrValido, $correoValido, $contraValida ) ) {
            /*ERROR*/
            //No se puede modificar la informaci??n del encabezado: los encabezados ya
            //han sido enviados por (salida se inicio en C:\xampp\htdocs\EMendez\EMendez\Tema2_POO_BD\IMDB\PagRegistrar.php:7
            //  in C:\xampp\htdocs\EMendez\EMendez\Tema2_POO_BD\IMDB\PagRegistrar.php on line 108
            //header("Location: PagInicioSession.php");

            /**NO ENTRA EL SCRIPT**/
            echo "
                 <script>
                     window.alert('El usuario ha sido registrado');
                 </script>
                 <!-- #IDEA
                    SE PODRIA PONER EL FONDO DIFUMINADO EN VEZ DE NEGRO AL SALIR EL ALERT, QUE SALIERA LA PAGINA 
                    COMO SI ESTUVIERA DEBAJO DEL ALERT
                -->
                ";
        } else {
            echo "
                 <script>
                     window.alert('El usuario ya fue registrado');
                 </script>
                 <!-- #IDEA
                    SE PODRIA PONER EL FONDO DIFUMINADO EN VEZ DE NEGRO AL SALIR EL ALERT, QUE SALIERA LA PAGINA 
                    COMO SI ESTUVIERA DEBAJO DEL ALERT
                -->
                ";
        }
    }
}

?>
</body>
</html>
