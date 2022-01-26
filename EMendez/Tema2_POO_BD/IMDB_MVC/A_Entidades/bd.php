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
    public function cogerPersonasasdf()
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
    public function cogerPersonas(){
        /*PREGUNTAR PROFESOR, CON EL JSON NO SE SACAR LOS NOMBRES DE PELICULAS*/
        $sql="SELECT p.PersonaID,p.NombreCompleto,p.Fecha_Nacimiento,p.Descripcion,p.IMG,
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                    'nomPeli',pl.Nombre
                )
            )FROM Peliculas pl JOIN PersPeli pp on pp.PeliculaID=pl.PeliculaID AND pp.PersonaID=p.PersonID ) AS nomPeli
            FROM Persona p;";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $persArray=$result->fetch_all(MYSQLI_ASSOC);

        $objArrayPers = [];
        foreach( $persArray as $pers ) {
            $newPers = new Persona($pers["PersonaID"],$pers["NombreCompleto"],$pers["Fecha_Nacimiento"],$pers["Descripcion"],$pers["IMG"]);
            $newPers->setPeliculas(json_decode($pers["nomPeli"],true));
            $objArrayPers[] = $newPers;
        }

        return $objArrayPers;
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

    /*********  INSERTA LAS CALIFICACIONES A LA BD
     *
     * @param $Calificacion
     * @param $PeliculaID
     * @param $UsuarioID
     * @return bool
     */
    public function insertCalificacion($Calificacion,$PeliculaID,$UsuarioID){

        $sql="INSERT INTO Calificaciones(Calificacion,PeliculaID,UsuarioID) VALUES (".$Calificacion.",".$PeliculaID.",".$UsuarioID.")";
        $this->default();
        if($this->query( $sql )==true){
            return true;
        }else{
            return false;
        }
        $this->close();

    }

    /********* COGE LAS CALIFICACIONES Y HACE UNA MEDIA DE ESTAS DIFERENCIANDO LAS PELICULAS E INSERTA EL RESULTADO EN Peliculas
     *
     *
     *
     */
    public function mediaCalificaciones_insert(){

        $sql="SELECT c.Calificacion,p.Calificacion FROM Calificaciones c 
            JOIN Peliculas p on c.PeliculasID=p.PeliculasID";

        $this->default();
        $result=$this->query($sql);
        $this->close();

        $arrayCalif=$result->fetch_all(MYSQLI_ASSOC);

    }

}