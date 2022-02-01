<?php
require_once("../Modelos/Register_modelo.php");
error_reporting(0);

$conn = new Register_modelo();

if ($_POST["mail"] != "" && $_POST["password"] != "" && $_POST["confirm"] != "") {
    if (isset($_POST["mail"]) && isset($_POST["password"]) == isset($_POST["confirm"])) {
        if ($_POST["password"] == $_POST["confirm"]) {
            if ($conn->insertUsr($_POST["mail"], $_POST["password"])==true) {

                header("Location: ../Controladores/Login_controlador.php");
            } else {
                //SI PETA UN ECHO Y VOLANDO
                echo "
                <script>
                    window.alert('ERROR AL INTRODUCIR LOS DATOS');
                </script>
        ";
            }
        } else {
            //SI PETA UN ECHO Y VOLANDO
            echo "
                <script>
                    window.alert('ERROR AL INTRODUCIR LOS DATOS');
                </script>
        ";
        }
    }
}
require_once("../Vistas/Register_vista.php");
?>

