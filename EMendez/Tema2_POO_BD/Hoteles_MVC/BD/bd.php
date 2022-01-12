<?php

/** creacion de la conexion a la BD */
class Conexion{
    private $host, $user, $passwd, $bd, $charset;

    public function __construct(){
        //ESTA EN EL CORREO
      $bd_config= require_once("config.php");
      $this->host= $bd_config["host"];
      $this->user= $bd_config["user"];
      $this->passwd= $bd_config["passwd"];
      $this->bd= $bd_config["bd"];
      $this->charset= $bd_config["charset"];
    }

    public function conn(){

        try {
            $conn = new mysqli( $this->host, $this->user, $this->passwd, $this->bd );
            $conn->query("SET NAMES'".$this->charset."'");
        }catch(Exception $e){
            die("Error ". $e->getMessage());

            echo "Linea del error". $e->getLine();
        }

        return $conn;
    }
}

?>