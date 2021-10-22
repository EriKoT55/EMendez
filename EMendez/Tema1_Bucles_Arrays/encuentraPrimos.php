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
        for($i=1;$j<=$num;$i++) { //condicion: si le paso un 7 me devolvera 7 numeros. j debe ser menor que el numero que le pase para que el bucle continue

            $divisores=getDivisors($i);// Guardo en una variable la funcion anterior y miro los divisores de la variable $i

            $count=count($divisores); // Me cuenta los divisores

            if ($count == 2) {// condicion para saber que numeros son primos
                echo '<br>'.$divisores[1];// devolvemos la posicion 1 del array la cual tiene un dos, refiriendose a los 2 divisores que necesita tener un numero para ser primo.
                $j++;
            }
        }
    }
    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);

        echo 'Los '.$num.'primeros numeros primos son: ';
        isPrimeNum($num);

    }
    ?>
</div>
</body>
</html>