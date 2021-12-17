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
    private $servername = "sql480.main-hosting.eu";//sql480.main-hosting.eu
    private $username = "u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
    private $password = "x43233702G";//x43233702G
    private $database = "u850300514_emendez";//RickMorthy_u850300514_emendez

    public function default()
    {
        $this->server();
    }

    public function server()
    {
        //Creo la conexion
        parent::__construct($this->servername, $this->username, $this->password, $this->database);

        // Me aseguro de si va bien la conexion
        if (mysqli_connect_error()) {
            die("Conexion fallida: " . mysqli_connect_error());
        }
    }

    /**
     * @param $PeliculaID
     * @return array
     */
    public function cogerGenero($PeliculaID){

        $sql="SELECT g.* FROM Genero g
        JOIN GenPeli gp on gp.GeneroID=g.GeneroID
        JOIN Peliculas p on p.PeliculaID=gp.PeliculaID
        WHERE p.PeliculaID=".$PeliculaID.";";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $genArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayGen=[];

        foreach ($genArray as $gen) {
            $objArrayGen[]= new Genero($gen["GeneroID"], $gen["Nombre"]);
        }

        return $objArrayGen;
    }

    /**
     * @param $PeliculaID
     * @return array
     */
    public function cogerMultimedia($PeliculaID){

        $sql="SELECT * FROM Multimedia WHERE MultimediaID=".$PeliculaID.";";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $multiArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayMulti=[];

        foreach ($multiArray as $multi) {
            $objArrayMulti[] = new Multimedia($multi["MultimediaID"], $multi["PeliculaID"], $multi["img_url"], $multi["trailer_url"]);
        }
        return $objArrayMulti;
    }

    /**
     * public function cogerUsuario(){
     *
    }*/

    /**
     * @param $PersonaID
     * @return array
     * mirar que devuelve null
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

    public function cogerPelicula($PeliculaID){
        $sql="SELECT * FROM Peliculas WHERE PeliculaID=".$PeliculaID.";";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $peliArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPeli=[];

        foreach ($peliArray as $peli){
        //el debugger me muestra todo, mientras que con el json_encode no me da nada
            $newPeli=new Pelicula($peli["PeliculaID"],$peli["Nombre"],$peli["Duracion"],$peli["Fecha_Salida"],$peli["Calificacion"],$peli["Sinopsis"]);
            $newPeli->setGeneros($this->cogerGenero($peli["PeliculaID"]));
            $newPeli->setActores($this->cogerNomPersXtrabj($peli["PeliculaID"],'Actor'));
            $newPeli->setDirectores($this->cogerNomPersXtrabj($peli["PeliculaID"],'Director'));

            $objArrayPeli[]=$newPeli;
        }

        return $objArrayPeli;

    }

    public function cogerPeliculas(){
        $sql="SELECT * FROM Peliculas;";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $peliArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPeli=[];

        foreach ($peliArray as $peli){
            //el debugger me muestra todo, mientras que con el json_encode no me da nada
            $newPeli=new Pelicula($peli["PeliculaID"],$peli["Nombre"],$peli["Duracion"],$peli["Fecha_Salida"],$peli["Calificacion"],$peli["Sinopsis"]);
            $newPeli->setGeneros($this->cogerGenero($peli["PeliculaID"]));
            $newPeli->setActores($this->cogerNomPersXtrabj($peli["PeliculaID"],'Actor'));
            $newPeli->setDirectores($this->cogerNomPersXtrabj($peli["PeliculaID"],'Director'));

            $objArrayPeli[]=$newPeli;
        }

        return $objArrayPeli;

    }

}