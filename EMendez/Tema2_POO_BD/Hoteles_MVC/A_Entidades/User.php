<?php

class User{

    private $UsuarioID, $Nombre, $Contrasenya, $Correo;

    /**
     * @param $UsuarioID
     * @param $Nombre
     * @param $Contrasenya
     * @param $Correo
     */
    public function __construct( $UsuarioID, $Nombre, $Contrasenya, $Correo )
    {
        $this->UsuarioID = $UsuarioID;
        $this->Nombre = $Nombre;
        $this->Contrasenya = $Contrasenya;
        $this->Correo = $Correo;
    }

    /**
     * @return mixed
     */
    public function getUsuarioID()
    {
        return $this->UsuarioID;
    }

    /**
     * @param mixed $UsuarioID
     */
    public function setUsuarioID( $UsuarioID )
    {
        $this->UsuarioID = $UsuarioID;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre( $Nombre )
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed
     */
    public function getContrasenya()
    {
        return $this->Contrasenya;
    }

    /**
     * @param mixed $Contrasenya
     */
    public function setContrasenya( $Contrasenya )
    {
        $this->Contrasenya = $Contrasenya;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @param mixed $Correo
     */
    public function setCorreo( $Correo )
    {
        $this->Correo = $Correo;
    }

}
?>