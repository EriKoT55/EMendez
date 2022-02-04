<?php
require_once("../BD/bd.php");

class Hotel_modelo
{

    public bd $bd;

    public function __construct(){

        $this->bd=new bd();

    }

    public function getHoteles(){

        $sql="SELECT h2.HotelID,h2.Nombre,h2.Precio,h2.Calificacion,h2.Descripcion,h2.Ubicacion,h2.Estrellas,h2.Direccion,
            (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                'IMG',hm.img_url
            )
            )FROM Hotel_Multimedia hm JOIN Hoteles h1 on hm.HotelID=h1.HotelID WHERE h1.HotelID = h2.HotelID) AS IMG,
            (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
            'habitaciones',hh.HabitacionID
            )   
            )FROM Hotel_Habitaciones hh JOIN Hoteles h1 on hh.HotelID=h1.HotelID WHERE h1.HotelID=h2.HotelID) AS habitaciones
            FROM Hoteles h2 ";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrHoteles=$result->fetch_all(MYSQLI_ASSOC);

        return $arrHoteles;

    }

}