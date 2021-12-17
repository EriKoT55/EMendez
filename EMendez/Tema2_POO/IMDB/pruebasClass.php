<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->server();



echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliculas(1));
echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

