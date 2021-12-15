<?php

class Trabajo
{
    private $TrabajoID,$Nom_trabajo;

    /**
     * @param $TrabajoID
     * @param $Nom_trabajo
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
     * @param $TrabajoID
     * @return $this
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
     * @param $Nom_trabajo
     * @return $this
     */
    public function setNomtrabajo($Nom_trabajo)
    {
        $this->Nom_trabajo = $Nom_trabajo;
        return $this;
    }



}