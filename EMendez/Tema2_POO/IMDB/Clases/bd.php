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

        $result=$this->query($sql);

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

        $result=$this->query($sql);

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

        $result=$this->query($sql);

        $trabjArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayTrabj=[];

        foreach ($trabjArray as $trabj){
            $objArrayTrabj[]=new Trabajo($trabj["TrabajoID"],$trabj["Nom_trabajo"]);
        }

        return $objArrayTrabj;

    }

    public function cogerPeliXpers($PersonaID){

        $sql="SELECT pl.Nombre as Pelicula FROM Peliculas pl
              JOIN PersPeli pp on pp.PeliculaID=pl.PeliculaID
              JOIN Persona prs on prs.PersonaID=pp.PersonaID
              WHERE prs.PersonaID=".$PersonaID.";";

        $result=$this->query($sql);

        $peliXpersArray=$result->fetch_all(MYSQLI_ASSOC);

        //No puedo devolver un array de obj ya que el nombre por si solo no es nada

        return $peliXpersArray;

    }
    /**
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
            $newPers->setPeliculas(cogerPeliXpers($pers["PersonaID"]));
            $newPers->setTrabajo(cogerTrabajo($pers["PersonaID"]));
            $objArrayPers[]=$newPers;
        }
        return $objArrayPers;

    }

}