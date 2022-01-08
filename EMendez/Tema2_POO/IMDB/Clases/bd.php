<?php

include_once "Persona.php";
include_once "Pelicula.php";
include_once "Genero.php";
include_once "Multimedia.php";
include_once "Usuario.php";
include_once "Trabajo.php";

/*
  echo "<br>";
    echo "<pre>";
   var_dump($personaBD);
    echo "<br>";
*/

class bd extends mysqli
{
    /*Crear una nueva conexion en MYSQL*/
    //private $servername = "localhost";//sql480.main-hosting.eu //localhost
    //private $username = "root"; //u850300514_emendez //casa erikPhp // clase root
    //private $password = "Ageofempires2*";//x43233702G //Ageofempires2*
    //private $database = "imdb";//u850300514_emendez //imdb

    private $servername = "sql480.main-hosting.eu";//sql480.main-hosting.eu
    private $username = "u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
    private $password = "x43233702G";//x43233702G
    private $database = "u850300514_emendez";//RickMorthy_u850300514_emendez

    public function default()
    {
        $this->local();
    }


    public function local()
    {
        //Creo la conexion
        parent::__construct( $this->servername, $this->username, $this->password, $this->database );

        // Me aseguro de si va bien la conexion
        if( mysqli_connect_error() ) {
            die( "Conexion fallida: " . mysqli_connect_error() );
        }
    }

    /**
     * @return array
     */
    public function Generos(){
        $sql="SELECT * FROM Genero;";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $arrGeneros=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayGen=[];

        foreach($arrGeneros as $gen){
            $objArrayGen[]=new Genero($gen["GeneroID"],$gen["Nombre"]);
        }

        return $objArrayGen;

    }

    /**
     * @param $PersonaID
     * @return array
     *
     */
    public function cogerTrabajo( $PersonaID )
    {

        $sql = "SELECT t.* FROM Persona p 
            JOIN TrabjPers tp on tp.PersonaID=p.PersonaID 
            JOIN Trabajo t on t.TrabajoID=tp.TrabajoID WHERE p.PersonaID=" . $PersonaID . ";";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $trabjArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayTrabj = [];

        foreach( $trabjArray as $trabj ) {
            $objArrayTrabj[] = new Trabajo( $trabj["TrabajoID"], $trabj["Nom_trabajo"] );
        }

        return $objArrayTrabj;

    }

    /**
     * @param $PersonaID
     * @return array|mixed
     */
    public function cogerPeliXpers( $PersonaID )
    {

        $sql = "SELECT pl.Nombre as Pelicula FROM Peliculas pl
              JOIN PersPeli pp on pp.PeliculaID=pl.PeliculaID
              WHERE pp.PersonaID=" . $PersonaID . ";";

        $this->default();
        $result = $this->query( $sql );
        $this->close();
        $peliXpersArray = $result->fetch_all( MYSQLI_ASSOC );

        //No puedo devolver un array de obj ya que el nombre de la pelicula por si solo no es obj

        return $peliXpersArray;

    }

    /**
     * @param $PersonaID
     * @return array
     */
    public function cogerPersona( $PersonaID )
    {

        $sql = "SELECT * FROM Persona p WHERE PersonaID=" . $PersonaID . ";";
        $this->default();
        $result = $this->query( $sql );
        $this->close();
        $persArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPers = [];

        foreach( $persArray as $pers ) {

            $newPers = new Persona( $pers["PersonaID"], $pers["NombreCompleto"], $pers["Fecha_Nacimiento"], $pers["Descripcion"], $pers["IMG"] );
            $newPers->setPeliculas( $this->cogerPeliXpers( $pers["PersonaID"] ) );
            $newPers->setTrabajo( $this->cogerTrabajo( $pers["PersonaID"] ) );
            $objArrayPers[] = $newPers;
            //Cuando hago un var_dump de esto no me muestra ni Peliculas ni Trabajos, pero estan.
        }
        return $objArrayPers;
    }

    /**
     * @return array
     */
    public function cogerPersonas()
    {


        $sql = "SELECT * FROM Persona p;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $perssArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPerss = [];

        foreach( $perssArray as $perss ) {
            //Con el debugger me muestra todo correctamente asi que tira
            // con json_encode me muestra todo menos el trabajo, pero esta
            $newPerss = new Persona( $perss["PersonaID"], $perss["NombreCompleto"], $perss["Fecha_Nacimiento"], $perss["Descripcion"], $perss["IMG"] );
            $newPerss->setPeliculas( $this->cogerPeliXpers( $perss["PersonaID"] ) );
            $newPerss->setTrabajo( $this->cogerTrabajo( $perss["PersonaID"] ) );
            $objArrayPerss[] = $newPerss;
        }
        return $objArrayPerss;
    }

    /** ##########  HACER UN cogerPersonas y cogerPersona  #############
     * con estas consultas de JSON_ARRAYAGG Y JSON_OBJECT para poder hacer una pagina Personas
     */

    /********************* DEVUELVE LA INFORMACION DE TODAS LAS PELICULAS
     * @return array
     * Devuelve toda la informacion de las peliculas
     * Se utiliza el JSON_ARRAYAGG Y JSON_OBJECT para poder relizar las consultas dentro de consultas y
     * así reducir el tiempo de carga
     */
    public function cogerPeliculas()
    {

        $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Genero', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID ;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }


        /* CUANDO RECOJO LAS URL's DE LAS IMG DE DEVUELVE CADA PELICULA CON TODAS LAS URL's DE CADA PELICULA, y solo quiero
            la img de la pelicula correspondiente
               $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis ,
                               (SELECT JSON_ARRAYAGG(
                                   JSON_OBJECT(
                                       'nomPers', prs.NombreCompleto
                                   )
                               ) FROM Persona prs JOIN PersPeli pp on prs.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID JOIN TrabjPers tp on tp.PersonaID = prs.PersonaID WHERE tp.TrabajoID = 2) AS actores,
                               (SELECT JSON_ARRAYAGG(
                                   JSON_OBJECT(
                                       'nomPers', prs.NombreCompleto
                                   )
                               ) FROM Persona prs JOIN PersPeli pp on prs.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = prs.PersonaID WHERE tp.TrabajoID = 1) AS directores,
                               (SELECT JSON_ARRAYAGG(
                                   JSON_OBJECT(
                                       'generos', g.Nombre
                                   )
                               ) FROM Genero g JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID) AS generos,
                               (SELECT JSON_ARRAYAGG(
                                   JSON_OBJECT(
                                      'img', m.img_url
                                   )
                                  ME DEVUELVE UN ARRAY DE TODAS LAS IMAGENES EN CADA PELICULA
                               )FROM Multimedia m JOIN Peliculas p on m.PeliculaID = p.PeliculaID WHERE m.) AS img,
                               m.trailer_url as trailer
                               FROM Peliculas p
                               JOIN Multimedia m on p.PeliculaID = m.PeliculaID";

                       $this->default();
                       $result=$this->query($sql);
                       $this->close();

                       $peliArray=$result->fetch_all(MYSQLI_ASSOC);

                       $objArrayPeli=[];
                       foreach ($peliArray as $peli){
                           //el debugger me muestra todo, mientras que con el json_encode no me da nada
                           $newPeli=new Pelicula($peli["PeliculaID"],$peli["Nombre"],$peli["Duracion"],$peli["Fecha_Salida"],$peli["Calificacion"],$peli["Sinopsis"]);
                           $newPeli->setIMG(json_decode($peli["img"],true));
                           $newPeli->setTrailer($peli["trailer"]);
                           $newPeli->setGeneros(json_decode($peli["generos"],true));
                           $newPeli->setActores(json_decode($peli["actores"],true));
                           $newPeli->setDirectores(json_decode($peli["directores"],true));
                           $objArrayPeli[]=$newPeli;
                       }
       */


        return $objArrayPeli;
    }

    /***************************** DEVUELVE TODA LA INFO DE LA PELICULA INTRODUCIDA POR PARAMETRO
     * @param $PeliculaID
     * @return array
     * Devuelve toda la informacion de la pelicula pasandole el PeliculaID
     * Se utiliza el JSON_ARRAYAGG Y JSON_OBJECT para poder relizar las consultas dentro de consultas y
     * así reducir el tiempo de carga
     */
    public function cogerPelicula( $PeliculaID )
    {
        $sql = "SELECT p.PeliculaID,p.Nombre,p.Duracion,p.Fecha_Salida,p.Calificacion,p.Sinopsis, 
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE pp.PeliculaID = " . $PeliculaID . " AND tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE pp.PeliculaID = " . $PeliculaID . " AND tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Generos', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID WHERE gp.PeliculaID = " . $PeliculaID . ") AS Generos,
               (SELECT JSON_ARRAYAGG(
                            JSON_OBJECT(
                               'IMG', m.img_url
                            )
                        )FROM Multimedia m JOIN Peliculas p on m.PeliculaID = p.PeliculaID WHERE m.PeliculaID=" . $PeliculaID . ") AS IMG,
                m.trailer_url 
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID
                WHERE p.PeliculaID = " . $PeliculaID.";";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {

            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            // SI HAY DOS IMG PARA UNA PELI EN EL VAR_DUMP EN pruebasClass me saca dos veces toda la informacion de la peli en vez de
            // DARME UNA PELICULA CON UN ARRAY DE IMGS DE DOS imagenes
            $newPeli->setIMG( json_decode( $peli["IMG"], true ) );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Generos"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

 /******************************* FILTRADO DE PELICULAS *******************************/

    /********** DE PEOR VALORADA A MEJOR
     * @return array
     */
    function RankingASC()
    {

        $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Genero', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID
                ORDER BY p.Calificacion ASC ;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

    /************ DE MEJOR VALORADA A PEOR
     * @return array
     */
    function RankingDESC()
    {
        $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Genero', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID
                ORDER BY p.Calificacion DESC ;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

    /******** MUESTRA LAS PELICULAS QUE TIENEN EL GENERO SELECCIONADO
     * @param $NomGen
     * @return mixed
     * no se como hacer el WHERE para el genero que seleccione en la consulta general,
     * PODRIA METERLO EN LA CONSULTA DEL GENERO PERO ME DEVUELVE TODAS LAS PELICULAS Y LAS QUE NO TIENEN EL GENERO
     * DEVUELVE NULL, con esto podria hacer un if o algo
     */
    function mostrarPelisGenero($NomGen)
    {

        $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Genero', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID ) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

    /********* DE MAS ANTIGUAS A MAS NUEVAS
     * @return array
     */
    function Fecha_SalidaASC()
    {

        $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Genero', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID ) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID
                ORDER BY Fecha_Salida ASC;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

    /************ DE MAS NUEVAS A MAS ANTIGUAS
     * @return array
     */
    function Fecha_SalidaDESC()
    {
        $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Actores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS Actores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Directores', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS Directores,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'Genero', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID ) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID
                ORDER BY Fecha_Salida DESC;";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

    /*************************************** COMPRUEBA SI EXISTE EL USUARIO EN LA BD
     * @param $nomUsr
     * @param $correo
     * @param $contra
     * @return bool
    Funcion la cual comprueba en la base de datos si estan los datos con los que intentan iniciar sesion
    Devuelve TRUE si es correcta la información combrobada, FALSE si da error en alguna de las comprobaciones:
     NOM_USUARIO, CORREO, CONTRASENYA
     */
    public function existUsr( $nomUsr, $correo, $contra ): bool
    {

        $sql = "SELECT UsuarioID,NomUsuario,Correo,Contrasenya FROM Usuarios WHERE NomUsuario LIKE '" . $nomUsr . "' AND Correo= '" . $correo . "' ";

        $this->default();
        $result = $this->query( $sql );
        $this->close();

        $arrUsr = $result->fetch_all( MYSQLI_ASSOC );

        // VERIFICA SI LA CONTRASEÑA INTRODUCIDA ESTA EN LA BD
        // DEVUELVE UN BOOLEANO
        $passVerify = password_verify( $contra,$arrUsr[0]["Contrasenya"] );

        if( $nomUsr==$arrUsr[0]["NomUsuario"] && $correo==$arrUsr[0]["Correo"] ) {
            if( $passVerify==true ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /***************************** INSERTA USUARIO A LA BD
     * @param $nomUsr
     * @param $correo
     * @param $contra
     * @return bool
    Funcion la cual inserta datos en BD, TABLA Usuarios.
    Si se inserto TRUE si no FALSE.
     # #### APUNTE :
     # Se cambiara por mas datos,
     # al unir Usuario con Persona, entrara: nombre, fechaNacimiento, descripcion, IMG.
     */
    public function insertUsr( $nomUsr, $correo, $contra ): bool
    {
        //Con real_escape_string nos permite utilizar caracteres especiales para consultas sql
        $nomUsr = $this->real_escape_string( $nomUsr );
        $correo = $this->real_escape_string( $correo );

        $sql = "INSERT INTO Usuarios(NomUsuario,Correo,Contrasenya) VALUES('" . $nomUsr . "','" . $correo . "','" . $contra . "')";

        $this->default();

        if( $this->query( $sql )==true ) {
            return true;
        }else {
            return false;
        }
        $this->close();
    }

    /************************ INSERTA COMENTARIO A LA BD
     * CON LOS VALORES INTRODUCIDOS:
     * @param $Comentario * TEXTO
     * @param $PeliculaID * SABER A QUE PELI SE LE HACE EL COMENTARIO
     * @param $UsuarioID * SABER QUE USUARIO REALIZO EL COMENTARIO
     */
    public function insertComent($Comentario,$PeliculaID,$UsuarioID): bool
    {

        $sql="INSERT INTO Comentarios(Comentario,PeliculaID,UsuarioID) VALUES ('".$Comentario."',".$PeliculaID.",".$UsuarioID.")";
        $this->default();
        if($this->query( $sql )==true){
            return true;
        }else{
            return false;
        }
        $this->close();

    }

}