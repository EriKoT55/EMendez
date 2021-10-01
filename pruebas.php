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

    if(isset($_POST["num"])) {
        //isset evalua si una variable esta definida o no.
        //La variable de dentro POST busca la parte del formulario de num y cuando tu le metes el numero
        //lo que hace es ver que se ejecuta al enviar el formulario
        $num = intval($_POST["num"]);

        for($i=1;$i<$num;$i++){

            if($num%$i==0){
                echo "<br> Divisible por: ".$i;
            }
        }

    }

    ?>
</div>

</body>
</html>
