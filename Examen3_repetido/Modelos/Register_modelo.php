<?php
require_once ("../BD/bd.php");
require_once ("../A_Entidades/User.php");


class Register_modelo
{
    private bd $bd;

    public function __construct()
    {
        $this->bd= new bd();
    }

/** ME AHORRO LA COMPROBACION DEL SI EL USUARIO EXITE
 * MODIFICANDO LA BD, LA TABLA user la columna mail y la hago UQ(unique)
 */

public function insertUsr($mail,$contra){

    $this->bd->default();

    $mail=$this->bd->real_escape_string($mail);

    $contraHashed=password_hash($contra,PASSWORD_DEFAULT);

    $sql="INSERT INTO user (mail,password) VALUES ('".$mail."','".$contraHashed."')";

    if($this->bd->query($sql)){

        $this->bd->close();
        return true;
    }else{
        $this->bd->close();
        return false;
    }

}

}