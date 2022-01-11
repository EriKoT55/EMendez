<?php
// METER LA LOGICA DE COGER DATOS DE LAS TABLAS AQUÍ
class BD{

    private $Partidos="";
    private $Provincias="";
    private $Resultados="";

    public function __construct()
    {
        $this->setPartidos();
        $this->setProvincias();
        $this->setResultados();
    }

    public function getPartidos()
    {
        return $this->Partidos;
    }

    public function setPartidos($Partidos)
    {
        //Pillar los datos de la tabla con un select

    }

    public function getProvincias()
    {
        return $this->Provincias;
    }

    public function setProvincias($Provincias)
    {
        //Pillar los datos de la tabla con un select
    }

    public function getResultados()
    {
        return $this->Resultados;
    }

    public function setResultados($Resultados)
    {
        //Pillar los datos de la tabla con un select
    }


}

?>