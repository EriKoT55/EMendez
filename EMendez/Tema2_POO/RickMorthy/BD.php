<?php
/*Crear una nueva conexion en MYSQL, CASA*/
$servername="sql480.main-hosting.eu";
$username="u850300514_emendez"; //casa erikPhp // clase root
$password="x43233702G";
$dbname="u850300514_emendez";

//Creo la conexion
$conn = new mysqli($servername,$username,$password,$dbname);

// Me aseguro de si va bien la conexion
if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}
function Characters(){
        global $conn;


}


?>