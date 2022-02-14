<?php
error_reporting( 0 );
require_once( "../Modelos/Main_modelo.php" );

$conn = new Main_modelo();
$hoteles = $conn->getHoteles();
//var_dump($hoteles);

$hotelesApi=json_encode($hoteles);

echo $hotelesApi;

?>