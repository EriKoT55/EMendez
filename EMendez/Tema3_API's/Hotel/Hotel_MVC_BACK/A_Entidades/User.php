<?php

class User
{

    public $UsuarioID, $Nombre, $Contrasenya, $Correo;

    /**
     * @param $UsuarioID
     * @param $Nombre
     * @param $Contrasenya
     * @param $Correo
     */
    public function __construct( $UsuarioID, $Nombre, $Contrasenya, $Correo )
    {
        $this->UsuarioID = (int)$UsuarioID;
        $this->Nombre = (string)$Nombre;
        $this->Contrasenya = (string)$Contrasenya;
        $this->Correo = (string)$Correo;
    }

    /**
     * @return int
     */
    public function getUsuarioID()
    {
        return $this->UsuarioID;
    }

    /**
     * @param int $UsuarioID
     */
    public function setUsuarioID( $UsuarioID )
    {
        $this->UsuarioID = $UsuarioID;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     */
    public function setNombre( $Nombre )
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return string
     */
    public function getContrasenya()
    {
        return $this->Contrasenya;
    }

    /**
     * @param string $Contrasenya
     */
    public function setContrasenya( $Contrasenya )
    {
        $this->Contrasenya = $Contrasenya;
    }

    /**
     * @return string
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @param string $Correo
     */
    public function setCorreo( $Correo )
    {
        $this->Correo = $Correo;
    }



}
?>