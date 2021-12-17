<?php

class Pelicula
{
    private $PeliculaID,$Nombre,$Duracion,$Fecha_Salida,$Calificacion,$Sinopsis,$Generos,$Actores,$Directores;

    /**
     * @param $ID
     * @param $Nombre
     * @param $Duracion
     * @param $Fecha_Salida
     * @param $Calificacion
     * @param $Sinopsis
     */
    public function __construct($PeliculaID, $Nombre, $Duracion, $Fecha_Salida, $Calificacion, $Sinopsis)
    {

        $this->PeliculaID = $PeliculaID;
        $this->Nombre = $Nombre;
        $this->Duracion = $Duracion;
        $this->Fecha_Salida = $Fecha_Salida;
        $this->Calificacion = $Calificacion;
        $this->Sinopsis = $Sinopsis;
    }

    /**
     * @return mixed
     */
    public function getPeliculaID()
    {
        return $this->PeliculaID;
    }

    /**
     * @param $PeliculaID
     * @return void
     */
    public function setID($PeliculaID):void
    {
        $this->PeliculaID = $PeliculaID;

    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param $Nombre
     * @return void
     */
    public function setNombre($Nombre):void
    {
        $this->Nombre = $Nombre;

    }

    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->Duracion;
    }

    /**
     * @param $Duracion
     * @return void
     */
    public function setDuracion($Duracion):void
    {
        $this->Duracion = $Duracion;
    }

    /**
     * @return mixed
     */
    public function getFechaSalida()
    {
        return $this->Fecha_Salida;
    }

    /**
     * @param $Fecha_Salida
     * @return void
     */
    public function setFechaSalida($Fecha_Salida):void
    {
        $this->Fecha_Salida = $Fecha_Salida;
    }

    /**
     * @return mixed
     */
    public function getCalificacion()
    {
        return $this->Calificacion;
    }

    /**
     * @param $Calificacion
     * @return void
     */
    public function setCalificacion($Calificacion):void
    {
        $this->Calificacion = $Calificacion;
    }

    /**
     * @return mixed
     */
    public function getSinopsis()
    {
        return $this->Sinopsis;
    }

    /**
     * @param $Sinopsis
     * @return void
     */
    public function setSinopsis($Sinopsis):void
    {
        $this->Sinopsis = $Sinopsis;
    }

    /**
     * @return mixed
     */
    public function getGeneros()
    {
        return $this->Generos;
    }

    /**
     * @param mixed $Generos
     */
    public function setGeneros($Generos): void
    {
        $this->Generos = $Generos;
    }

    /**
     * @return mixed
     */
    public function getActores()
    {
        return $this->Actores;
    }

    /**
     * @param mixed $Actores
     */
    public function setActores(array $Actores): void
    {
        $this->Actores = $Actores;
    }

    /**
     * @return mixed
     */
    public function getDirectores()
    {
        return $this->Directores;
    }

    /**
     * @param mixed $Directores
     */
    public function setDirectores(array $Directores): void
    {
        $this->Directores = $Directores;
    }



}