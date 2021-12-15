<?php

class Pelicula
{
    private $PeliculaID,$Nombre,$Duracion,$Fecha_Salida,$Calificacion,$Sinopsis;

    /**
     * @param $ID
     * @param $Nombre
     * @param $Duracion
     * @param $Fecha_Salida
     * @param $Calificacion
     * @param $Sinopsis
     */
    public function __construct($PeliculaID, $Nombre, $IMG, $Trailer, $Duracion, $Fecha_Salida, $Calificacion, $Sinopsis)
    {
        $this->PeliculaID = $PeliculaID;
        $this->Nombre = $Nombre;
        $this->Duracion = $Duracion;
        $this->Fecha_Salida = $Fecha_Salida;
        $this->Calificacion = $Calificacion;
        $this->Sinopsis = $Sinopsis;
        $this->Generos=[];
        $this->Actores=[];
        $this->Directores=[];
    }

    /**
     * @return mixed
     */
    public function getPeliculaID()
    {
        return $this->PeliculaID;
    }

    /**
     * @param mixed $PeliculaID
     * @return Pelicula
     */
    public function setID($PeliculaID)
    {
        $this->PeliculaID = $PeliculaID;
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
     * @return Pelicula
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->Duracion;
    }

    /**
     * @param mixed $Duracion
     * @return Pelicula
     */
    public function setDuracion($Duracion)
    {
        $this->Duracion = $Duracion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaSalida()
    {
        return $this->Fecha_Salida;
    }

    /**
     * @param mixed $Fecha_Salida
     * @return Pelicula
     */
    public function setFechaSalida($Fecha_Salida)
    {
        $this->Fecha_Salida = $Fecha_Salida;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCalificacion()
    {
        return $this->Calificacion;
    }

    /**
     * @param mixed $Calificacion
     * @return Pelicula
     */
    public function setCalificacion($Calificacion)
    {
        $this->Calificacion = $Calificacion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSinopsis()
    {
        return $this->Sinopsis;
    }

    /**
     * @param mixed $Sinopsis
     * @return Pelicula
     */
    public function setSinopsis($Sinopsis)
    {
        $this->Sinopsis = $Sinopsis;
        return $this;
    }

    /**
     * @return array
     */
    public function getGeneros(): array
    {
        return $this->Generos;
    }

    /**
     * @param array $Generos
     * @return Pelicula
     */
    public function setGeneros(array $Generos): void
    {
        $this->Generos = $Generos;

    }

    /**
     * @return array
     */
    public function getActores(): array
    {
        return $this->Actores;
    }
    /**
     * @param array $Actores
     * @return Pelicula
     */
    public function setActores(array $Actores): void
    {
        $this->Actores = $Actores;

    }
    /**
     * @return array
     */
    public function getDirectores(): array
    {
        return $this->Directores;
    }
    /**
     * @param array $Directores
     * @return Pelicula
     */
    public function setDirectores(array $Directores): void
    {
        $this->Directores = $Directores;

    }




}