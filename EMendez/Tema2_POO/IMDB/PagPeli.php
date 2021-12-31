<?php

include_once("Clases/bd.php");

$conn= new bd();
$conn->local();
session_start();

if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
}


if (isset($_GET["PeliculaID"])) {
    $PeliculaID = $_GET["PeliculaID"];
}
$pelicula = $conn->cogerPelicula($PeliculaID);

$_SESSION["peliID"]=$PeliculaID;

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
    <form class="contenedorSearch" action="PagMain.php" method="get">
        <button type="submit" class="icon"><i class="fa fa-search"></i></button>
        <input type="search" id="buscar" placeholder="Buscar..."/>
    </form>

    <?php
    //Buscador

        if(isset($_GET)){

        }

    ?>
    <div class="contenedorUL">
        <ul>
            <li><a class="menu" href="PagMain.php">Pagina Principal</a></li>
            <?php

                if($_SESSION["Ini"]==true) { //Peta y supuestamente las variables de session pueden utilizarse en
                // cualquier archivo dentro del servidor, pero me dice que no esta inicializada
                ?>

                <li id="nomUsr">
                    <a>
                        <?php
                            $NomUsuario=$_SESSION["user"];
                            echo $NomUsuario
                        ?>
                    </a>
                </li>

                <a href="?cerrarSesion=true"><li id="cerrarSesion">Cerrar Session</li></a>

            <?php }else{ ?>
                <li><a class="menu" href="PagInicioSession.php">Iniciar Session</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
<div class="contenedorPl">
    <h4><?php echo $pelicula[0]->getNombre(); ?></h4>
    <p>Fecha de salida(españa): <?php echo $pelicula[0]->getFechaSalida(); ?></p>
    <p><?php echo $pelicula[0]->getDuracion(); ?> min</p>
    <?php foreach ($pelicula[0]->getIMG() as $img){?>
    <img src="<?php echo $img["img"]?> ">
    <?php } ?>
    <div class="trailer">
        <iframe width="560" height="315" src="<?php echo $pelicula[0]->getTrailer(); ?>" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
    <p>| <?php foreach ($pelicula[0]->getGeneros() as $genero){
            echo $genero["genderName"] . " | ";
            //seguir probando en purebasClass las profundidades de los arrays
        } ?></p>

    <p>Director:
        <?php
        $textD = "";
        foreach ($pelicula[0]->getDirectores() as $director) {
            $textD .= $director["personName"] . ", ";
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
    <p>Actores: <?php $textA = "";
        foreach ($pelicula[0]->getActores() as $actor) {
            $textA .= $actor["personName"] . ", ";
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

    <p>
        <?php echo $pelicula[0]->getSinopsis(); ?>
    </p>


</div>

<div class="contenedorComent">

    <form action="PagComent.php" id="comment" method="post">
        <textarea name="comment" rows="10" cols="150" maxlength="555" placeholder="Comente lo que piense de la pelicula" ></textarea>
        <input type="submit" name="boton" value="Comentar" >
    </form>

    <h2>Comentarios</h2>

    <div class="contenedorComentarios"><?php

            $UsuarioID=$_SESSION["usrID"];

            $sql="SELECT c.Comentario,c.Fecha,u.NomUsuario FROM Comentarios c 
                JOIN Usuarios u on u.UsuarioID=".$UsuarioID."
                JOIN Peliculas p on p.PeliculaID=".$PeliculaID.";";

            $conn->default();
            $result= $conn->query($sql);
            $conn->close();

            //Muestro los comentarios:
            // quien lo escribio, la fecha y el comentario
            while($coment=$result->fetch_object()){?>
                <h3><?php echo $coment->NomUsuario ?></h3>
                <h5><?php echo $coment->Fecha ?></h5>
                <p><?php echo $coment->Comentario ?></p><?php
            }
                ?>
    </div>

</div>

</body>
</html>
