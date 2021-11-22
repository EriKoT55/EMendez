<?php

error_reporting(0);

require("Partidos.php");
require("Provincias.php");
require("Resultados.php");
require("BD.php");


$partidos = Partidos();
$provincias = Provincias();
$resultados = Resultados();


echo "<br>";
echo "<pre>";
echo  var_dump($partidos);
echo "<br>";


/*$partidos_obj=[];

foreach ($partidos as $partido){
    $partidos_obj[]= new Partido($partido["id"],$partido["name"],$partido["acronym"],$partido["logo"],$partido["colour"]);
}
*/
?>