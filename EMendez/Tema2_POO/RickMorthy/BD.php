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

    $query="SELECT * FROM Characters";

    $resultCharacter= $conn->query($query);

    $characterBD= $resultCharacter->fetch_all(MYSQLI_ASSOC);

    /*Meter los eps en la tabla, con fetch_assoc*/
    //Con dos bucles y un filtro
    /*https://www.php.net/manual/es/mysqli-result.fetch-assoc.php*/
    $query="SELECT * FROM EpsChars";

    $resultEpsChars= $conn->query($query);

    for($i=0;$fila=$resultEpsChars->fetch_assoc();$i++){
        for($j=0;$j<count($characterBD);$j++){
            if($fila["idChars"]==$characterBD[$j]["id"]){
                $characterBD[$j]["episodes"][]=$fila["idEps"];
            }
        }
    }

    return $characterBD;
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