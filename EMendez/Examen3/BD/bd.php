<?php

class bd extends mysqli
{

    private $servername="localhost";
    private $userName="root";
    private $password="root";
    private $db="Ciudades";

    public function default(){
        $this->local();
    }

    public function local(){

        parent::__construct($this->servername,$this->userName,$this->password,$this->db);

        if(mysqli_connect_error()){
            die("Conexion fallida: ".mysqli_connect_error());
        }

    }

}