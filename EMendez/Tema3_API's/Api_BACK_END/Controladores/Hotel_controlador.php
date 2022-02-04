<?php
require_once ("../Modelos/Hotel_modelo.php");

$conn = new Hotel_modelo();

$hoteles = $conn->getHoteles();

echo json_encode($hoteles);

?>