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

    private $servername="sql480.main-hosting.eu";//sql480.main-hosting.eu
    private $username="u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
    private $password="x43233702G";//x43233702G
    private $database="u850300514_emendez";//RickMorthy_u850300514_emendez

    public function default()
    {
        $this->local();
    }

    public function local()
    {
        //Creo la conexion
        parent::__construct($this->servername, $this->username, $this->password, $this->database);

        // Me aseguro de si va bien la conexion
        if (mysqli_connect_error()) {
            die("Conexion fallida: " . mysqli_connect_error());
        }
    }


    /**
     * public function cogerUsuario(){
     *
    }*/

    /**
     * @param $PersonaID
     * @return array
     *
     */
    public function cogerTrabajo($PersonaID){

        $sql="SELECT t.* FROM Persona p 
            JOIN TrabjPers tp on tp.PersonaID=p.PersonaID 
            JOIN Trabajo t on t.TrabajoID=tp.TrabajoID WHERE p.PersonaID=".$PersonaID.";";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $trabjArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayTrabj=[];

        foreach ($trabjArray as $trabj){
            $objArrayTrabj[]=new Trabajo($trabj["TrabajoID"],$trabj["Nom_trabajo"]);
        }

        return $objArrayTrabj;

    }

    /**
     * @param $PeliculaID
     * @param $NomTrabajo
     * @return mixed
     */
    public function cogerNomPersXtrabj($PeliculaID,$NomTrabajo){

        $sql="SELECT prs.NombreCompleto FROM Trabajo t
                JOIN TrabjPers tp on tp.TrabajoID=t.TrabajoID
                JOIN Persona prs on prs.PersonaID=tp.PersonaID
                JOIN PersPeli pp on pp.PersonaID=prs.PersonaID
                JOIN Peliculas pl on pl.PeliculaID=pp.PeliculaID
                WHERE pl.PeliculaID=".$PeliculaID." AND t.Nom_trabajo='".$NomTrabajo."';";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        //No puedo devolver un array de obj ya que el nombre de la persona por si solo no es obj
        $nomTrabjArray=$result->fetch_all(MYSQLI_ASSOC);

        return $nomTrabjArray;

    }

    /**
     * @param $PersonaID
     * @return array|mixed
     */
    public function cogerPeliXpers($PersonaID){

        $sql="SELECT pl.Nombre as Pelicula FROM Peliculas pl
              JOIN PersPeli pp on pp.PeliculaID=pl.PeliculaID
              WHERE pp.PersonaID=".$PersonaID.";";

        $this->default();
        $result=$this->query($sql);
        $this->close();
        $peliXpersArray=$result->fetch_all(MYSQLI_ASSOC);

        //No puedo devolver un array de obj ya que el nombre de la pelicula por si solo no es obj

        return $peliXpersArray;

    }

    /**
     * @param $PersonaID
     * @return array
     */
    public function cogerPersona($PersonaID){

        $sql="SELECT * FROM Persona p WHERE PersonaID=".$PersonaID.";";
        $this->default();
        $result=$this->query($sql);
        $this->close();
        $persArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPers=[];

        foreach ($persArray as $pers){
//Mirar
            $newPers=new Persona($pers["PersonaID"],$pers["NombreCompleto"],$pers["Fecha_Nacimiento"],$pers["Descripcion"],$pers["IMG"]);
            $newPers->setPeliculas($this->cogerPeliXpers($pers["PersonaID"]));
            $newPers->setTrabajo($this->cogerTrabajo($pers["PersonaID"]));
            $objArrayPers[]=$newPers;
        //Cuando hago un var_dump de esto no me muestra ni Peliculas ni Trabajos, pero estan.
        }
        return $objArrayPers;
    }

    /**
     * @return array
     */
    public function cogerPersonas(){


        $sql="SELECT * FROM Persona p;";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $perssArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPerss=[];

        foreach($perssArray as $perss){
        //Con el debugger me muestra todo correctamente asi que tira
        // con json_encode me muestra todo menos el trabajo, pero esta
            $newPerss=new Persona($perss["PersonaID"],$perss["NombreCompleto"],$perss["Fecha_Nacimiento"],$perss["Descripcion"],$perss["IMG"]);
            $newPerss->setPeliculas($this->cogerPeliXpers($perss["PersonaID"]));
            $newPerss->setTrabajo($this->cogerTrabajo($perss["PersonaID"]));
            $objArrayPerss[]=$newPerss;
        }
        return $objArrayPerss;
    }


    public function cogerPeliculas(){
        $sql = "SELECT p.PeliculaID as movieId, p.Nombre as movieName, p.Duracion as movieDuration, p.Fecha_Salida as movieRelease, p.Calificacion as movieRank, p.Sinopsis as movieSynopsis,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'personName', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 2) AS movieActors,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'personName', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID AND pp.PeliculaID = p.PeliculaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE tp.TrabajoID = 1) AS movieDirectors,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'genderName', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID AND gp.PeliculaID = p.PeliculaID) AS movieGenders,
                m.img_url as movieImage, m.trailer_url as movieTrailer
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $peliArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPeli=[];
        foreach ($peliArray as $peli){
            //el debugger me muestra todo, mientras que con el json_encode no me da nada
            $newPeli=new Pelicula($peli["movieId"],$peli["movieName"],$peli["movieDuration"],$peli["movieRelease"],$peli["movieRank"],$peli["movieSynopsis"]);
            $newPeli->setIMG($peli["movieImage"]);
            $newPeli->setTrailer($peli["movieTrailer"]);
            $newPeli->setGeneros(json_decode($peli["movieGenders"],true));
            $newPeli->setActores(json_decode($peli["movieActors"],true));
            $newPeli->setDirectores(json_decode($peli["movieDirectors"],true));
            $objArrayPeli[]=$newPeli;
        }



 /*          $sql = "SELECT p.PeliculaID , p.Nombre , p.Duracion , p.Fecha_Salida , p.Calificacion , p.Sinopsis ,
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

    public function cogerPelicula($movieId){
        $sql = "SELECT p.PeliculaID as movieId, p.Nombre as movieName, p.Duracion as movieDuration, p.Fecha_Salida as movieRelease, p.Calificacion as movieRank, p.Sinopsis as movieSynopsis, 
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'personName', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE pp.PeliculaID = ".$movieId." AND tp.TrabajoID = 2) AS movieActors,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'personName', psn.NombreCompleto
                	)
                ) FROM Persona psn INNER JOIN PersPeli pp on psn.PersonaID = pp.PersonaID INNER JOIN TrabjPers tp on tp.PersonaID = psn.PersonaID WHERE pp.PeliculaID = ".$movieId." AND tp.TrabajoID = 1) AS movieDirectors,
                (SELECT JSON_ARRAYAGG(
                	JSON_OBJECT(
                		'genderName', g.Nombre
                	)
                ) FROM Genero g INNER JOIN GenPeli gp on gp.GeneroID = g.GeneroID WHERE gp.PeliculaID = ".$movieId.") AS movieGenders,
               (SELECT JSON_ARRAYAGG(
                            JSON_OBJECT(
                               'img', m.img_url
                            )
                        )FROM Multimedia m JOIN Peliculas p on m.PeliculaID = p.PeliculaID WHERE m.PeliculaID=".$movieId.") AS img,
                m.trailer_url as movieTrailer
                FROM Peliculas p
                INNER JOIN Multimedia m on p.PeliculaID = m.PeliculaID
                WHERE p.PeliculaID = ".$movieId;

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $peliArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPeli=[];
        foreach ($peliArray as $peli){
            //el debugger me muestra todo, mientras que con el json_encode no me da nada
            $newPeli=new Pelicula($peli["movieId"],$peli["movieName"],$peli["movieDuration"],$peli["movieRelease"],$peli["movieRank"],$peli["movieSynopsis"]);
            // SI HAY DOS IMG PARA UNA PELI EN EL VAR_DUMP EN pruebasClass me saca dos veces toda la informacion de la peli en vez de
            // DARME UNA PELICULA CON UN ARRAY DE IMGS DE DOS imagenes
            $newPeli->setIMG(json_decode($peli["img"],true));
            $newPeli->setTrailer($peli["movieTrailer"]);
            $newPeli->setGeneros(json_decode($peli["movieGenders"],true));
            $newPeli->setActores(json_decode($peli["movieActors"],true));
            $newPeli->setDirectores(json_decode($peli["movieDirectors"],true));
            $objArrayPeli[]=$newPeli;
        }

        return $objArrayPeli;
    }

    public function userExists($nomUsr,$correo,$contra){

        session_start();
        //Lo paso a md5 para poder comparar la contraseña con la informacion de la tabla
        $md5contra=md5($contra);

        $sql="SELECT Correo,Contrasenya FROM Usuario WHERE NomUsuario LIKE '".$nomUsr."' AND Correo LIKE '".$correo."'  AND Contrasenya LIKE '".$md5contra."';";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        /*if($result->rowCount()){
            return true;
        }else{
            return false;
        }*/

    }

    public function insertUsr($nomUsr,$correo,$contra){

        $sql="INSERT INTO Usuarios(NomUsuario,Correo,Contrasenya) VALUES('".$nomUsr."','".$correo."','".$contra."');";

        $this->default();
        if($this->query($sql)==true){
            //Preguntar
            return header("Location: PagMain.php");
        }else{
            echo "
                 <script>
                     window.alert('El usuario ya fue registrado');
                 </script>
                ";
        }
        $this->close();
    }

}