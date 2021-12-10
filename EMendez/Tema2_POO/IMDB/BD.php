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
/*Funciones para utilizar con Persona*/
/*Cuanto vaya introduciendo los datos en el bucle hare un setPeliculas y dentro de este metere la funcion*/

    function Nombre_peliXactor($PersonaID){
        global $conn;

        $sql="SELECT pl.Nombre as Pelicula FROM Peliculas pl
              JOIN PersPeli pp on pp.PeliculaID=pl.PeliculaID
              JOIN Persona prs on prs.PersonaID=pp.PersonaID
              WHERE prs.PersonaID=".$PersonaID.";";

        $result=$conn->query($sql);
        $nombre_peliXactor=$result->fetch_all(MYSQLI_ASSOC);

        $nomPelis=[];
        for($i=0;$i<count($nombre_peliXactor);$i++){
            $nomPelis[]=$nombre_peliXactor[$i]["Pelicula"];
        }

        return $nomPelis;
//No probado por prisas
    }
    function ObjPersona(){

        global $conn;

        $sql="SELECT PersonaID,concat(Nombre,' ',Apellidos) as NombreCompleto,Trabajo,Fecha_Nacimiento,Descripcion,IMG 
            FROM Persona;";

        $result=$conn->query($sql);
        $personaBD=$result->fetch_all(MYSQLI_ASSOC);

        $objPersona=[];
        foreach ($personaBD as $pers){
            $objPersona[]= new Persona($pers["PersonaID"],$pers["NombreCompleto"],$pers["Trabajo"],$pers["Fecha_Nacimiento"],$pers["Descripcion"],$pers["IMG"]);
        }

        return $objPersona;
    }

/*              Funciones para utilizar con Pelicula              */

//Funcion la cual muestra los nombres de los generos por pelicula
    function GenerosXpelicula($PeliculaID){
        global $conn;

        $sql="SELECT g.Nombre as Genero FROM Genero g
              JOIN GenPeli gp on g.GeneroID=gp.GeneroID
              WHERE gp.PeliculaID=".$PeliculaID.";";

        $result=$conn->query($sql);
        $generosXpelicula=$result->fetch_all(MYSQLI_ASSOC);

        $generos=[];
            for($i=0;$i<count($generosXpelicula);$i++){
                $generos[]=$generosXpelicula[$i]["Genero"];
            }

        return $generos;
    }
//GenerosXpelicula(1);

//  /Funcion la cual me muestra los nombres de las personas por pelicula y trabajo/   -El nombre del trabajo debe ser Actor o Director-
    function TrabajoXpelicula($PeliculaID,$NomTrabj){
        global $conn;

        $sql="SELECT concat(prs.Nombre,' ',prs.Apellidos) as NombreCompleto FROM Persona prs
              JOIN PersPeli pp on pp.PersonaID=prs.PersonaID
              JOIN Peliculas pl on pl.PeliculaID=pp.PeliculaID
              WHERE pl.PeliculaID=".$PeliculaID." AND prs.Trabajo='".$NomTrabj."';";

        $result=$conn->query($sql);
        $trabajoXpelicula=$result->fetch_all(MYSQLI_ASSOC);

        $trabajos=[];
        for($i=0;$i<count($trabajoXpelicula);$i++){
            $trabajos[]=$trabajoXpelicula[$i]["NombreCompleto"];
        }
        return $trabajos;
    }
//TrabajoXpelicula(1,"Actor");
//TrabajoXpelicula(1,"Actor");
    // Datos generales de la pelicula
    function ObjPelicula(){
        global $conn;

        $sql="SELECT * FROM Peliculas";

        $result=$conn->query($sql);

        $peliculaBD=$result->fetch_all(MYSQLI_ASSOC);

        $objPelicula=[];

        foreach ($peliculaBD as $peli){
            $objPelicula[]= new Pelicula($peli["PeliculaID"],$peli["Nombre"],$peli["IMG"],$peli["Trailer"],$peli["Duracion"],$peli["Fecha_Salida"],$peli["Calificacion"],$peli["Sinopsis"]);
        }

        //return $objPelicula->setNombre();
        return $objPelicula;

    }
$ObjPelicula=ObjPelicula();
    //Insercion de datos "externos" al arrayObj Pelicula
    function insertar(Pelicula $Pelicula){
        $Pelicula->setGeneros(GenerosXpelicula($Pelicula->getPeliculaID()));
        $Pelicula->setActores(TrabajoXpelicula($Pelicula->getPeliculaID(),"Actor"));
        $Pelicula->setDirectores(TrabajoXpelicula($Pelicula->getPeliculaID(),"Director"));
    }

    for ($i = 0; $i < count($ObjPelicula); $i++) {
        insertar($ObjPelicula[$i]);
    }
/*    Funciones desechadas, dejadas por si en algun caso sean necesarias o sirvan de guia para algun trabajo futuro

    function Persona($PersonaID){
        global $conn;
Quiero que las peliculas sean un array que tenga las peliculas en las que ha salido cada persona
        $sql="SELECT PersonaID,concat(Nombre,' ',Apellidos) as Nombre,Trabajo,Fecha_Nacimiento,Descripcion,IMG
            FROM Persona WHERE PersonaID=".$PersonaID.";";

        $result=$conn->query($sql);

        $personaBD=$result->fetch_all(MYSQLI_ASSOC);

        return $personaBD;
    }

    function Pelicula(){

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
*/

