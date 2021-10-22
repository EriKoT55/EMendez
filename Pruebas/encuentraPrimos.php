<html lang="es">
<head>
    <title>Find N prime numbers</title>
</head>
<body>
<form method="post" action="encuentraPrimos.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php
    function getDivisors($num){

        for($i=1;$i<=$num;$i++){

            if($num%$i==0){
                $array[]=$i;
            }

        }
        return $array;
    }

    function isPrimeNum($num){
        //TODO: YOUR CODE HERE

        $j=0;
        for($i=0;$j<$num;$i++){

            $divisores=getDivisors($i);

            if(count($divisores)==2){
                echo "<br>".$divisores[1];
                $j++;
            }

        }

    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);
        //TODO: YOUR CODE HERE
        isPrimeNum($num);
    }
    ?>
</div>
</body>
</html>