<?php
session_start();

if($_GET["logout"]!="") {
    if( isset( $_GET["logout"] )==true ) {
        session_unset();
        session_destroy();
        header( "Location: ../Controladores/IniSesion_controlador.php" );
    }
}

?>