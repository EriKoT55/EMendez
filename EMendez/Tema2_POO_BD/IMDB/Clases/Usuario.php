<?php

class Usuario
{

    private $PersonaID,$Correo,$Contrasenya;

    /**
     * @param $PersonaID
     * @param $Correo
     * @param $Contrasenya
     */
    public function __construct($PersonaID, $Correo, $Contrasenya )
    {
        $this->PersonaID = $PersonaID;
        $this->Correo = $Correo;
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