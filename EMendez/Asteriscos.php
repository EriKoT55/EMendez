<html lang="es">
<head>
    <title>Arbol de Asteriscos</title>
</head>
<body>
<form method="post" action="Asteriscos.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php

    function getAsteriscos($num){

        /*1*/ for($fila=0;$fila<=$num;$fila++){

            echo '<br>';
           /*3*/for($j=$num;$j>$fila;$j--){// Asteriscos lateral izquierdo
                echo '<span style="color:white">*</span>';
            }
            /*2*/for($i=0;$i<$fila;$i++){// Asteriscos central derecho
                echo '<span style="color:darkorange">*</span>';

            }
            /*4*/for($i=0;$i<=$fila;$i++){ // Asteriscos central izquierdo
                echo '<span style="color:darkorange">*</span>';
            }

        }
    }


    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);
        getAsteriscos($num);

    }
    ?>
</div>
</body>
</html>