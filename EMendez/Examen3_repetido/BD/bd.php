<?php

class bd extends mysqli
{

    private $servername="localhost";
    private $username="root";
    private $password="root";
    private $database="films";

    public function default(){
        $this->local();
    }

    public function local(){
        parent::__construct($this->servername,$this->username,$this->password,$this->database);

        if(mysqli_connect_error()){

            die("Conexion fallida: ". mysqli_connect_error());
        }

    }

}