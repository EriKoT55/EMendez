<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>CONQUISTA</title>
</head>
<body>
<h1>Login</h1>

<form method="post" action="../Controladores/IniSesion_controlador.php">

    <label>Mail:</label>
    <input name="mail" type="email" required>
    <br>
    <label>Password:</label>
    <input name="password" type="password" required>
    <br>
    <input type="submit">
    <p>No tienes una cuenta <a href="../Controladores/Register_controlador.php">Registrate</a></p>
</form>

</body>
</html>