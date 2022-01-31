<?php
error_reporting( 0 );
require_once( "../Modelos/Main_modelo.php" );
session_start();

$conn = new Main_modelo();
$hoteles = $conn->getHoteles();

if( isset( $_GET["cerrarSesion"] ) ) {
    session_unset();
    session_destroy();
}

require_once( "../Vistas/Main_vista.php" );

?>