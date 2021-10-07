<html lang="es">
<head>
    <title>Find N prime numbers</title>
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

    function getDivisors($num){

        /*1*/ for($fila=1;$fila<=$num;$fila++){
            echo '<br>';
           /*3*/for($j=$num;$j>$i;$j--){
                echo '*';
            }
            /*2*/ for($i=0;$i<$fila;$i++){
                echo '<span style="color:orangered">*</span>';
            }

        }
    }


    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        getDivisors($num);

    }
    ?>
</div>
</body>
</html>