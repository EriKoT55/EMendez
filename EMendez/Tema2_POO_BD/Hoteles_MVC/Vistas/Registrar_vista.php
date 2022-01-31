<?php
//error_reporting(0);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--ESTILOS-->
    <style>
        #body {
            background-color: #CDEBF7;
            font-family: 'Readex Pro', sans-serif;
        }

        #contenedorIni {
            background-color: #54A5C4;
            border-radius: 10px;
            padding-bottom: 15px;
            font-weight: bold;
        }

        #btnIni {
            background-color: #08465E;
        }
    </style>
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>NAVEGATOR</title>
</head>
<body id="body">

<div class="container ">
    <div class="row justify-content-center ">
        <div id="contenedorIni" class="col-sm-6 mt-5 ">
            <h1 class="text-center mt-2 mb-4">Registrar</h1>

            <!--------  FORM  ----------->
            <form action="../Controladores/Registrar_controlador.php" method="post">
                <div class="form-group">
                    <label for="usuario">Nombre Usuario</label>
                    <input name="user" type="text" class="form-control" id="usuario" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input name="correo" type="email" class="form-control" id="correo" aria-describedby="emailHelp"
                           required>
                </div>
                <div class="form-group">
                    <label for="contraseñya">Contraseña</label>
                    <input name="contra" type="password" class="form-control" id="contrasenya" required>
                </div>
                <div class="form-group">
                    <label for="confirm">Confirme Contraseña</label>
                    <input name="confirm" type="password" class="form-control" id="confirm" required>
                </div>
                <div>
                    <button id="btnIni" type="submit" class="btn btn-primary ml-2">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
-->
</body>
</html>
