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
          $array=[];
            for ($i = 1; $i <= $num; $i++) {
                if ($num % $i == 0) {

                    $array[]=$i;

                }
            }
            return $array;
        }

    function isPrimeNum($num){

        $j=1;
        for($i=1;$j<=$num;$i++){

            $divisores = getDivisors($i);

            $count=count($divisores);
            if($count==2){
                echo '<br>'.$divisores[1];
                $j++;
            }
          }

        }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        echo 'Los '.$num.' primeros numeros primos: <br>';
        isPrimeNum($num);

    }
    ?>
</div>
</body>
</html>