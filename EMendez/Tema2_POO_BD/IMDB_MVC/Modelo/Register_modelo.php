<?php
require_once ("../A_EstructuraBD/bd.php");
require_once ("../A_Entidades/Usuario.php");

class Register_modelo
{

    private bd $bd;

    public function __construct(){

        $this->bd= new bd();

    }

    /*public function existUsr($nomUser,$correo,$contra){

    }*/

    public function insertUser($nomUser,$correo,$contra){

        $this->bd->default();
        $nomUser=$this->bd->real_escape_string($nomUser);
        $correo=$this->bd->real_escape_string($correo);

        $sql="INSERT INTO Usuarios(NomUsuario,Correo,Contrasenya) VALUES('".$nomUser."','".$correo."','".$contra."')";

        if($this->bd->query($sql)){
            $this->bd->close();
            return true;
        }else{
            $this->bd->close();
            return false;
        }
        $this->bd->close();

    }


}