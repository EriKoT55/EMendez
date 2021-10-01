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
    $array=[];
    function getDivisors($num){

            for ($i = 1; $i <= $num; $i++) {

                if ($num % $i == 0) {

                    $array[]=$i;
                    echo '<br>Divisible por: '.$i;
                }
            }
            var_dump($array);
            return $i;
        }

    function isPrimeNum($num){

        $divisores = getDivisors($num);

        $count=count();


            if($count==2){

            }

        }





    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

    }
    ?>
</div>
</body>
</html>