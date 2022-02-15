<?php

class db extends mysqli
{

    private $servername="localhost";
    private $user="root";
    private $password="root";
    private $bd="ciudades";

    public function default(){

        $this->local();

    }

    public function local(){

        parent::__construct($this->servername,$this->user,$this->password,$this->bd);

        if(mysqli_connect_error()){
            die("Conexion fallida: ". mysqli_connect_error());
        }

    }

}