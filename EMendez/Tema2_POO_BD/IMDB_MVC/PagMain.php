<?php
error_reporting(0);

include_once("Clases/bd.php");
$conn= new bd();
$conn->local();

session_start();

if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
}

/*https://www.imdb.com/title/tt2382320/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=ea4e08e1-c8a3-47b5-ac3a-75026647c16e&pf_rd_r=1VHKKEY8F9SF79HJTAB3&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=moviemeter&ref_=chtmvm_tt_6*/


//Coger los datos para poder trabajar el Obj
$ArrObjPeli = $conn->cogerPeliculas();
$Generos=$conn->Generos();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMDB</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosMain.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<nav class="contenedorMenu">
    <!--Funcion del buscador, mostrara la pelicula  POSIBLE MEJORA, mostrar persona,genero,peli por calificacion...-->
    <div class="contenedorForms">
        <form class="contenedorSearch" action="PagMain.php" method="get">
        <input id="buscar" type="search" name="buscar" placeholder="Buscar..."/>
        <button class="icon" type="submit" ><i class="fa fa-search"></i></button>
        </form><?php
    //Buscador
    $ArrFiltradoPeli = $ArrObjPeli;

    if (isset($_GET["buscar"])) {
        $ArrFiltradoPeli=$conn->busq_pelXnom($_GET["buscar"]);
    }

    ?>
    <form class="formFiltr" action="PagMain.php" method="get">
        <div class="contenedorSelector"><?php $criterioFiltracion = $_GET["criterioFiltracion"] ?>
            <select class="Selector" name="criterioFiltracion">
                <option <?php echo($criterioFiltracion == "" ? "selected" : "") ?> value="unsorted">Normal</option>
                <option <?php echo($criterioFiltracion == "calificacion" ? "selected" : "") ?> value="calificacion">
                    Calificacion
                </option>
                <option <?php echo($criterioFiltracion == "fecha_salida" ? "selected" : "") ?> value="fecha_salida">
                    Fecha de salida
                </option>
                <option <?php echo($criterioFiltracion == "genero" ? "selected" : "") ?> value="genero">Generos</option>
            </select>
        </div>
        <?php

        if (isset($_GET["criterioFiltracion"])) {
            switch ($criterioFiltracion) {
                case "calificacion":
                    $calificacion = $_GET["calificacion"];
                    echo '<div  class="contenedorSelector2">';
                    echo '<select class="Selector" name="calificacion">';
                    if ($calificacion == "mejor") {
                        echo '<option value="mejor" selected>Mejor calificadas</option>';
                    } else {
                        echo '<option value="mejor">Mejor calificadas</option>';
                    }
                    if ($calificacion == "peor") {
                        echo '<option value="peor" selected>Peor calificadas</option>';
                    } else {
                        echo '<option value="peor">Peor calificadas</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    break;
                case "fecha_salida":
                    $fecha_salida = $_GET["fecha_salida"];
                    echo '<div class="contenedorSelector2" >';
                    echo '<select class="Selector" name="fecha_salida">';
                    if ($fecha_salida == "nuevas") {
                        echo '<option value="nuevas" selected>Nuevas</option>';
                    } else {
                        //No acabo de entender del todo porque debo poner en uno selected y en otro no para que me muestre algun valor
                        echo '<option value="nuevas">Nuevas</option>';
                    }
                    if ($fecha_salida == "antiguas") {
                        echo '<option value="antiguas" selected>Antiguas</option>';
                    } else {
                        echo '<option value="antiguas">Antiguas</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    break;
                case "genero";
                    $genero = $_GET["genero"];
                    echo '<div class="contenedorSelector2" >';
                    echo '<select class="Selector" name="genero">';



                      foreach ($Generos as $gen ) {
                          if( $genero==$gen->getNombre() ) {
                              echo '<option value="' . $gen->getNombre() . '"selected>' . $gen->getNombre() . '</option>';
                          } else {
                              echo '<option value="' . $gen->getNombre() . '">' . $gen->getNombre() . '</option>';
                          }
                      }

                    echo '</select>';
                    echo '</div>';
                    break;
            }
        }


        if ($criterioFiltracion == "calificacion") {
            $calificacion = $_GET["calificacion"];
            if ($calificacion == "mejor") {
                $ArrFiltradoPeli = $conn->RankingDESC();
            }
            if ($calificacion == "peor") {
                $ArrFiltradoPeli = $conn->RankingASC();
            }
        }
        if ($criterioFiltracion == "fecha_salida") {
            $fecha_salida = $_GET["fecha_salida"];
            if ($fecha_salida == "nuevas") {
                $ArrFiltradoPeli = $conn->Fecha_SalidaDESC();
            }
            if ($fecha_salida == "antiguas") {
                $ArrFiltradoPeli = $conn->Fecha_SalidaASC();
            }
        }
        if ($criterioFiltracion == "genero") {
            $genero = $_GET["genero"];
            if ($genero != "") {
                $ArrFiltradoPeli = $conn->mostrarPelisGenero($genero);
            }
        }
        ?>
        <button id="submit" type="submit">Filtrar</button>
    </form>
    </div>
        <ul class="contenedorUL">
            <?php if($_SESSION["Ini"]==true) {?>

                <li id="nomUsr"><a><?php echo $_SESSION["user"] ?></a></li>

                <a href="?cerrarSesion=true"><li id="cerrarSesion">Cerrar Session</li></a>

            <?php }else{ ?>
            <li><a class="menu" href="PagInicioSession.php">Iniciar Session</a></li>
            <?php } ?>
        </ul>

</nav>
<div class="contenedor">
    <?php foreach ( $ArrFiltradoPeli as $pelis => $arrPelis){?>
        <div class="contenedorPelis">
            <a href="PagPeli.php?PeliculaID=<?php echo $arrPelis->getPeliculaID(); ?>">
                <img src="<?php echo $arrPelis->getIMG() ?>">
                <p class="nomPeli"><?php echo $arrPelis->getNombre(); ?>
                    (<?php
                    //Con esta funcion hago que me muestra lo de despues o antes del caracter que le pongo
                    //dependiendo si en el ultimo parametro pongo true(antes) o nada(despues)
                    $anyo = strstr($arrPelis->getFechaSalida(), '-', true);
                    echo $anyo; ?>)</p>
                <p><?php  echo $arrPelis->getCalificacion(); ?></p>
            </a>
        </div>
    <?php } ?>
</div>
</body>
</html>
