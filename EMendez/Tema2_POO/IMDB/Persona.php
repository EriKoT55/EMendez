<?php

class Persona
{
    private $PersonaID,$NombreCompleto,$Trabajo,$Fecha_Nacimiento,$Descripcion,$IMG;

    /**
     * @param $ID
     * @param $Nombre
     * @param $Apellidos
     * @param $Fecha_Nacimiento
     * @param $Descripcion
     */
    public function __construct($PersonaID, $NombreCompleto,$Trabajo, $Fecha_Nacimiento, $Descripcion, $IMG)
    {
        $this->PersonaID = $PersonaID;
        $this->NombreCompleto = $NombreCompleto;
        $this->Trabajo = $Trabajo;
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;
        $this->Descripcion = $Descripcion;
        $this->IMG=$IMG;
        $this->Peliculas=[];
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
    public function getNombreCompleto()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $NombreCompleto
     * @return Persona
     */
    public function setNombreCompleto($NombreCompleto)
    {
        $this->NombreCompleto = $NombreCompleto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrabajo()
    {
        return $this->Trabajo;
    }

    /**
     * @param mixed $Trabajo
     */
    public function setTrabajo($Trabajo)
    {
        $this->Trabajo = $Trabajo;
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

    /**
     * @return array
     */
    public function getPeliculas()
    {
        return $this->Peliculas;
    }

    /**
     * @param array $Peliculas
     */
    public function setPeliculas($Peliculas)
    {
        $this->Peliculas = $Peliculas;
    }

}