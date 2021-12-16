<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->server();



echo "<br>";
echo "<pre>";
var_dump($conn->cogerPersona(1));
echo "<br>";

?>

