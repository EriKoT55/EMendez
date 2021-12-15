<?php

class Trabajo
{
    private $ID,$Nombre;

    /**
     * @param $ID
     * @param $Nombre
     */
    public function __construct($ID, $Nombre)
    {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
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
     * @return Trabajo
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
     * @return Trabajo
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }



}