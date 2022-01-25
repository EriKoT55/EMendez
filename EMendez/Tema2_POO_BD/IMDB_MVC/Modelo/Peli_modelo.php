<?php

require_once ("../A_Entidades/Pelicula.php");
require_once ("../A_EstructuraBD/bd.php");

class Peli_modelo
{

    private bd $bd;

    public function __construct(){

        $this->bd = new bd();

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

        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->close();

        $peliArray = $result->bd->fetch_all( MYSQLI_ASSOC );

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

}