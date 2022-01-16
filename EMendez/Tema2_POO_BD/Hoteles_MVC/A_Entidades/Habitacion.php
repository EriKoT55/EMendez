<?php

class Habitacion
{

    private $HabitacionID,$HotelID,$numHuespedes,$numHabitacion;

    /**
     * @param $HabitacionID
     * @param $HotelID
     * @param $numHuespedes
     * @param $numHabitacion
     */
    public function __construct( $HabitacionID, $HotelID, $numHuespedes, $numHabitacion )
    {
        $this->HabitacionID = $HabitacionID;
        $this->HotelID = $HotelID;
        $this->numHuespedes = $numHuespedes;
        $this->numHabitacion = $numHabitacion;
    }

    /**
     * @return mixed
     */
    public function getHabitacionID()
    {
        return $this->HabitacionID;
    }

    /**
     * @param mixed $HabitacionID
     */
    public function setHabitacionID( $HabitacionID )
    {
        $this->HabitacionID = $HabitacionID;
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
    public function setHotelID( $HotelID )
    {
        $this->HotelID = $HotelID;
    }

    /**
     * @return mixed
     */
    public function getNumHuespedes()
    {
        return $this->numHuespedes;
    }

    /**
     * @param mixed $numHuespedes
     */
    public function setNumHuespedes( $numHuespedes )
    {
        $this->numHuespedes = $numHuespedes;
    }

    /**
     * @return mixed
     */
    public function getNumHabitacion()
    {
        return $this->numHabitacion;
    }

    /**
     * @param mixed $numHabitacion
     */
    public function setNumHabitacion( $numHabitacion )
    {
        $this->numHabitacion = $numHabitacion;
    }


}