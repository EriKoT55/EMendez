<?php

class bd extends mysqli
{

    private $servername="localhost";
    private $user="root";
    private $passw="root";
    private $bd="ciudades";


    public function default(  )
    {
        $this->local();
    }

    public function local(){

        parent::__construct($this->servername,$this->user,$this->passw,$this->bd);

        if(mysqli_connect_error()){
            die ("Conexion fallida".mysqli_connect_error());
        }

    }

}