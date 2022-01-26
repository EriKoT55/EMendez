<?php

class Pelicula
{
    private $PeliculaID,$Nombre,$Duracion,$FechaSalida,$Calificacion,$Sinopsis,$IMG,$Trailer,$Generos,$Actores,$Directores;

    /** BORRAR CODIGO NO UTILIZADO O QUE NO VAYAS A UTILIZAR
     * @param $PeliculaID
     * @param $Nombre
     * @param $Duracion
     * @param $FechaSalida
     * @param $Calificacion
     * @param $Sinopsis
     */
    public function __construct($PeliculaID, $Nombre, $Duracion, $FechaSalida, $Calificacion, $Sinopsis)
    {
        $this->PeliculaID = $PeliculaID;
        $this->Nombre = $Nombre;
        $this->Duracion = $Duracion;
        $this->FechaSalida = $FechaSalida;
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
     * @param mixed $PeliculaID
     */
    public function setPeliculaID($PeliculaID): void
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
     * @param mixed $Nombre
     */
    public function setNombre($Nombre): void
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
     * @param mixed $Duracion
     */
    public function setDuracion($Duracion): void
    {
        $this->Duracion = $Duracion;
    }

    /**
     * @return mixed
     */
    public function getFechaSalida()
    {
        return $this->FechaSalida;
    }

    /**
     * @param mixed $FechaSalida
     */
    public function setFechaSalida($FechaSalida): void
    {
        $this->FechaSalida = $FechaSalida;
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
     */
    public function setCalificacion($Calificacion): void
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
     * @param mixed $Sinopsis
     */
    public function setSinopsis($Sinopsis): void
    {
        $this->Sinopsis = $Sinopsis;
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
     */
    public function setIMG($IMG): void
    {
        $this->IMG = $IMG;
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
     */
    public function setTrailer($Trailer): void
    {
        $this->Trailer = $Trailer;
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
    public function setActores($Actores): void
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
    public function setDirectores($Directores): void
    {
        $this->Directores = $Directores;
    }


}