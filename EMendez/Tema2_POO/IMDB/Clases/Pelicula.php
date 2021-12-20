<?php

class Pelicula
{
    private $peliculaID,$nombre,$duracion,$fechaSalida,$calificacion,$sinopsis,$img,$trailer,$generos,$actores,$directores,$comentarios;

    /**
     * @param $peliculaID
     * @param $nombre
     * @param $duracion
     * @param $fechaSalida
     * @param $calificacion
     * @param $sinopsis
     */
    public function __construct($peliculaID, $nombre, $duracion, $fechaSalida, $calificacion, $sinopsis)
    {
        $this->peliculaID = $peliculaID;
        $this->nombre = $nombre;
        $this->duracion = $duracion;
        $this->fechaSalida = $fechaSalida;
        $this->calificacion = $calificacion;
        $this->sinopsis = $sinopsis;
    }

    /**
     * @return mixed
     */
    public function getPeliculaID()
    {
        return $this->peliculaID;
    }

    /**
     * @param mixed $peliculaID
     */
    public function setPeliculaID($peliculaID)
    {
        $this->peliculaID = $peliculaID;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @param mixed $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * @return mixed
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * @param mixed $fechaSalida
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;
    }

    /**
     * @return mixed
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * @param mixed $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    /**
     * @return mixed
     */
    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    /**
     * @param mixed $sinopsis
     */
    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * @param mixed $trailer
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }

    /**
     * @return mixed
     */
    public function getGeneros()
    {
        return $this->generos;
    }

    /**
     * @param mixed $generos
     */
    public function setGeneros($generos)
    {
        $this->generos = $generos;
    }

    /**
     * @return mixed
     */
    public function getActores()
    {
        return $this->actores;
    }

    /**
     * @param mixed $actores
     */
    public function setActores($actores)
    {
        $this->actores = $actores;
    }

    /**
     * @return mixed
     */
    public function getDirectores()
    {
        return $this->directores;
    }

    /**
     * @param mixed $directores
     */
    public function setDirectores($directores)
    {
        $this->directores = $directores;
    }

    /**
     * @return mixed
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param mixed $comentarios
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }


}