<?php
/*Crear una nueva conexion en MYSQL, CASA*/
$servername="localhost";//sql480.main-hosting.eu
$username="erikPhp"; //u850300514_emendez //casa erikPhp // clase root
$password="Ageofempires2*";//x43233702G
$database="RickMorthy";//RickMorthy_u850300514_emendez

//Creo la conexion
$conn = new mysqli($servername,$username,$password,$database);

// Me aseguro de si va bien la conexion
if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}
echo "Conexion echa";

function Characters(){

    global $conn;

    $query="SELECT * FROM Characters";

    $resultCharacter= $conn->query($query);

    $charactersBD= $resultCharacter->fetch_all(MYSQLI_ASSOC);

    /*Me falta meter el idEps de la tabla EpsChars en el array CharactersBD */

    return $charactersBD;
}


?>