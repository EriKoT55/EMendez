<html lang="es">
<head>
    <title>How Secure Is My Password</title>
    <style>
        body{
            background-color: /*Aqui poner el metodo script*/;
        }
    </style>
</head>
<body>

<form method="post" action="Contraseña.php">
    <label>
        Password:
        <input type="password" name="password" placeholder="Enter your password"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php

    function getPassword($password){



    }


    if (isset($_POST["password"])) {
        $password = intval($_POST["password"]);


    }
    ?>
</div>
</body>
</html>