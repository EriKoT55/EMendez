<?php

class Hotel{

    private $HotelID, $Nombre, $Precio, $Calificacion, $IMG, $Descripcion, $Ubicacion;

    public function __contruct($HotelID, $Nombre, $Precio, $Calificacion, $IMG, $Descripcion, $Ubicacion){

        $this->HotelID=(int) $HotelID;
        $this->Nombre=(string) $Nombre;
        $this->Precio=(float) $Precio;
        $this->Calificacion=(float) $Calificacion;
        $this->IMG=(string) $IMG;
        $this->Descripcion=(string) $Descripcion;
        $this->Ubicacion=(string) $Ubicacion;

    }

    /**
     * @return mixed
     */
    public function getHotelID()
    {
        return $this->HotelID;
    }

    /**
     * @param mixed $HotelID
     */
    public function setHotelID($HotelID): void
    {
        $this->HotelID = $HotelID;
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
    public function getPrecio()
    {
        return $this->Precio;
    }

    /**
     * @param mixed $Precio
     */
    public function setPrecio($Precio): void
    {
        $this->Precio = $Precio;
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
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     */
    public function setDescripcion($Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed
     */
    public function getUbicacion()
    {
        return $this->Ubicacion;
    }

    /**
     * @param mixed $Ubicacion
     */
    public function setUbicacion($Ubicacion): void
    {
        $this->Ubicacion = $Ubicacion;
    }

}


?>