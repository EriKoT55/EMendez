<html lang="es">
<head>
    <title>Find N perfect numbers</title>
</head>
<body>
<form method="post" action="numPerfectos.php">
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
        for($i=1;$i<$num;$i++){

            if($num%$i==0){
                $array[]=$i;
            }
        }
        return $array;
    }

    function isPerfectNum($num){
       // es igual a la suma de sus divisores

        $j=0;
        $i=1;

        while($j<$num){
            $perfecto=getDivisors($i);
            $sum=array_sum($i);

            if($sum==$i){
                echo $i.'<br>';
                $j++;
            }
            $i++;

        }

    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        echo 'Los '.$num.' primeros numeros perfectos <br>';
        isPerfectNum($num);


    }
    ?>
</div>
</body>
</html>