<?php
error_reporting(0);
include_once("Persona.php");
include_once("Pelicula.php");
include_once("Genero.php");
include_once("BD.php");
/*https://www.imdb.com/title/tt2382320/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=ea4e08e1-c8a3-47b5-ac3a-75026647c16e&pf_rd_r=1VHKKEY8F9SF79HJTAB3&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=moviemeter&ref_=chtmvm_tt_6*/

/*Crear una nueva conexion en MYSQL*/
$servername = "sql480.main-hosting.eu";//sql480.main-hosting.eu
$username = "u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
$password = "x43233702G";//x43233702G
$database = "u850300514_emendez";//RickMorthy_u850300514_emendez

//Creo la conexion
$conn = new mysqli($servername, $username, $password, $database);

// Me aseguro de si va bien la conexion
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

//Coger los datos para poder trabajar el Obj
global $ArrObjPeli;
global $ArrObjGen;

//Ordenacion de las peliculas, tengo pensado hacerlo con sql para que sea mas optimo
//Opciones: ranking, fecha de salida, director y genero.
//De menor a mayor
function RankingASC()
{
    global $conn;

    $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Calificacion ASC;";

    $result = $conn->query($sql);
    $Arr_rankAsc = $result->fetch_all(MYSQLI_ASSOC);

    $array_obj_peli = ObjPelicula($Arr_rankAsc);
    $ArrFiltradoPeli = BucleXAinsercionPelicla($array_obj_peli);

    return $ArrFiltradoPeli;
}

//De mayor a menor
function RankingDESC()
{
    global $conn;

    $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Calificacion DESC;";

    $result = $conn->query($sql);
    $Arr_rankDesc = $result->fetch_all(MYSQLI_ASSOC);

    $array_obj_peli = ObjPelicula($Arr_rankDesc);
    $ArrFiltradoPeli = BucleXAinsercionPelicla($array_obj_peli);

    return $ArrFiltradoPeli;
}

function mostrarPelisGenero($NomGen)
{

    global $conn;

    $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            JOIN GenPeli gp on gp.PeliculaID=pl.PeliculaID
            JOIN Genero g on g.GeneroID=gp.GeneroID
            WHERE g.Nombre='" . $NomGen . "'
            ORDER BY pl.PeliculaID;";

    $result = $conn->query($sql);
    $Arr_pelisXgen = $result->fetch_all(MYSQLI_ASSOC);

    $array_obj_peli = ObjPelicula($Arr_pelisXgen);
    $ArrFiltradoPeli = BucleXAinsercionPelicla($array_obj_peli);

    return $ArrFiltradoPeli;
}

function Fecha_SalidaASC()
{
    global $conn;

    $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Fecha_Salida ASC;";

    $result = $conn->query($sql);
    $Arr_fechAsc = $result->fetch_all(MYSQLI_ASSOC);

    $array_obj_peli = ObjPelicula($Arr_fechAsc);
    $ArrFiltradoPeli = BucleXAinsercionPelicla($array_obj_peli);

    return $ArrFiltradoPeli;
}

function Fecha_SalidaDESC()
{
    global $conn;

    $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Fecha_Salida DESC;";

    $result = $conn->query($sql);
    $Arr_fechDesc = $result->fetch_all(MYSQLI_ASSOC);

    $array_obj_peli = ObjPelicula($Arr_fechDesc);
    $ArrFiltradoPeli = BucleXAinsercionPelicla($array_obj_peli);

    return $ArrFiltradoPeli;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosMain.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav>
    <div class="caja">
        <div class="contenedorSearch">
            <!--Para hacer una barra de busqueda decente-->
            <!--https://webdesign.tutsplus.com/es/tutorials/css-experiments-with-a-search-form-input-and-button--cms-22069-->
            <span class="icon"><i class="fa fa-search"></i></span>
            <input type="search" id="buscar" placeholder="Search..."/>
        </div>
    </div>
    <!--Poner nombre a las clases-->
    <form action="PagMain.php" method="get">
        <div class="contenedorSelector">
            <?php $criterioFiltracion = $_GET["criterioFiltracion"] ?>
            <select name="criterioFiltracion">
                <option <?php echo($criterioFiltracion == "" ? "selected" : "") ?> value="unsorted">Normal</option>
                <option <?php echo($criterioFiltracion == "calificacion" ? "selected" : "") ?> value="calificacion">Calificacion</option>
                <option <?php echo($criterioFiltracion == "fecha_salida" ? "selected" : "") ?> value="fecha_salida">Fecha de salida</option>
                <option <?php echo($criterioFiltracion == "genero" ? "selected" : "") ?> value="genero">Generos</option>
            </select>
            <div>
                <?php

                if (isset($_GET["criterioFiltracion"])) {
                    switch ($criterioFiltracion) {
                        case "calificacion":
                            $calificacion = $_GET["calificacion"];
                            echo '<div class="contenedorSelector2">';
                            echo '<select name="calificacion">';
                            if ($calificacion == "mejor") {
                                echo '<option value="mejor"selected>Mejor calificadas</option>';
                            } else {
                                echo '<option value="mejor">Mejor calificadas</option>';
                            }
                            if ($calificacion == "peor") {
                                echo '<option value="peor"selected>Peor calificadas</option>';
                            } else {
                                echo '<option value="peor">Peor calificadas</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            break;
                        case "fecha_salida":
                            $fecha_salida = $_GET["fecha_salida"];
                            echo '<div class="contenedorSelector2" >';
                            echo '<select name="fecha_salida">';
                            if ($fecha_salida == "nuevas") {
                                echo '<option value="nuevas"selected>Nuevas</option>';
                            } else {
                                //No acabo de entender del todo porque debo poner en uno selected y en otro no para que me muestre algun valor
                                echo '<option value="nuevas">Nuevas</option>';
                            }
                            if ($fecha_salida == "antiguas") {
                                echo '<option value="antiguas"selected>Antiguas</option>';
                            } else {
                                echo '<option value="antiguas">Antiguas</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            break;
                        case "genero";
                            $genero = $_GET["genero"];
                            echo '<div class="contenedorSelector2" >';
                            echo '<select name="genero">';
                            foreach ($ArrObjGen as $gen => $valores) {
                                if ($genero == $valores->getNombre()) {
                                    echo '<option value="' . $valores->getNombre() . '"selected>' . $valores->getNombre() . '</option>';
                                } else {
                                    echo '<option value="' . $valores->getNombre() . '">' . $valores->getNombre() . '</option>';
                                }
                            }
                            echo '</select>';
                            echo '</div>';
                            break;
                    }
                }
                $ArrFiltradoPeli = $ArrObjPeli;

                if ($criterioFiltracion == "calificacion") {
                    $calificacion = $_GET["calificacion"];
                    if ($calificacion == "mejor") {
                        $ArrFiltradoPeli = RankingDESC();
                    }
                    if ($calificacion == "peor") {
                        $ArrFiltradoPeli = RankingASC();
                    }
                }
                if ($criterioFiltracion == "fecha_salida") {
                    $fecha_salida = $_GET["fecha_salida"];
                    if ($fecha_salida == "nuevas") {
                        $ArrFiltradoPeli = Fecha_SalidaDESC();
                    }
                    if ($fecha_salida == "antiguas") {
                        $ArrFiltradoPeli = Fecha_SalidaASC();
                    }
                }
                if ($criterioFiltracion == "genero") {
                    $genero = $_GET["genero"];
                    if ($genero != "") {
                        $ArrFiltradoPeli = mostrarPelisGenero($genero);
                    }
                }
                ?>
                <button id="submit" type="submit">Filtrar</button>
    </form>
</nav>
<div class="contenedor">
    <?php for ($i = 0; $i < count($ArrFiltradoPeli); $i++) {//Aqui funciona pero es una chapuza
        $peli = $ArrFiltradoPeli[$i] ?>
        <div class="contenedorPelis">
            <a href="PagPeli.php?PeliculaID=<?php echo $peli->getPeliculaID(); ?>"> <img
                        src="<?php echo $peli->getIMG(); ?>">
                <p class="nomPeli"><?php echo $peli->getNombre(); ?>
                    (<?php
                    //Con esta funcion hago que me muestra lo de despues o antes del caracter que le pongo
                    //dependiendo si en el ultimo parametro pongo true(antes) o nada(despues)
                    $anyo = strstr($peli->getFechaSalida(), '-', true);
                    echo $anyo; ?>)</p>
                <p><?php echo $peli->getCalificacion(); ?></p>
            </a>
        </div>

    <?php } ?>
</div>
</body>
</html>
