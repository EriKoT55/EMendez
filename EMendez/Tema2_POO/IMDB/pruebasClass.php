<?php
include_once "Clases/BD.php";

$conn= new BD();
$conn->server();

$genArray=$conn->Generos();

echo "<br>";
echo "<pre>";
var_dump($conn->Nombre_peliXactor(2));
echo "<br>";

?>

