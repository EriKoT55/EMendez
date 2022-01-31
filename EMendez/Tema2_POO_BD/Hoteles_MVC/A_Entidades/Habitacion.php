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
        $this->HabitacionID = (int)$HabitacionID;
        $this->HotelID =(int) $HotelID;
        $this->numHuespedes =(int) $numHuespedes;
        $this->numHabitacion =(int) $numHabitacion;
    }

    /**
     * @return int
     */
    public function getHabitacionID()
    {
        return $this->HabitacionID;
    }

    /**
     * @param int $HabitacionID
     */
    public function setHabitacionID( $HabitacionID )
    {
        $this->HabitacionID = $HabitacionID;
    }

    /**
     * @return int
     */
    public function getHotelID()
    {
        return $this->HotelID;
    }

    /**
     * @param int $HotelID
     */
    public function setHotelID( $HotelID )
    {
        $this->HotelID = $HotelID;
    }

    /**
     * @return int
     */
    public function getNumHuespedes()
    {
        return $this->numHuespedes;
    }

    /**
     * @param int $numHuespedes
     */
    public function setNumHuespedes( $numHuespedes )
    {
        $this->numHuespedes = $numHuespedes;
    }

    /**
     * @return int
     */
    public function getNumHabitacion()
    {
        return $this->numHabitacion;
    }

    /**
     * @param int $numHabitacion
     */
    public function setNumHabitacion( $numHabitacion )
    {
        $this->numHabitacion = $numHabitacion;
    }


}