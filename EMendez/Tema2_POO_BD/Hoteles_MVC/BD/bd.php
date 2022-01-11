<?php

class Conexion{
    public function conn(){
        $conn=new mysqli("sql480.main-hosting.eu","u850300514_emendez","x43233702G","u850300514_emendez");
        return $conn;
    }
}

?>