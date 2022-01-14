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

        $sql="SELECT h.*,hm.img_url FROM Hoteles h
        JOIN Hotel_Multimedia hm on h.HotelID=hm.HotelID
        WHERE h.HotelID=".$HotelID.";";
        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrHotel= $result->fetch_all(MYSQLI_ASSOC);

        $objArrHotel = [];

        foreach ($arrHotel as $hotel){

            $newHotel=new Hotel($hotel["HotelID"],$hotel["Nombre"],$hotel["Precio"],$hotel["Calificacion"],$hotel["Descripcion"],$hotel["Ubicacion"]);
            $newHotel->setIMG($hotel["img_url"]);
            $objArrHotel[]=$newHotel;
        }

        return $objArrHotel;
    }

}
?>