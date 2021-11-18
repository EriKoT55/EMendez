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

    /*Meter los eps en la tabla, con fetch_assoc*/
    /*https://www.php.net/manual/es/mysqli-result.fetch-assoc.php*/

    return $charactersBD;
}

function Episodes(){

    global $conn;

    $query="SELECT * FROM Episodes";

    $resultEpisodes= $conn->query($query);

    $episodesBD= $resultEpisodes->fetch_all(MYSQLI_ASSOC);


    return $episodesBD;
}

function Locations(){

    global $conn;

    $query="SELECT * FROM Locations";

    $resultLocations= $conn->query($query);

    $locationsBD= $resultLocations->fetch_all(MYSQLI_ASSOC);


    return $locationsBD;

}

?>