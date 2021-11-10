<?php

$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$partidos = json_decode(file_get_contents($api_url . "parties"), true);
$provincias = json_decode(file_get_contents($api_url . "districts"), true);
$resultados = json_decode(file_get_contents($api_url . "results"), true);


$servername="localhost";
$username="root";
$password="Ageofempires2*";
$dbname="Elecciones";

//Creo la conexion
$conn = new mysqli($servername,$username,$password,$dbname);

// Me aseguro de si va bien la conexion

if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}
/* Insertar datos de los arrays de objetos a la base de datos automatizar */
//Creacion de una base de datos
/*$sql ="CREATE DATABASE Elecciones";*/
$sql= "INSERT INTO Partidos (name,acronym,logo,colour)VALUES (";
        foreach ($partidos as $partido=>$value){
            $sql.="";
       /* Coger los valores del array e ir introduciendolos en la tabla*/
        }
    $sql .= ")" ;
if($conn->query($sql)=== TRUE){
    echo"Base de datos creada satisfactoriamente";
}else{
    echo "Error al crear la base de datos: ". $conn->error;
}

$conn->close();
?>