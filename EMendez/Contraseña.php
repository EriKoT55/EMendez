<html lang="es">
<head>
    <title>How Secure Is My Password</title>
    <style>
        body{
            background-color: /*Aqui poner el metodo script*/;
        }
    </style>
</head>
<center>
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

    function TimeforCracking($password){



    }

    function changeColor($password){
        // son muchos if/ else if
        if(strlen($password)==0) {
            echo '<style> body{
                            background-color: deepskyblue;
                        }   </style>';
        }else if(strlen($password)>0 && srtlen($password)<= 4){
            echo '<style> body{
                            background-color: red;
                        }  </style>';
        }else if(strlen($password)>=5 && srtlen($password)<= 8){
            echo '<style> body{
                            background-color: orange;
                        }  </style>';
        }else if(strlen($password)>=9 && srtlen($password)<= 11){
            echo '<style> body{
                            background-color: yellow;
                        }  </style>';
        }else if(strlen($password)>=12){
            echo '<style> body{
                            background-color: greenyellow;
                        }  </style>';
        }

    }

    if (isset($_POST["password"])) {
        $password = intval($_POST["password"]);

        changeColor($password);


    }
    ?>
</div>
</body>
</center>
</html>