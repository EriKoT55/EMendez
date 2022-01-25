<?php

class Persona
{
    public $PersonaID,$NombreCompleto,$Fecha_Nacimiento,$Descripcion,$IMG,$Peliculas,$Trabajo;

    /** BORRAR CODIGO NO UTILIZADO O QUE NO VAYAS A UTILIZAR
     * @param $PersonaID
     * @param $NombreCompleto
     * @param $Fecha_Nacimiento
     * @param $Descripcion
     * @param $IMG
     */
    public function __construct($PersonaID, $NombreCompleto, $Fecha_Nacimiento, $Descripcion, $IMG)
    {
        $this->PersonaID = $PersonaID;
        $this->NombreCompleto = $NombreCompleto;
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
     * @param $PersonaID
     * @return void
     */
    public function setPersonaID($PersonaID): void
    {
        $this->PersonaID = $PersonaID;
    }

    /**
     * @return mixed
     */
    public function getNombreCompleto()
    {
        return $this->NombreCompleto;
    }

    /**
     * @param $NombreCompleto
     * @return void
     */
    public function setNombreCompleto($NombreCompleto):void
    {
        $this->NombreCompleto = $NombreCompleto;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->Fecha_Nacimiento;
    }

    /**
     * @param $Fecha_Nacimiento
     * @return void
     */
    public function setFechaNacimiento($Fecha_Nacimiento):void
    {
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;

    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param $Descripcion
     * @return void
     */
    public function setDescripcion($Descripcion):void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed
     */
    public function getIMG()
    {
        return $this->IMG;
    }

    /**
     * @param $IMG
     * @return void
     */
    public function setIMG($IMG):void
    {
        $this->IMG = $IMG;
    }

    /**
     * @return mixed
     */
    public function getTrabajo()
    {
        return $this->Trabajo;
    }

    /**
     * @param array $Trabajo
     * @return void
     */
    public function setTrabajo( $Trabajo): void
    {
        $this->Trabajo = $Trabajo;
    }

    /**
     * @return mixed
     */
    public function getPeliculas()
    {
        return $this->Peliculas;
    }

    /**
     * @param $Peliculas
     * @return void
     */
    public function setPeliculas($Peliculas):void
    {
        $this->Peliculas = $Peliculas;
    }



}