<?php
error_reporting(0);
session_start();
$api="";
$iniciada=json_decode(file_get_contents($api),false);


if($iniciada==true) {


            $_SESSION["Ini"]=true;
            $_SESSION["user"]=$iniciada;
            $_SESSION["userID"]=$iniciada;

            header( "Location: ../Controladores/Main_controlador.php" );
        } else {
            echo "<script>

                window.alert('Algunos de los datos no son correctos');
    
            </script>";
        }


require_once( "../Vistas/IniSesion_vista.php" );

?>