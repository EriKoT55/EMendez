<?php

class Genero
{
    private $GeneroID,$Nombre;

    /**
     * @param $GeneroID
     * @param $Nombre
     */
    public function __construct($GeneroID, $Nombre)
    {
        $this->GeneroID = $GeneroID;
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed
     */
    public function getGeneroID()
    {
        return $this->GeneroID;
    }

    /**
     * @param mixed $GeneroID
     * @return Genero
     */
    public function setGeneroID($GeneroID)
    {
        $this->GeneroID = $GeneroID;
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
     * @return Genero
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }



}