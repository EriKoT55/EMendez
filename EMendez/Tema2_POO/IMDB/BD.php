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

$sql="INSERT INTO Persona(ID,Nombre,Apellidos,Fecha_Nacimiento,Descripcion)
values(1,'Daniel','Craig','1968-03-02','One of the British theatres most famous faces, Daniel Craig, who waited tables as a struggling teenage actor with the National Youth Theatre, has gone on to star as James Bond in Casino Royale (2006), Quantum of Solace (2008), Skyfall (2012), Spectre (2015), and Sin tiempo para morir (2021).')";



    if ($conn->multi_query($sql) === TRUE) {
        echo "Se realizo correctamente";
    } else {
        echo "Error: " . $conn->error;
    }


?>