<?php
require_once("../Modelos/Login_modelo.php");

session_start();

session_destroy();
session_unset();

require_once ("../Vistas/Login_vista.php");
?>