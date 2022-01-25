<?php
require_once ("../BD/bd.php");
require_once ("../A_Entidades/User.php");

class IniSesion_modelo
{
    private bd $bd;

    public function __construct()
    {
        $this->bd=new bd();

    }


    public function getUser($correo,$passowrd){

        $this->bd->default();

        $sql="SELECT * FROM users WHERE Mail LIKE '".$correo."';";

        $result=$this->bd->query($sql);

        $arrUser = $result->fetch_all(MYSQLI_ASSOC);

        $passowrdVerify=password_verify($passowrd,$arrUser[0]["Password"]);

        if($correo==$arrUser[0]["Mail"] && $passowrd == $passowrdVerify) {

            $userObjArr = [];
            foreach ($arrUser as $user) {

                $userObjArr[] = new User($user["Id"], $user["Mail"], $user["Password"]);

            }
            return $userObjArr;
        }else{
            return new User(0,"-","-");
        }

        $this->bd->close();

    }

}