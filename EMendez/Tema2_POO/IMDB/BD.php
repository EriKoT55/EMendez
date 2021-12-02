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



function Persona(){
global $conn;
//Sacar esto con Join, voy a necesitar unos cuantos hasta llegar al nombre de persona

    $sql="SELECT p.ID,p.Nombre,p.Apellidos,t.Nombre as Trabajo,p.Fecha_Nacimiento,p.Descripcion,p.IMG 
    FROM PersTrabj pt
    JOIN Trabajo t on t.ID=pt.TrabajoID 
    JOIN Persona p on p.ID=pt.PersonaID
    ORDER BY p.ID";

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
    ORDER BY pl.ID"; */

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
    //Utilizo la funcion anterior ya que dentro tengo ya introducido quien es actor
    //y quien director
    Persona();
    //Me falta meter en Peliculas un array de actores y otro de directores

//var_dump($peliculaBD);
}
//Pelicula();
?>