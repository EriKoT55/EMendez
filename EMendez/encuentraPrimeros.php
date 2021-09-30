<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Encuentra los n primeros numeros</title>
</head>
<body>
<form method="post" action="encuentraPrimeros.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php
    function getDivisors($num){

        if(isset($_POST["num"])) {

            $num = intval($_POST["num"]);

            for($i=1;$i<$num;$i++){

                if($num%$i==0){
                    echo "<br> Divisible por: ".$i;
                }
            }

        }

    }

    function isPrimeNum($num){



    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);
        //TODO: YOUR CODE HERE
    }
    ?>
</div>
</body>
</html>