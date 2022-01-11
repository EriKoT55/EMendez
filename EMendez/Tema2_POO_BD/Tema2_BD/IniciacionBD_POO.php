<?php

$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$partidos = json_decode(file_get_contents($api_url . "parties"), true);
$provincias = json_decode(file_get_contents($api_url . "districts"), true);
$resultados = json_decode(file_get_contents($api_url . "results"), true);

$servername="sql480.main-hosting.eu";//sql480.main-hosting.eu
$username="u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
$password="x43233702G";//x43233702G
$database="u850300514_emendez";//u850300514_emendez

//Creo la conexion
$conn = new mysqli($servername,$username,$password,$database);

// Me aseguro de si va bien la conexion

if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}
/*//++++++++++++++++++++++++++
//Utilizar la BD en vez de json
$query = "SELECT * FROM Partidos";

$result = $conn->query($query);

//Array asociativo

$partidos = $result->fetch_all(MYSQLI_ASSOC);
//+++++++++++++++++++++*/

/*echo "<br>";
echo"<pre>";
var_dump($all);
echo "</pre>";*/


/* Insertar datos de los arrays de objetos a la base de datos automatizar */
//Creacion de una base de datos
//$sql ="CREATE DATABASE Elecciones_u850300514_emendez";

/*for ($i=0;$i<count($partidos);$i++){

    $name[]=$partidos[$i]["name"];
    $name[$i]=$conn->real_escape_string($name[$i]);

    $sql = "INSERT INTO Partidos (name,acronym,logo,colour)
        VALUES ('".$name[$i]."','".$partidos[$i]["acronym"]."','".$partidos[$i]["logo"]."','".$partidos[$i]["colour"]."')";

    if($conn->query($sql)=== TRUE){
        echo"Valores introducidos satisfactoriamente";
    }else{
        echo "Error al introducir los datos en la tabla: ". $conn->error;
    }
}*/



/*for ($i=0;$i<count($provincias);$i++){
    $sql = "INSERT INTO  Provincias (name,delegates)
    VALUES ('".$provincias[$i]["name"]."','".$provincias[$i]["delegates"]."')";
    //Coger los valores del array e ir introduciendolos en la tabla
    if($conn->query($sql)=== TRUE){
        echo"Valores introducidos satisfactoriamente";
    }else{
        echo "Error al introducir los datos en la tabla: ". $conn->error;
    }
}*/



/*for ($i=0;$i<count($resultados);$i++){
    $party[]=$resultados[$i]["party"];
    $party[]=$conn->real_escape_string($party[$i]);

    $sql = "INSERT INTO  Resultados (district,party,votes)
    VALUES ('".$resultados[$i]["district"]."','".$party[$i]."','".$resultados[$i]["votes"]."')";
     //Coger los valores del array e ir introduciendolos en la tabla

    if($conn->query($sql)=== TRUE){
        echo"Valores introducidos satisfactoriamente";
    }else{
        echo "Error al introducir los datos en la tabla: ". $conn->error;
    }
}*/

/*$sql= "CREATE TABLE Resultados (
   id INT(20) AUTO_INCREMENT PRIMARY KEY ,
    district VARCHAR(30) NOT NULL,
    party VARCHAR(100),
    votes INT(50)
)";*/

/*$sql= "CREATE TABLE Partidos(
    
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    acronym VARCHAR(10) NOT NULL,
    logo VARCHAR(100) ,
    colour VARCHAR(10)
    
)";*/

/*$sql= "CREATE TABLE Provincias(
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    delegates INT(5)
)";*/

// Si los hacia todos juntos solo me metia el ultimo así constantemente con multi_query( no he utilizado )

/*if($conn->multy_query($sql)=== TRUE){
    echo"Valores introducidos satisfactoriamente";
}else{
    echo "Error al introducir los datos en la tabla: ". $conn->error;
}*/

$conn->close();
?>