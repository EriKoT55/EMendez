<html lang="es">
<head>
    <title>How Secure Is My Password?</title>
    <style>
        body{
            background-color: aqua;
            text-align: center;
            padding: 250px;
        }
        .password{
            border: 1px solid rgba(0, 0, 0, 0);
            background-color: rgba(170, 167, 167, 0.638);
            height: 60px;
        }
        .password,placeholder{
            text-align: center;
        }
    </style>
</head>
<body>

<form method="post" action="Contrasenya.php">
    <h2>How Secure is my password?</h2>
    <label>

        <input type="password" class="password" name="password" size="50"  placeholder="Enter your password"/>
    </label>

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
        $diasforCraking=($mesesforCracking- floor($mesesforCracking))*30;

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
        }else if($numchar>=13){
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