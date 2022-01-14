<?php

require_once("../A_Entidades/Hotel.php");
require_once ("../BD/bd.php");

class Hotel_modelo{

    private bd $bd;

    public function __construct(){

        $this->bd = new bd();

    }

    /** DEVUELVE EL HOTEL, EL CUAL HAS PASADO POR PARAMETRO
     * @param $HotelID
     * @return array
     */
    public function getHotel($HotelID){

        $sql="SELECT h.HotelID,h.Nombre,h.Precio,h.Calificacion,h.Descripcion,h.Ubicacion,h.Estrellas,h.Direccion,
            (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                'IMG',hm.img_url
            )
        )FROM Hotel_Multimedia hm JOIN Hoteles h on hm.HotelID=h.HotelID WHERE h.HotelID=".$HotelID.") AS IMG
            FROM Hoteles h WHERE h.HotelID=".$HotelID.";";
        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrHotel= $result->fetch_all(MYSQLI_ASSOC);

        $objArrHotel = [];

        foreach ($arrHotel as $hotel){

            $newHotel=new Hotel($hotel["HotelID"],$hotel["Nombre"],$hotel["Precio"],$hotel["Calificacion"],$hotel["Descripcion"],$hotel["Ubicacion"],$hotel["Estrellas"],$hotel["Direccion"]);
            $newHotel->setIMG(json_decode($hotel["IMG"],true));
            $objArrHotel[]=$newHotel;
        }

        return $objArrHotel;
    }

}
?>