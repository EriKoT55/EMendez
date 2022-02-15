<?php
require_once ("../BD/db.php");
require_once ("../A_Entidades/User.php");

class Register_modelo
{

    private db $db;

    public function __construct(){

        $this->db= new db();

    }

    public function insertUsr($mail,$contra){

        $this->db->default();

        $mail=$this->db->real_escape_string($mail);
        $contra=password_hash($contra,PASSWORD_DEFAULT);

        $sql="INSERT INTO users (Mail,Password) VALUE('".$mail."','".$contra."')";

        if($this->db->query($sql)==true){

            $sql1="SELECT Code FROM countries ORDER BY RAND() LIMIT 1;";

            $result=$this->db->query($sql1);
            $arrRandCode=$result->fetch_all(MYSQLI_ASSOC);

            $sql2="UPDATE countries SET UserId=(SELECT Id FROM users WHERE Mail='".$mail."') WHERE Code='".$arrRandCode[0]["Code"]."';";
            $this->db->query($sql2);

            $this->db->close();
            return true;
        }else{
            $this->db->close();
            return false;
        }

    }

}