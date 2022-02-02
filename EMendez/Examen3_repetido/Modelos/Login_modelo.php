<?php
require_once ("../BD/bd.php");
require_once ("../A_Entidades/User.php");

class Login_modelo
{

    private bd $bd;

    public function __construct()
    {
        $this->bd= new bd();
    }

    public function getUsr($mail,$contra){

        $this->bd->default();

        $mail=$this->bd->real_escape_string($mail);

        $sql="SELECT * FROM user WHERE mail like '".$mail."'";

        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrUser=$result->fetch_all(MYSQLI_ASSOC);

        $objArrUser=[];
        foreach ($arrUser as $user){

            $objArrUser= new User($user["user_id"],$user["mail"],$user["password"]);

        }

        $passwordVerify=password_verify($contra,$objArrUser->getPassword());

        if($objArrUser->getMail()==$mail && $passwordVerify==true){
            return $objArrUser;
        }else{
            return new User(0,"-","-");
        }

    }
}