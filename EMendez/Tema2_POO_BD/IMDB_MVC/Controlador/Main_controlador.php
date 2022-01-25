<?php
error_reporting(0);
require_once ("../Modelo/Main_modelo.php");
//session_start();

$conn = new Main_modelo();

/*if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
}*/

/*https://www.imdb.com/title/tt2382320/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=ea4e08e1-c8a3-47b5-ac3a-75026647c16e&pf_rd_r=1VHKKEY8F9SF79HJTAB3&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=moviemeter&ref_=chtmvm_tt_6*/


//Coger los datos para poder trabajar el Obj
$ArrObjPeli = $conn->cogerPeliculas();
$Generos=$conn->Generos();

//Buscador
$ArrFiltradoPeli = $ArrObjPeli;

if (isset($_GET["buscar"])) {
    $ArrFiltradoPeli=$conn->busq_pelXnom($_GET["buscar"]);
}

$criterioFiltracion = $_GET["criterioFiltracion"];
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

require_once ("../Vista/Main_vista.php");
?>