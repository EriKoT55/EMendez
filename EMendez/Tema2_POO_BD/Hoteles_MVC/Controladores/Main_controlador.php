<?php
require_once("../Modelos/Main_modelo.php");

$conn = new Main_modelo();
$as=$conn->getHotel();


require_once ("../Vistas/pagMain_vista.php");

?>