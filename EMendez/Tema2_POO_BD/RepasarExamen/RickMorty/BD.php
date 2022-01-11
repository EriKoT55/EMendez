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

    $result=$conn->query($sql);

    $characterBD=$result->fetch_all(MYSQLI_ASSOC);

    $sql="SELECT * FROM EpsChars";
    $result=$conn->query($sql);

    for($j=0;$fila=$result->fetch_assoc();$j++){
        for($i=0;$i<count($characterBD);$i++){
            if($characterBD[$i]["id"]==$fila["idChars"]){
                $characterBD[$i]["episodes"][]=$fila["idEps"];
            }
        }
    }

   return $characterBD;
}

function Episodes(){
    global $conn;

    $sql="SELECT * FROM Episodes";

    $result=$conn->query($sql);

    $episodesBD=$result->fetch_all(MYSQLI_ASSOC);



    return $episodesBD;
}

function Locations(){
    global $conn;

    $sql="SELECT * FROM Locations";

    $result=$conn->query($sql);

    $locationsBD=$result->fetch_all(MYSQLI_ASSOC);

    return $locationsBD;
}

?>