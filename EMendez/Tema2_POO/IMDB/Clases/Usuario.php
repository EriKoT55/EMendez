<?php

class Usuario
{

    private $UsuarioID,$Correo,$Contrasenya,$PersonaID;

    /**
     * @param $UsuarioID
     * @param $Correo
     * @param $Contrasenya
     * @param $PersonaID
     */
    public function __construct($UsuarioID, $Correo, $Contrasenya, $PersonaID)
    {
        $this->UsuarioID = $UsuarioID;
        $this->Correo = $Correo;
        $this->Contrasenya = $Contrasenya;
        $this->PersonaID = $PersonaID;
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
    public function setUsuarioID($UsuarioID)
    {
        $this->UsuarioID = $UsuarioID;
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

    /**
     * @return mixed
     */
    public function getPersonaID()
    {
        return $this->PersonaID;
    }

    /**
     * @param mixed $PersonaID
     */
    public function setPersonaID($PersonaID)
    {
        $this->PersonaID = $PersonaID;
    }

}