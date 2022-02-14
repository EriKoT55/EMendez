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
    public function existUsr( $user, $correo, $contra )
    {

        $sql = "SELECT * FROM Hotel_Usuarios WHERE Nombre LIKE '" . $user . "' AND Correo LIKE '" . $correo . "';";
        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();

        $arrUser = $result->fetch_all( MYSQLI_ASSOC );


        $userObjArr=[];
        foreach ($arrUser as $usuario){
            $userObjArr = new User($usuario["UsuarioID"],$usuario["Nombre"],$usuario["Contrasenya"],$usuario["Correo"]);
        }

        $passVery = password_verify( $contra, $userObjArr->getContrasenya() );

        if($user==$userObjArr->getNombre() && $correo==$userObjArr->getCorreo() && $passVery==true) {
            return $userObjArr;
        }else{
            return new User(0,"-","-","-");
        }
    }

}