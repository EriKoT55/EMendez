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

        $j=0; // contador el cual guarda cuantos numeros perfectos voy sacando
        $i=1; // contador el cual cogere para mostrarme los numeros perfectos

        while($j<$num){
            $perfecto=getDivisors($i); // guardo la funcion anterior en una variable
            $sum=array_sum($perfecto); //sumo lo que hay en cada posicion de un array y lo guardoen una variable

            if($sum==$i){ // si la suma de los divisores es igual a la variable i
                // por ejemplo si sum=6 == a i=6
                echo $i.'<br>'; // devuelve las $i que son numeros perfectos
                $j++;// Me guarda en j el numero de numeros perfectos
            }
            $i++;

        }

    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        echo 'Los '.$num.' primeros numeros perfectos <br>';
        isPerfectNum($num); // muestra los numeros perfectos


    }
    ?>
</div>
</body>
</html>
