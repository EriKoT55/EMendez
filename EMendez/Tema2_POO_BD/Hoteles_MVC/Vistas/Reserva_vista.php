<?php
error_reporting( 0 );
?>
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Link fuente texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
    <style>
        #body {
            background-color: #CDEBF7;
            font-family: 'Readex Pro', sans-serif;
        }

        #contenedorReserva {
            background-color: #54A5C4;
            border-radius: 10px;
            padding-bottom: 15px;
            font-weight: bold;
        }

        #btnRes {
            background-color: #08465E;
        }
    </style>
    <!-- LINK BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>NAVEGATOR</title>
</head>
<body id="body">

<!--
PREGUNTAR SI ES POSIBLE DAR ALGO DE INFORMACION DEL HOTEL EN LA RESERVA SIN SER UN DOLOR DE CABEZA
-->

<div class="container ">
    <div class="row justify-content-center ">
        <div id="contenedorReserva" class="col-sm-6 mt-5 ">
            <h1 class="text-center mt-2 mb-4">Reserva</h1>
            <form action="../Controladores/Reserva_controlador.php" method="post">
                <div class="form-group">
                    <label for="entrada">Entrada</label>
                    <input type="date" id="entrada" name="entrada" class="form-control"
                           min="<?php
                           echo date( "Y-m-d" ) ?>" max="2022-12-31" required>
                </div>
                <div class="form-group">
                    <label for="salida">Salida</label>
                    <input type="date" id="salida" name="salida" class="form-control"
                           min="<?php
                           //HARE UN SCRIPT PARA QUE LA FECHA MINIMA SEA LA SELECCIONADA EN LA FECHA ENTRADA CON DOM
                           echo date( "Y-m-d" ) ?>" max="2022-12-31" required>
                </div>
                <div class="form-group">
                    <label for="huespedes">De cuantas personas estamos hablando:</label>
                    <input type="text" name="huespedes" class="form-control" required>
                </div>
                <div class="form-group">
                    <input id="btnRes" type="submit" value="Enviar" class="btn btn-primary">
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
</body>
</html>
