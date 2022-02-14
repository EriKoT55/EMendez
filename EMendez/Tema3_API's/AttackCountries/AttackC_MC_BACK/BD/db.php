<?php

class db extends mysqli
{

    private $servername="";
    private $user="";
    private $password="";
    private $bd="";

    public function default(){

        $this->local();

    }

    public function local(){

        parent::construct($this->servername,$this->user,$this->password,$this->bd);

        if(mysqli_connect_error()){
            die("Conexion fallida: ". mysqli_connect_error());
        }

    }

}