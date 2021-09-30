<html lang="es">
<head>
    <title>Find N prime numbers</title>
</head>
<body>
<form method="post" action="find_n_primes.php">
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

            for ($i = 1; $i < $num; $i++) {
                if ($num % $i == 0) {
                    echo '<br> Divisible por: ' . $num;
                }
            }
        }
    }
    function isPrimeNum($num){
        //TODO: YOUR CODE HERE
    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);
        //TODO: YOUR CODE HERE
    }
    ?>
</div>
</body>
</html>