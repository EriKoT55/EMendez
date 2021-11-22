<?php
/*Crear una nueva conexion en MYSQL, CASA*/
$servername="sql480.main-hosting.eu";//sql480.main-hosting.eu
$username="u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
$password="x43233702G";//x43233702G
$database="u850300514_emendez";//RickMorthy_u850300514_emendez

//Creo la conexion
$conn = new mysqli($servername,$username,$password,$database);

// Me aseguro de si va bien la conexion
if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}
echo "Conexion echa";

function Characters(){
    global $conn;

    $sql="SELECT * FROM Characters";




    return $characterBD;
}

function Episodes(){



    return $episodesBD;
}

function Locations(){


    return $locationsBD;
}

?>