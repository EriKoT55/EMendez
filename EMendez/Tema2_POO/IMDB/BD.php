<?php
include_once "Persona.php";
include_once "Pelicula.php";
include_once "Genero.php";
/*
  echo "<br>";
    echo "<pre>";
   var_dump($personaBD);
    echo "<br>";
*/

/*Crear una nueva conexion en MYSQL*/
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
class BD
{

    public function Persona(){
        global $conn;

        $sql="SELECT PersonaID,concat(Nombre,' ',Apellidos) as Nombre,Trabajo,Fecha_Nacimiento,Descripcion,IMG 
            FROM Persona ";

        $result=$conn->query($sql);

        $personaBD=$result->fetch_all(MYSQLI_ASSOC);

        return $personaBD;
    }

}