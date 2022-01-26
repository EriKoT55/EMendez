<?php

include_once("Clases/bd.php");

$conn= new bd();
$conn->local();
session_start();

$PeliculaID = $_GET["PeliculaID"];
if (isset($PeliculaID)) {
    $pelicula = $conn->cogerPelicula($PeliculaID);
}

if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
    header("Location:PagMain.php");
    //No funciona ni con $PeliculaID, PREGUNTAR
    //header("Location:PagPeli.php?PeliculaID=".$pelicula[0]->getPeliculaID());
}


$_SESSION["peliID"]=$pelicula[0]->getPeliculaID();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosPeli.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<nav class="contenedorMenu">
        <ul class="contenedorUL">
            <li><a class="menu" href="PagMain.php">Pagina Principal</a></li>
            <div class="contenedorUsrCerrIni"><?php
                if($_SESSION["Ini"]==true) {
                ?>
                <li id="nomUsr"><a> <?php echo  $_SESSION["user"];?> </a></li>

                <a href="?cerrarSesion=true"><li id="cerrarSesion">Cerrar Session</li></a><?php
                }else{ ?>
                <li><a class="menu" href="PagInicioSession.php">Iniciar Session</a></li>
            <?php } ?></div>
        </ul>
</nav>
<div class="contenedorPl">
    <h1><?php echo $pelicula[0]->getNombre(); ?></h1>
    <div class="contenedorSuperior">
        <div class="contenedorFechDur">
            <p>Fecha de salida(españa): <?php echo $pelicula[0]->getFechaSalida(); ?></p>
            <p class="bold">|</p>
            <p><?php echo $pelicula[0]->getDuracion(); ?> min</p>
        </div>
        <div class="contenedorCal">
            <a href="PagCalificacion.php"><p>⭐<span><?php echo $pelicula[0]->getCalificacion(); ?></span>/10</p></a>
        </div>
    </div>
    <div class="contenedorMultimedia">
        <div class="contenedorIMGS"><?php
            foreach ($pelicula[0]->getIMG() as $img){ ?>
                <img src="<?php echo $img["IMG"]?> ">
        </div><?php
            } ?>
        <div class="contenedorTrailer">
            <iframe width="560" height="315" src="<?php echo $pelicula[0]->getTrailer(); ?>" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
    <div class="contenedorGeneros"><?php
        foreach ($pelicula[0]->getGeneros() as $genero){ ?>
            <p><?php echo $genero["Generos"]; ?></p><?php
        } ?>
    </div>

    <p>Director:
        <?php
        $textD = "";
        foreach ($pelicula[0]->getDirectores() as $director) {
            $textD .= $director["Directores"] . ", ";
        }
        //Elimina los dos ultimos caracteres, en ese caso la coma que sobra y el espacio de despues
        $directores = substr($textD, 0, -2); ?>
        <a href="PagPers.php<?php
        /*for($i=0;$i<count($ObjPersona);$i++){
            if($ObjPersona[$i]["Trabajo"]=="Director"){
                $persona[]=$ObjPersona[$i];
            }
        } Debo mejorar el rendimiento de la aplicacion y reestructurar BD.php para una buena escalabilidad
        echo $persona->getPersonaID();*/
        ?>"><?php echo $directores; ?></a>

    </p>
    <hr size=1 >
    <p>Actores: <?php $textA = "";
        foreach ($pelicula[0]->getActores() as $actor) {
            $textA .= $actor["Actores"] . ", ";
        }
        //Elimina los dos ultimos caracteres, en ese caso la coma que sobra y el espacio de despues
        $actores = substr($textA, 0, -2); ?>
        <a href="PagPers.php<?php
        /*for($i=0;$i<count($ObjPersona);$i++){
            if($ObjPersona[$i]["Trabajo"]=="Actor"){
                $persona[]=$ObjPersona[$i];
            }
        } Debo mejorar el rendimiento de la aplicacion y reestructurar BD.php para una buena escalabilidad
        echo $persona->getPersonaID();*/
        ?>"><?php echo $actores; ?></a>
    </p>
    <hr size=1 >
    <details>
        <summary>Sinopsis</summary>
        <p><?php echo $pelicula[0]->getSinopsis(); ?></p>
    </details>
  <div class="contenedorComent">

    <form action="PagComent.php" id="comment" method="post">
        <textarea name="comment" rows="8"  maxlength="555" placeholder="Comente lo que piense de la pelicula" ></textarea>
        <input type="submit" name="boton" value="Comentar" >
    </form>

    <div class="contenedorComentarios">
        <h2 class="h2Coment">Comentarios</h2><?php

            $UsuarioID=$_SESSION["usrID"];

            $sql="SELECT c.Comentario,c.Fecha,u.NomUsuario FROM Comentarios c
                JOIN Usuarios u on u.UsuarioID=c.UsuarioID
                JOIN Peliculas p on p.PeliculaID=c.PeliculaID
                WHERE c.PeliculaID=".$_SESSION["peliID"].";";

            $conn->default();
            $result= $conn->query($sql);
            $conn->close();


             // Muestro los comentarios:
             // quien lo escribio, la fecha y el comentario
            while($coment=$result->fetch_object()){ ?>
            <div class="contenedorComentario">
                <p class="p1"><?php echo $coment->NomUsuario ?></p>
                <p class="p2"><?php echo $coment->Fecha ?></p>
                <p class="p3"><?php echo $coment->Comentario ?></p>
            </div>
                <hr><?php
            }?>

    </div>

  </div>
</div>
</body>
</html>
