<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
</head>
<body>
<h1>Sign up</h1>
<form method="post" action="../Controladores/Register_controlador.php">
    <label>Mail: </label>
    <input name="mail" type="email" required>
    <br>
    <label>Password:</label>
    <input name="password" type="password" required>
    <br>
    <label>Repeat Password:</label>
    <input name="repeat" type="password" required>
    <br>
    <input type="submit">
</form>

</body>
</html>