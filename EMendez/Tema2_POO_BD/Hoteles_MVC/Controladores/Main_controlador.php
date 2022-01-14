<?php
require_once("../Modelos/Main_modelo.php");

$conn = new Main_modelo();
$hoteles=$conn->getHoteles();

require_once ("../Vistas/pagMain_vista.php");

?>