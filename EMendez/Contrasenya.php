<html lang="es">
<head>
    <title>How Secure Is My Password</title>
    <style>
        body{
            background-color: aqua;
        }
    </style>
</head>
<body>

<form method="post" action="Contrasenya.php">
    <label>
        Password:
        <input type="password" name="password" placeholder="Enter your password"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php


    function timeforCraking($password){
        $numchar=strlen($password);
        $charAscii=pow(256,$numchar);
        $secsCracking=$charAscii/1000;

        $anyosforCracking=$secsCracking/60/60/24/365;

        //Sacar meses
        $mesesforCracking=($anyosforCracking - floor($anyosforCracking))*12;
        //Sacar dias
        $diasforCraking=($mesesforCracking- floor($mesesforCracking))*365;
        //Sacar horas
        $horasforCraking=($diasforCraking-floor($diasforCraking))*24;
        //Sacar minutos
        $minutosforCraking=($horasforCraking-floor($horasforCraking))*60;
        //Sacar segundos
        $segundosforCraking=($minutosforCraking-floor($minutosforCraking))*60;

        echo 'Tardara en ser crackeada '.floor($anyosforCracking).' años '.floor($mesesforCracking). ' meses '.floor($diasforCraking).' dias '.floor($horasforCraking).' horas '.floor($minutosforCraking).' minutos '.floor($segundosforCraking).' segundos';

    }
    function changeColor($password){
        $numchar=strlen($password);

        if($numchar==0){
            echo "<body style='background-color: aqua' ></body>";
        }else if($numchar>0 && $numchar<=4){
            echo "<body style='background-color: red' ></body>";

        }else if($numchar>=5 && $numchar<=8){
            echo "<body style='background-color: orange' ></body>";
        }else if($numchar>=9 && $numchar<=12){
            echo "<body style='background-color: yellow' ></body>";
        }else if($numchar>13){
            echo "<body style='background-color: lawngreen' ></body>";
        }

    }


    if (isset($_POST["password"])) {
        $password = ($_POST["password"]);

        changeColor($password);

        timeforCraking($password);
    }
    ?>
</div>
</body>
</html>