<?php
require_once("../A_Entidades/Hotel.php");
require_once ("../BD/bd.php");

/*
 * https://www.logitravel.com/hoteles/espana/madrid--eyJjaXR5IjoiNDUyMiJ9
 *
 * https://victorroblesweb.es/2013/11/18/tutorial-mvc-en-php-nativo/
 *
 * https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/
 */

class Main_modelo{

    private bd $bd;

    public function __construct(){

        $this->bd = new bd();

    }

    public function getHotel(){

        $sql="SELECT * FROM Hoteles;";
        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrHotel= $result->fetch_all(MYSQLI_ASSOC);

        $objArrHotel =[];

        foreach ($arrHotel as $hotel){

            $newHotel=new Hotel($hotel["HotelID"],$hotel["Nombre"],$hotel["Precio"],$hotel["Calificacion"],$hotel["IMG"],$hotel["Descripcion"],$hotel["Ubicacion"]);
            $objArrHotel[]=$newHotel;
        }

        return $objArrHotel;
    }

}


?>