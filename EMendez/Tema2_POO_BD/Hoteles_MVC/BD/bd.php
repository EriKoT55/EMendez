<?php
//require_once("config.php");

/** creacion de la conexion a la BD */
class bd extends mysqli{

    private $servername = "sql480.main-hosting.eu";//localhost
    private $user = "u850300514_emendez";//root
    private $passwd = "x43233702G";// nada o root
    private $database = "u850300514_emendez"; //NOMBRE DE LA BD

    public function default()
    {
        $this->local();
    }

    public function local()
    {
        //Creo la conexion
        parent::__construct( $this->servername, $this->user, $this->passwd, $this->database );

        // Me aseguro de si va bien la conexion
        if( mysqli_connect_error() ) {
            die( "Conexion fallida: " . mysqli_connect_error() );
        }
    }

    /*public function conn(){

        try {
            $conn = new mysqli( $this->host, $this->user, $this->passwd, $this->bd );
            $conn->query("SET NAMES'".$this->charset."'");
        }catch(Exception $e){
            die("Error ". $e->getMessage());

            echo "Linea del error". $e->getLine();
        }

        return $conn;
    }*/


}

?>