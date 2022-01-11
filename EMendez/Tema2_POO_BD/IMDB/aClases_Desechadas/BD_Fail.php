<?php

/*
  echo "<br>";
    echo "<pre>";
   var_dump($personaBD);
    echo "<br>";
*/

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



function Persona(){
global $conn;

    $sql="SELECT PersonaID,concat(Nombre,' ',Apellidos) as Nombre,Trabajo,Fecha_Nacimiento,Descripcion,IMG FROM Persona ";

   $result=$conn->query($sql);

   $personaBD=$result->fetch_all(MYSQLI_ASSOC);

   return $personaBD;
}

function Pelicula(){
    global $conn;

    /*  Me muestra la peli repetida por cada genero
        Si la peli tiene 3 generos me muestra la peli 3 veces

      $sql="SELECT pl.ID,pl.Nombre,pl.Duracion,pl.Calificacion,pl.IMG,pl.Trailer,pl.Fecha_Salida,pl.Sinopsis,g.Nombre as Genero
        FROM GenPeli gp
        JOIN Genero g on g.GeneroID=gp.GeneroID
        JOIN Peliculas pl on pl.ID=gp.PeliculaID
        ORDER BY pl.ID";
    */

    $sql="SELECT * FROM Peliculas";
    $result = $conn->query($sql);

    $peliculaBD=$result->fetch_all(MYSQLI_ASSOC);

    $sql="SELECT g.Nombre,gp.PeliculaID 
    FROM GenPeli gp
    JOIN Genero g on g.GeneroID=gp.GeneroID";

    $result=$conn->query($sql);

    $generosBD=$result->fetch_all(MYSQLI_ASSOC);

    for($i=0;$i<count($generosBD);$i++){
        for($k=0;$k<count($peliculaBD);$k++){
            if($generosBD[$i]["PeliculaID"]==$peliculaBD[$k]["ID"]){
                $peliculaBD[$k]["Generos"][]=$generosBD[$i]["Nombre"];
            }
        }
    }

    /*$sql="SELECT pl.ID,,t.Nombre as Trabajo,p.Nombre as Trabajador
   FROM Peliculas pl
   JOIN TrabjPeli tp on tp.PeliculaID=pl.ID
   JOIN Trabajo t on t.ID=tp.TrabajoID
   JOIN PersTrabj pt on pt.TrabajoID=t.ID
   JOIN Persona p on p.ID=pt.PersonaID
   ORDER BY pl.ID";*/

    //Utilizo la funcion anterior ya que dentro tengo ya introducido quien es actor
    //y quien director, pero me falta el id pelicula para poder relacionarlas
    //$personaBD=Persona();
    //Me falta meter en Peliculas un array de actores y otro de directores
    // if personaBD[$i]["Trabajo"]== "Actor" lo meto en un array actores
    //else if personaBD[$i]["Trabajo"]== "Director" lo meto en un array directores


$peliculaBD;
}

?>