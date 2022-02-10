<?php

require_once( "../A_Entidades/User.php" );
require_once( "../BD/bd.php" );

class IniSesion_modelo
{

    private bd $bd;


    public function __construct()
    {
        $this->bd = new bd();
    }
//CAMBIAR LA FUNCION QUE DEVUELVA EL OBJETO USUARIO Y SI NO UN OBJETO USUARIO CON ID 0 Y QUE ESTE VACIO
    public function existUsr( $user, $correo, $contra ): bool
    {

        $sql = "SELECT * FROM Hotel_Usuarios WHERE Nombre LIKE '" . $user . "' AND Correo LIKE '" . $correo . "';";
        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

        $arrUser = $result->fetch_all( MYSQLI_ASSOC );

        $passVery = password_verify( $contra, $arrUser[0]["Contrasenya"] );
        if($user==$arrUser[0]["Nombre"] && $correo==$arrUser[0]["Correo"]) {
            if($passVery==true){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function UsrID($user){

        $sql="SELECT UsuarioID FROM Hotel_Usuarios WHERE Nombre LIKE '".$user."';";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrUsrID = $result->fetch_all(MYSQLI_ASSOC);

        return $arrUsrID;

    }

}