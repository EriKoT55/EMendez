<?php

require_once ("../BD/bd.php");
require_once ("../A_Entidades/User.php");

class Register_modelo
{

    private bd $bd;


    public function __construct()
    {
        $this->bd=new bd();

    }

    /** EN LA BD EN LA TABLA users he puesto el correo como UQ(único)
     *
     * ASI ME SALTO EL PASO DE LA COMPROBACIÓN DE SI EXISTE EL USUARIO
     *
     */

    public function insertUser($correo,$password){

        $this->bd->default();

        $correo= $this->bd->real_escape_string($correo);

        $sql="INSERT INTO users(Mail,Password) VALUES ('".$correo."','".$password."')";

        if($this->bd->query($sql)){

            $sql1="SELECT Code FROM countries ORDER BY RAND() LIMIT 1";
            $result=$this->bd->query($sql1);
            $arrCodeRandom=$result->fetch_all(MYSQLI_ASSOC);

            $sql2="UPDATE countries set UserId=(SELECT Id FROM users WHERE Mail LIKE '".$correo."') WHERE Code LIKE '".$arrCodeRandom[0]["Code"]."'";
            $this->bd->query($sql2);

            $this->bd->close();
            return true;
        }else{
            $this->bd->close();
            return false;
        }

    }



}