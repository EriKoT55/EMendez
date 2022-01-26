<?php
require_once ("../A_Entidades/Pelicula.php");
require_once ("../A_Entidades/Genero.php");
require_once ("../A_EstructuraBD/bd.php");

class Main_modelo
{

    private bd $bd;

    public function __construct(){

        $this->bd=new bd();

    }

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
                 (SELECT JSON_ARRAYAGG(
					JSON_OBJECT(
						'img', m.img_url
					)
				)FROM Multimedia m JOIN Peliculas p1 on m.PeliculaID = p1.PeliculaID WHERE p1.PeliculaID=p.PeliculaID) AS img, 
				m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID ;";

        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

        $peliArray = $result->fetch_all( MYSQLI_ASSOC );

        $objArrayPeli = [];
        foreach( $peliArray as $peli ) {
            $newPeli = new Pelicula( $peli["PeliculaID"], $peli["Nombre"], $peli["Duracion"], $peli["Fecha_Salida"], $peli["Calificacion"], $peli["Sinopsis"] );
            $newPeli->setIMG(json_decode($peli["img"],true));
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArrayPeli[] = $newPeli;
        }

        return $objArrayPeli;
    }

    public function Generos(){
        $sql="SELECT * FROM Genero;";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrGeneros=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayGen=[];

        foreach($arrGeneros as $gen){
            $objArrayGen[]=new Genero($gen["GeneroID"],$gen["Nombre"]);
        }

        return $objArrayGen;

    }

    /****************************** BUSCADOR *******************************************/

    /** BUSCA LA PELICULA POR EL NOMBRE, CREA EL OBJ Y DEVUELE  LA PELICULA CORRESPONDIENTE
     * @param $nom
     * @return array
     */
    public function busq_pelXnom($nom){

        $sql="SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis,
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
                WHERE p.Nombre like '%".$nom."%';";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->close();

        $array_pelXnom=$result->fetch_all(MYSQLI_ASSOC);

        $objArr_pelXnom=[];

        foreach($array_pelXnom as $peli){
            $newPeli=new Pelicula($peli["PeliculaID"],$peli["Nombre"],$peli["Duracion"],$peli["Fecha_Salida"],$peli["Calificacion"],$peli["Sinopsis"]);
            $newPeli->setIMG( $peli["img_url"] );
            $newPeli->setTrailer( $peli["trailer_url"] );
            $newPeli->setGeneros( json_decode( $peli["Genero"], true ) );
            $newPeli->setActores( json_decode( $peli["Actores"], true ) );
            $newPeli->setDirectores( json_decode( $peli["Directores"], true ) );
            $objArr_pelXnom[] = $newPeli;
        }

        return $objArr_pelXnom;

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

        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

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

        $this->bd->default();
        $result = $this->bd->query( $sql );
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
    #### NO CONSIGO HACERLO #####
    no se como hacer el WHERE para el genero que seleccione en la consulta general,
    PODRIA METERLO EN LA CONSULTA DEL GENERO PERO ME DEVUELVE TODAS LAS PELICULAS Y LAS QUE NO TIENEN EL GENERO
    DEVUELVE NULL, con esto podria hacer un if o algo
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
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID WHERE g.Nombre='".$NomGen."' ) AS Genero,
                m.img_url, m.trailer_url
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID ;";
        /** ESTA SQL ME DEVOLVERA TODAS LAS PELICULAS Y LAS QUE NO TIENEN ESE GENERO TENDRAN NULL, FILTRARLAS EJ: if($pelis->getGeneros == null ) **/
        /** ### es otra idea ###
         * PODRIA HACER UN JOIN PARA COGER LOS GENEROS, PROBAAAR *
         */
        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

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

        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

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

        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

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

}