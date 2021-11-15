<?php

class BD{

    private $Partidos, $Provincias, $Resultados;


    public function __construct()
    {
        $Partidos->setPartidos();
        $Provincias->setProvincias();
        $Resultados->setResultados();
    }

    public function getPartidos()
    {
        return $this->Partidos;
    }

    public function setPartidos($Partidos)
    {
       $this->$Partidos = $query="CREATE TABLE Partidos(
            id INT(10) AUTO_INCREMENT PRYMARY KEY,
            name VARCHAR(100) NOT NULL,
            acronym VARCHAR(10) NOT NULL,
            logo VARCHAR(100) NOT NULL,
            colour VARCHAR(10)
        )";
    }

    public function getProvincias()
    {
        return $this->Provincias;
    }

    public function setProvincias($Provincias)
    {
        $this->Provincias = $query="CREATE TABLE Provincias(
            id INT(10) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            delegates INT(3) NOT NULL
        )";
    }

    public function getResultados()
    {
        return $this->Resultados;
    }

    public function setResultados($Resultados)
    {
        $this->Resultados = $query="CREATE TABLE Resultados (
            district VARCHAR(50) NOT NULL,
            party VARCHAR(100) NOT NULL,
            votes INT(10) NOT NULL
        )";
    }


}

?>