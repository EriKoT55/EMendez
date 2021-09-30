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

        if()

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