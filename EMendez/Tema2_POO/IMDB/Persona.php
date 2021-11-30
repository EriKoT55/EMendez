<?php

class Persona
{
    private $ID,$Nombre,$Apellidos,$Fecha_Nacimiento,$Descripcion;

    /**
     * @param $ID
     * @param $Nombre
     * @param $Apellidos
     * @param $Fecha_Nacimiento
     * @param $Descripcion
     */
    public function __construct($ID, $Nombre, $Apellidos, $Fecha_Nacimiento, $Descripcion)
    {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Fecha_Nacimiento = $Fecha_Nacimiento;
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     * @return Persona
     */
    public function setID($ID)
    {
        $this->ID = $ID;
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

}