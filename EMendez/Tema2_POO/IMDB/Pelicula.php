<?php

class Pelicula
{
    private $ID,$Nombre,$IMG,$Trailer,$Duracion,$Fecha_Salida,$Calificacion,$Sinopsis,$Generos,$Actores,$Directores ;

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
    public function __construct($ID, $Nombre, $IMG, $Trailer, $Duracion, $Fecha_Salida, $Calificacion, $Sinopsis,array $Generos,array $Actores,array $Directores)
    {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->IMG = $IMG;
        $this->Trailer = $Trailer;
        $this->Duracion = $Duracion;
        $this->Fecha_Salida = $Fecha_Salida;
        $this->Calificacion = $Calificacion;
        $this->Sinopsis = $Sinopsis;
        $this->Generos=$Generos;
        $this->Actores=$Actores;
        $this->Directores=$Directores;
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

    /**
     * @return array
     */
    public function getGeneros()
    {
        return $this->Generos;
    }

    /**
     * @param array $Generos
     * @return Pelicula
     */
    public function setGeneros($Generos)
    {
        $this->Generos = $Generos;
        return $this;
    }

    /**
     * @return array
     */
    public function getActores()
    {
        return $this->Actores;
    }
    /**
     * @param array $Actores
     * @return Pelicula
     */
    public function setActores($Actores)
    {
        $this->Actores = $Actores;
        return $this;
    }
    /**
     * @return array
     */
    public function getDirectores()
    {
        return $this->Directores;
    }
    /**
     * @param array $Directores
     * @return Pelicula
     */
    public function setDirectores($Directores)
    {
        $this->Directores = $Directores;
        return $this;
    }




}