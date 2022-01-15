<?php

require_once("../A_Entidades/User.php");
require_once ("../BD/bd.php");

class Registrar_modelo
{

    private bd $bd;

    public function __construct()
    {
        $this->bd = new bd();
    }

    /** INSERTA EL USUARIO Y SI LA INSERCION FUE REALIZADA CON EXITO DEVUELVE TRUE SINO FALSE
     * @param $usr
     * @param $correo
     * @param $contra
     * @return bool
     */
    public function InsertUsuario( $usr, $correo, $contra ): bool
    {
        $this->bd->default();
        
        $usr = $this->bd->real_escape_string( $usr );
        $correo = $this->bd->real_escape_string( $correo );

        $sql = "INSERT INTO Hotel_Usuarios(Nombre,Correo,Contrasenya) VALUES('" . $usr . "','" . $correo . "','" . $contra . "');";


        if( $this->bd->query( $sql )==true ) {
            return true;
        } else {
            return false;
        }
        $this->bd->close();

    }


}

?>