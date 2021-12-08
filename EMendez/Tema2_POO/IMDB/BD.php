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
/*Quiero que las peliculas sean un array que tenga las peliculas en las que ha salido cada persona*/
        $sql="SELECT PersonaID,concat(Nombre,' ',Apellidos) as Nombre,Trabajo,Fecha_Nacimiento,Descripcion,IMG 
            FROM Persona WHERE PersonaID=".$PersonaID;

        $result=$conn->query($sql);

        $personaBD=$result->fetch_all(MYSQLI_ASSOC);

        return $personaBD;
    }

    public function Pelicula(){

        global $conn;

        $sql="SELECT pl.PeliculaID,pl.Nombre,pl.Duracion,pl.Calificacion,pl.IMG,pl.Trailer,pl.Fecha_Salida,g.Nombre as Genero,pl.Sinopsis
        FROM  Pelicula pl 
        JOIN GenPeli gp on gp.PeliculaID=pl.PeliculaID
        JOIN Genero g on g.GeneroID=gp.GeneroID";

        $result=$conn->query($sql);

        $peliculaBD=$result->fetch_all(MYSQLI_ASSOC);

        echo "<br>";
        echo "<pre>";
        var_dump($peliculaBD);
        echo "<br>";

    }

}
