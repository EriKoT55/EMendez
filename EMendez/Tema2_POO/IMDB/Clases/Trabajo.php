<?php

class Trabajo
{
    private $TrabajoID,$Nom_trabajo;

    /**
     * @param $TrabajoID
     * @param $Nombre
     */
    public function __construct($TrabajoID, $Nom_trabajo)
    {
        $this->TrabajoID = $TrabajoID;
        $this->Nom_trabajo = $Nom_trabajo;
    }

    /**
     * @return mixed
     */
    public function getTrabajoID()
    {
        return $this->TrabajoID;
    }

    /**
     * @param mixed $TrabajoID
     * @return Trabajo
     */
    public function setTrabajoID($TrabajoID)
    {
        $this->TrabajoID = $TrabajoID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomtrabajo()
    {
        return $this->Nom_trabajo;
    }

    /**
     * @param mixed $Nom_trabajo
     * @return Trabajo
     */
    public function setNomtrabajo($Nom_trabajo)
    {
        $this->Nom_trabajo = $Nom_trabajo;
        return $this;
    }



}