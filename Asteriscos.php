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
<div  echo '<span style="background-color:black"></span>';>
    <?php

    function setArbolAsteriscos($num){


   /*1*/ for($filas=0;$filas<=$num;$filas++){
            echo '<br>';

      /*3*/ for($j=$num;$j>$filas;$j--){// Asteriscos lateral izquierdo

                echo '*';

            }

      /*2*/ for($i=0;$i<=$filas;$i++){// Asteriscos central derecho

                echo '<span style="color:darkorange">*</span>';




            }
            /*5*/  for($i=0;$i<$filas;$i++){
                echo '<span style="color: darkorange">*</span>';// Asteriscos central izquierdo
            }
      /*4*/ for($z=$num;$z>$filas;$z--){// Asteriscos lateral derecho

                echo '*';

            }
    }

    }


    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        setArbolAsteriscos($num);

    }
    ?>
</div>
</body>
</html>