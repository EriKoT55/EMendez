<?php

require_once("../A_Entidades/Hotel.php");
require_once ("../BD/bd.php");

class Hotel_modelo{

    private bd $bd;

    public function __construct(){

        $this->bd = new bd();

    }

    public function getHotel($HotelID){

        $sql="SELECT * FROM Hoteles WHERE HotelID=".$HotelID.";";
        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrHotel= $result->fetch_all(MYSQLI_ASSOC);

        $objArrHotel = [];

        foreach ($arrHotel as $hotel){

            $newHotel=new Hotel($hotel["HotelID"],$hotel["Nombre"],$hotel["Precio"],$hotel["Calificacion"],$hotel["IMG"],$hotel["Descripcion"],$hotel["Ubicacion"]);
            $objArrHotel[]=$newHotel;
        }

        return $objArrHotel;
    }

}
?>