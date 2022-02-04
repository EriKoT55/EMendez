<?php

class bd extends mysqli
{

    private $servername="sql480.main-hosting.eu";
    private $username="u850300514_emendez";
    private $password="x43233702G";
    private $bd="u850300514_emendez";

    public function default(){
        $this->local();
    }

    public function local(){

        parent::__construct($this->servername,$this->username,$this->password,$this->bd);

        if(mysqli_connect_error()){
            die("Conexion fallida: ".mysqli_connect_error());
        }

    }

}
