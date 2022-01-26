<?php
session_start();
session_unset();
session_destroy();
header("Location:IniSesion_controlador.php");
?>