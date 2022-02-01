<?php
require_once ("../BD/bd.php");
require_once ("../A_Entidades/Usuario.php");

class Register_modelo
{

    private bd $bd;

    public function __construct(){
        $this->bd= new bd();
    }

    /** CAMBIO EN LA BD TABLA users COLUMNA Mail hice que fuera UQ (unico)
     * para asi saltarme el paso de la comprobacion del usuario
     */

    public function insertUsr($email,$contra){

        $this->bd->default();

        $email=$this->bd->real_escape_string($email);

        $contraHased=password_hash($contra,PASSWORD_DEFAULT);

        $sql="INSERT INTO users (Mail,Password) VALUES ('".$email."','".$contraHased."')";

        if($this->bd->query($sql)){

            $sql1="SELECT Code FROM countries ORDER BY RAND() LIMIT 1;";
            $randCode=$this->bd->query($sql1);
            $arrRandCode=$randCode->fetch_all(MYSQLI_ASSOC);

            $sql2="UPDATE countries SET UserID=(SELECT Id FROM users WHERE Mail like '".$email."' ) WHERE Code like '".$arrRandCode[0]["Code"]."'; ";
            $result2=$this->bd->query($sql2);

            $this->bd->close();
            return true;
        }else{
            $this->bd->close();
            return false;
        }

    }

}