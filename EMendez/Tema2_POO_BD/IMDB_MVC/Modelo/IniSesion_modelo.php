<?php
require_once ("../A_EstructuraBD/bd.php");
require_once ("../A_Entidades/Usuario.php");

class IniSesion_modelo
{

    private bd $bd;


    public function __construct(){
        $this->bd= new bd();
    }

    public function getUser($nomUser,$correo,$contra){

        $sql="SELECT * FROM Usuarios WHERE NomUsuario LIKE '".$nomUser."' AND Correo LIKE '".$correo."';";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();
        $arrUser=$result->fetch_all(MYSQLI_ASSOC);

        $passVerify=password_verify($contra,$arrUser[0]["Contrasenya"]);
        $arrObjUser=[];
        if($nomUser == $arrUser[0]["NomUsuario"] && $correo== $arrUser[0]["Correo"]) {
            if($passVerify==true) {
                foreach( $arrUser as $user ) {
                    $newUsuario = new Usuario( $user["UsuarioID"], $user["NomUsuario"], $user["Correo"], $user["Contrasenya"] );
                    $arrObjUser[]=$newUsuario;
                }
                return $arrObjUser;
            }else{
                return new Usuario(0,"-","-","-");
            }

        }
    }

}