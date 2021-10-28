<?php
$api_url ="https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$partidos = json_decode(file_get_contents($api_url . "parties"), true);
$provincias= json_decode(file_get_contents($api_url . "districts"), true);
$resultados= json_decode(file_get_contents($api_url . "results"), true);


/*echo "<br>";
echo "<pre>";
var_dump($resultados);
echo "</pre>";*/

include("Partidos.php");
include("Provincias.php");

// https://es.wikipedia.org/wiki/Sistema_D%27Hondt#:~:text=El%20n%C3%BAmero%20de%20votos%20recibidos,hasta%20que%20estos%20se%20agoten.
// https://es.wikipedia.org/wiki/Circunscripciones_electorales_del_Congreso_de_los_Diputados

/*$provincias=["Madrid","Barcelona","Valencia","Alicante","Sevilla", "Malaga","Murica","Cadiz","Baleares","La Coruña", "Las Palmas", "Vizcaya",
    "Asturias","Granada","Pontevedra","Santa Cruz de Tenerife","Zaragoza","Almeria","Badajoz","Cordiba","Gerona","Guipúzcoa", "Tarragona", "Toledo",
    "Cantabria","Castellón", "Ciudad Real", "Huelva", "Jaén", "Navarra", "Valladolid", "Álava", "Albacete", "Burgos","Cáceres", "León", "Lérida",
    "Lugo", "Orense","La Rioja","Salamanca","Ávila", "Cuenca", "Guadalajara", "Huesca", "Palencia","Segovia", "Teruel","Zamora","Soria","Ceuta","Melilla"];
*/



function escaños(){



}


?>