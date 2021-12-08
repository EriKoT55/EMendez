<?php

class Persona
{
    private $PersonaID,$Nombre,$Apellidos,$Fecha_Nacimiento,$Descripcion,$IMG;

    /**
     * @param $ID
     * @param $Nombre
     * @param $Apellidos
     * @param $Fecha_Nacimiento
     * @param $Descripcion
     */
    public function __construct($PersonaID, $Nombre, $Apellidos, $Fecha_Nacimiento, $Descripcion, $IMG)
    {
        $this->$PersonaID = $PersonaID;
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;
        $this->Descripcion = $Descripcion;
        $this->IMG=$IMG;
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
     * @return Persona
     */
    public function setPersonaID($PersonaID)
    {
        $this->PersonaID = $PersonaID;
        return $this;
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
     * @return Persona
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->Apellidos;
    }

    /**
     * @param mixed $Apellidos
     * @return Persona
     */
    public function setApellidos($Apellidos)
    {
        $this->Apellidos = $Apellidos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->Fecha_Nacimiento;
    }

    /**
     * @param mixed $Fecha_Nacimiento
     * @return Persona
     */
    public function setFechaNacimiento($Fecha_Nacimiento)
    {
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     * @return Persona
     */
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIMG()
    {
        return $this->IMG;
    }

    /**
     * @param mixed $IMG
     * @return Persona
     */
    public function setIMG($IMG)
    {
        $this->IMG = $IMG;
        return $this;
    }

}