<!doctype html>
<html lang="es">
<head>
    <title>Get divisors</title>
</head>
<body>
    <form method="post" action="pruebas.php">
        <label>
            Number:
            <input type="text" name="num">

        </label type="submit">



    </form>
<div>
    <?php
        $array=[];
        if(isset($_POST["num"])) {

            $num = intval($_POST["num"]);

            for($i=1;$i<=$num;$i++){

                if($num%$i==0){
                    echo "<br> Divisible por: ".$i.'<br>';
                    $array[]=$i;
                    return $array;
                }
            }
            var_dump($array);
        }

    ?>
</div>

</body>
</html>

