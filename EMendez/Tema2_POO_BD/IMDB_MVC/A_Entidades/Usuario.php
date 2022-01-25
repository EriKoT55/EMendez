<?php

class Usuario
{

    private $UsuarioID,$NomUsuario,$Correo,$Contrasenya;

    /**
     * @param $UsuarioID
     * @param $Correo
     * @param $Contrasenya
     */
    public function __construct($UsuarioID,$NomUsuario, $Correo, $Contrasenya )
    {
        $this->UsuarioID =(int) $UsuarioID;
        $this->NomUsuario=$NomUsuario;
        $this->Correo = $Correo;
        $this->Contrasenya = $Contrasenya;
    }

    /**
     * @return mixed
     */
    public function getUsuarioID():int
    {
        return $this->UsuarioID;
    }

    /**
     * @param mixed $UsuarioID
     */
    public function setUsuarioID($UsuarioID)
    {
        $this->UsuarioID = $UsuarioID;
    }

    /**
     * @return mixed
     */
    public function getNomUsuario()
    {
        return $this->NomUsuario;
    }

    /**
     * @param mixed $NomUsuario
     */
    public function setNomUsuario( $NomUsuario )
    {
        $this->NomUsuario = $NomUsuario;
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
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
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
    public function setContrasenya($Contrasenya)
    {
        $this->Contrasenya = $Contrasenya;
    }


}