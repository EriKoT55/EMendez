<?php
//error_reporting(0);
include_once( "Clases/bd.php" );
session_start();
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
    <link type="text/css" rel="stylesheet" href="Estilos/estilosCalif.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<nav>
    <div class="contenedorUL">
        <ul>
            <li><a href="PagMain.php">Pagina Principal</a></li>
        </ul>
    </div>
</nav>
<div class="contenedorCalificacion">
    <h5>EN OBRAS</h5>
    <h2>Calificar pelicula</h2>
    <form action="PagCalificacion.php" method="post">
        <input name="calificar" class="calificar" type="text" placeholder="Califique" required>
        <input class="cal" type="submit" value="Puntuar">
    </form>
</div>
<?php
if($_POST["calificar"]>=0 && $_POST["calificar"]<=10){
    if(isset($_POST["calificar"])){
        if($conn->insertCalificacion($_POST["calificar"],$_SESSION["peliID"],$_SESSION["usrID"])){?>
            <script>
                window.alert('Calificacion introducida correctamente');
            </script>
<?php }else{ ?>
            <script>
                window.alert('Hubo un error al introducir los valores');
            </script>
<?php   }
    }
}else{?>
    <script>
        window.alert('Debe introducir un valor entre el 0 y el 10');
    </script>
<?php }

?>