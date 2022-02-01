<?php
require_once ("../BD/bd.php");
require_once ("../A_Entidades/Usuario.php");

class Login_modelo
{

    private bd $bd;

    public function __construct(){
        $this->bd= new bd();
    }

    public function getUsr($email,$contra){

        $this->bd->default();

        $email= $this->bd->real_escape_string($email);

        $sql="SELECT * FROM users WHERE Mail like '".$email."'";

        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrUser=$result->fetch_all(MYSQLI_ASSOC);

        $objArrUsers=[];
        foreach($arrUser as $user){

            $objArrUsers= new Usuario($user["Id"],$user["Mail"],$user["Password"]);

        }

        $passVerify=password_verify($contra,$objArrUsers->getPassword());

       if($email==$objArrUsers->getMail() && $passVerify==true){
            return $objArrUsers;
       }else{
           return new Usuario(0,"-","-");
       }

    }

}