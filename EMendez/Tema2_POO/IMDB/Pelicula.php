<?php

class Pelicula
{
    private $ID,$Nombre,$IMG,$Trailer,$Duracion,$Fecha_Salida,$Calificacion,$Sinopsis;

    /**
     * @param $ID
     * @param $Nombre
     * @param $IMG
     * @param $Trailer
     * @param $Duracion
     * @param $Fecha_Salida
     * @param $Calificacion
     * @param $Sinopsis
     */
    public function __construct($ID, $Nombre, $IMG, $Trailer, $Duracion, $Fecha_Salida, $Calificacion, $Sinopsis)
    {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->IMG = $IMG;
        $this->Trailer = $Trailer;
        $this->Duracion = $Duracion;
        $this->Fecha_Salida = $Fecha_Salida;
        $this->Calificacion = $Calificacion;
        $this->Sinopsis = $Sinopsis;
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
     * @return Pelicula
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
    public function getIMG()
    {
        return $this->IMG;
    }

    /**
     * @param mixed $IMG
     * @return Pelicula
     */
    public function setIMG($IMG)
    {
        $this->IMG = $IMG;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrailer()
    {
        return $this->Trailer;
    }

    /**
     * @param mixed $Trailer
     * @return Pelicula
     */
    public function setTrailer($Trailer)
    {
        $this->Trailer = $Trailer;
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


}