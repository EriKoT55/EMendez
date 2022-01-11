<?php

$servername="sql480.main-hosting.eu";
$username="u850300514_emendez";
$password="x43233702G";
$bdname="u850300514_emendez";

$conn= new mysqli($servername,$username,$password,$bdname);

if($conn->connect_error){
    echo "Error al realizar la conexion". $conn->connect_error;
}
echo "Conexion realizada";
/*
    echo "<br>";
    echo "<pre>";
    echo  var_dump($partidosBD);
    echo "<br>";
*/
function Partidos(){
    global $conn;

    $sql="SELECT * FROM Partidos";

    $result=$conn->query($sql);

    $partidosBD=$result->fetch_all(MYSQLI_ASSOC);

    return $partidosBD;
}

function Provincias(){
    global $conn;
    $provinciasBD=[];
    $sql="SELECT * FROM Provincias";

    $result=$conn->query($sql);

    for($i=0;$fila=$result->fetch_assoc();$i++){

        $provinciasBD[$i]["id"]=$fila["id"];
        $provinciasBD[$i]["name"]=$fila["name"];
        $provinciasBD[$i]["delegates"]=$fila["delegates"];

    }

    return $provinciasBD;

}

function Resultados(){
    global $conn;

    $sql="SELECT * FROM Resultados";

    $result=$conn->query($sql);

    $resultadosBD=$result->fetch_all(MYSQLI_ASSOC);

return $resultadosBD;
}

?>