<?php

class Hotel{

    private $HotelID, $Nombre, $Precio, $Calificacion,$IMG, $Descripcion, $Ubicacion,$Estrellas,$Direccion,$Habitaciones;

    public function __construct($HotelID, $Nombre, $Precio, $Calificacion, $Descripcion, $Ubicacion,$Estrellas,$Direccion){

        $this->HotelID=(int) $HotelID;
        $this->Nombre=(string) $Nombre;
        $this->Precio=(float) $Precio;
        $this->Calificacion=(float) $Calificacion;
        $this->Descripcion=(string) $Descripcion;
        $this->Ubicacion=(string) $Ubicacion;
        $this->Estrellas=(int) $Estrellas;
        $this->Direccion=(string) $Direccion;

    }

    /**
     * @return int
     */
    public function getHotelID(): int
    {
        return $this->HotelID;
    }

    /**
     * @param int $HotelID
     */
    public function setHotelID(int $HotelID): void
    {
        $this->HotelID = $HotelID;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     */
    public function setNombre(string $Nombre): void
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->Precio;
    }

    /**
     * @param float $Precio
     */
    public function setPrecio(float $Precio): void
    {
        $this->Precio = $Precio;
    }

    /**
     * @return float
     */
    public function getCalificacion(): float
    {
        return $this->Calificacion;
    }

    /**
     * @param float $Calificacion
     */
    public function setCalificacion(float $Calificacion): void
    {
        $this->Calificacion = $Calificacion;
    }

    /**
     * @return mixed
     */
    public function getIMG():array
    {
        return $this->IMG;
    }

    /**
     * @param mixed $IMG
     */
    public function setIMG(array $IMG): void
    {
        $this->IMG = $IMG;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->Descripcion;
    }

    /**
     * @param string $Descripcion
     */
    public function setDescripcion(string $Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return string
     */
    public function getUbicacion(): string
    {
        return $this->Ubicacion;
    }

    /**
     * @param string $Ubicacion
     */
    public function setUbicacion(string $Ubicacion): void
    {
        $this->Ubicacion = $Ubicacion;
    }

    /**
     * @return int
     */
    public function getEstrellas(): int
    {
        return $this->Estrellas;
    }

    /**
     * @param int $Estrellas
     */
    public function setEstrellas(int $Estrellas): void
    {
        $this->Estrellas = $Estrellas;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->Direccion;
    }

    /**
     * @param string $Direccion
     */
    public function setDireccion(string $Direccion): void
    {
        $this->Direccion = $Direccion;
    }

    /**SI PONGO : array al no estar todos los campos llenos de todos los hoteles peta
     * @return array
     */
    public function getHabitaciones()
    {
        return $this->Habitaciones;
    }

    /**
     * @param array $Habitaciones
     * @return void
     */
    public function setHabitaciones( $Habitaciones ):void
    {
        $this->Habitaciones = $Habitaciones;
    }


}

?>