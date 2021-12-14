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

class BD extends mysqli
{
    /*Crear una nueva conexion en MYSQL*/
    private $servername = "sql480.main-hosting.eu";
    private $username = "u850300514_emendez";
    private $password = "x43233702G";
    private $database = "u850300514_emendez";

//Creo la conexion
    public function default()
    {
        $this->server();
    }

    public function server()
    {
        parent::__construct($this->servername, $this->username, $this->password, $this->database);
        // Me aseguro de si va bien la conexion
        if (mysqli_connect_error) {
            die("Conexion fallida: " . mysqli_connect_error());
        }
    }

/*                    OBJETOS                        */

    /*           Funciones para utilizar con Generos              */

    public function ObjGenero()
    {

        $sql = "SELECT * FROM Genero";
        $this->default();
        $result = $this->query($sql);
        $this->close();
        $generoArray = $result->fetch_all(MYSQLI_ASSOC);

        $objGenero = [];
        foreach ($generoArray as $gen) {
            $objGenero[] = new Genero($gen["GeneroID"], $gen["Nombre"]);
        }

        return $objGenero;
    }

    /*              Funciones para utilizar con Pelicula              */

// Datos generales de la pelicula
    public function ObjPelicula()
    {

        $sql = "SELECT * FROM Peliculas";
        $this->default();
        $result = $this->query($sql);
        $this->close();
        $peliculaArray = $result->fetch_all(MYSQLI_ASSOC);

        $objPelicula = [];

        foreach ($peliculaArray as $peli) {
            $objPelicula[] = new Pelicula($peli["PeliculaID"], $peli["Nombre"], $peli["IMG"], $peli["Trailer"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"]);
        }

        return $objPelicula;

    }

//Funcion la cual muestra los nombres de los generos por pelicula
    public function GenerosXpelicula($PeliculaID)
    {

        $sql = "SELECT g.Nombre as Genero FROM Genero g
              JOIN GenPeli gp on g.GeneroID=gp.GeneroID
              WHERE gp.PeliculaID=" . $PeliculaID . ";";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_generosXpelicula = $result->fetch_all(MYSQLI_ASSOC);

        $generos = [];
        for ($i = 0; $i < count($Arr_generosXpelicula); $i++) {
            $generos[] = $Arr_generosXpelicula[$i]["Genero"];
        }

        return $generos;
    }
//GenerosXpelicula(1);

//  /Funcion la cual me muestra los nombres de las personas por pelicula y trabajo/   -El nombre del trabajo debe ser Actor o Director-
    public function TrabajoXpelicula($PeliculaID, $NomTrabj)
    {

        $sql = "SELECT concat(prs.Nombre,' ',prs.Apellidos) as NombreCompleto FROM Persona prs
              JOIN PersPeli pp on pp.PersonaID=prs.PersonaID
              JOIN Peliculas pl on pl.PeliculaID=pp.PeliculaID
              WHERE pl.PeliculaID=" . $PeliculaID . " AND prs.Trabajo='" . $NomTrabj . "';";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_trabajoXpelicula = $result->fetch_all(MYSQLI_ASSOC);

        $trabajos = [];
        for ($i = 0; $i < count($Arr_trabajoXpelicula); $i++) {
            $trabajos[] = $Arr_trabajoXpelicula[$i]["NombreCompleto"];
        }

        return $trabajos;

    }

//TrabajoXpelicula(1,"Actor");
//TrabajoXpelicula(1,"Actor");


    /*           Funciones para utilizar con Persona              */
    /*Cuanto vaya introduciendo los datos en el bucle hare un setPeliculas y dentro de este metere la funcion*/

    public function ObjPersona()
    {

        $sql = "SELECT PersonaID,concat(Nombre,' ',Apellidos) as NombreCompleto,Trabajo,Fecha_Nacimiento,Descripcion,IMG 
            FROM Persona;";
        $this->default();
        $result = $this->query($sql);
        $this->close();
        $personaArray = $result->fetch_all(MYSQLI_ASSOC);

        $objPersona = [];
        foreach ($personaArray as $pers) {
            $objPersona[] = new Persona($pers["PersonaID"], $pers["NombreCompleto"], $pers["Trabajo"], $pers["Fecha_Nacimiento"], $pers["Descripcion"], $pers["IMG"]);
        }

        return $objPersona;
    }


    public function Nombre_peliXactor($PersonaID)
    {

        $sql = "SELECT pl.Nombre as Pelicula FROM Peliculas pl
              JOIN PersPeli pp on pp.PeliculaID=pl.PeliculaID
              JOIN Persona prs on prs.PersonaID=pp.PersonaID
              WHERE prs.PersonaID=" . $PersonaID . ";";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_nombre_peliXactor = $result->fetch_all(MYSQLI_ASSOC);

        $nomPelis = [];
        for ($i = 0; $i < count($Arr_nombre_peliXactor); $i++) {
            $nomPelis[] = $Arr_nombre_peliXactor[$i]["Pelicula"];
        }

        return $nomPelis;

    }

//Nombre_peliXactor(1));

/*                 Funciones para el FILTER                 */

    function RankingASC()
    {

        /**/

        $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Calificacion ASC;";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_rankAsc = $result->fetch_all(MYSQLI_ASSOC);

        $array_obj_peli = $this->ObjPelicula($Arr_rankAsc);
        $ArrFiltradoPeli = $this->BucleXAinsercionPelicla($array_obj_peli);

        return $ArrFiltradoPeli;
    }

    //De mayor a menor
    function RankingDESC()
    {


        $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Calificacion DESC;";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_rankDesc = $result->fetch_all(MYSQLI_ASSOC);

        $array_obj_peli = $this->ObjPelicula($Arr_rankDesc);
        $ArrFiltradoPeli = $this->BucleXAinsercionPelicla($array_obj_peli);

        return $ArrFiltradoPeli;
    }

    function mostrarPelisGenero($NomGen)
    {

        $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            JOIN GenPeli gp on gp.PeliculaID=pl.PeliculaID
            JOIN Genero g on g.GeneroID=gp.GeneroID
            WHERE g.Nombre='" . $NomGen . "'
            ORDER BY pl.PeliculaID;";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_pelisXgen = $result->fetch_all(MYSQLI_ASSOC);

        $array_obj_peli = $this->ObjPelicula($Arr_pelisXgen);
        $ArrFiltradoPeli = $this->BucleXAinsercionPelicla($array_obj_peli);

        return $ArrFiltradoPeli;
    }

    function Fecha_SalidaASC()
    {

        $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Fecha_Salida ASC;";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_fechAsc = $result->fetch_all(MYSQLI_ASSOC);

        $array_obj_peli = $this->ObjPelicula($Arr_fechAsc);
        $ArrFiltradoPeli = $this->BucleXAinsercionPelicla($array_obj_peli);

        return $ArrFiltradoPeli;
    }

    function Fecha_SalidaDESC()
    {


        $sql = "SELECT pl.PeliculaID,pl.Nombre,pl.IMG,pl.Trailer,pl.Duracion,pl.Fecha_Salida,pl.Calificacion,pl.Sinopsis FROM Peliculas pl
            ORDER BY pl.Fecha_Salida DESC;";

        $this->default();
        $result = $this->query($sql);
        $this->close();
        $Arr_fechDesc = $result->fetch_all(MYSQLI_ASSOC);

        $array_obj_peli = $this->ObjPelicula($Arr_fechDesc);
        $ArrFiltradoPeli = $this->BucleXAinsercionPelicla($array_obj_peli);

        return $ArrFiltradoPeli;
    }

/*          No preocuparse de la conversion de normal a classe ya hecho         */

//Insercion de datos "externos" al arrayObj Pelicula
    public function insertarApelicula(Pelicula $Pelicula)
    {
        $Pelicula->setGeneros($this->GenerosXpelicula($Pelicula->getPeliculaID()));
        $Pelicula->setActores($this->TrabajoXpelicula($Pelicula->getPeliculaID(), "Actor"));
        $Pelicula->setDirectores($this->TrabajoXpelicula($Pelicula->getPeliculaID(), "Director"));
    }

    public function BucleXAinsercionPelicla($ArrayObjPelicula)
    {
        for ($i = 0; $i < count($ArrayObjPelicula); $i++) {
            $this->insertarApelicula($ArrayObjPelicula[$i]);
        }
        return $ArrayObjPelicula;
    }

//$ArrObjPeli = BucleXAinsercionPelicla($ArrayObjPelicula);



//$ArrayObjPersona = ObjPersona($personaArray);

//Insercion de datos "externos" al arrayObj Persona
    public function insertarApersona(Persona $Persona)
    {
        $Persona->setPeliculas($this->Nombre_peliXactor($Persona->getPersonaID()));
    }

    public function BlucleXAinsercionPersona($ArrayObjPersona)
    {
        foreach ($ArrayObjPersona as $pers) {
           $this->insertarApersona($pers);
        }
        return $ArrayObjPersona;
    }

//$ArrObjPers = BlucleXAinsercionPersona($ArrayObjPersona);

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

