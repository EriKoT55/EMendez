<?php
require_once("../A_Entidades/Hotel.php");
require_once("../BD/bd.php");

/*
 * https://www.logitravel.com/hoteles/espana/madrid--eyJjaXR5IjoiNDUyMiJ9
 *
 * https://victorroblesweb.es/2013/11/18/tutorial-mvc-en-php-nativo/
 *
 * https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/
 */

class Main_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();

    }

    /** DEVUELVE LA INFORMACION DE TODOS LOS HOTELES
     * @return array
     */
    public function getHoteles()
    {
        $sql = "SELECT h2.HotelID,h2.Nombre,h2.Precio,h2.Calificacion,h2.Descripcion,h2.Ubicacion,h2.Estrellas,h2.Direccion,
            (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                'IMG',hm.img_url
            )
        )FROM Hotel_Multimedia hm JOIN Hoteles h1 on hm.HotelID=h1.HotelID WHERE h1.HotelID = h2.HotelID) AS IMG
            FROM Hoteles h2 ";
        $this->bd->default();
        $result = $this->bd->query($sql);
        $this->bd->close();

        $arrHotel = $result->fetch_all(MYSQLI_ASSOC);

        $objArrHotel = [];

        foreach ($arrHotel as $hotel) {

            $newHotel = new Hotel($hotel["HotelID"], $hotel["Nombre"], $hotel["Precio"], $hotel["Calificacion"], $hotel["Descripcion"], $hotel["Ubicacion"],$hotel["Estrellas"],$hotel["Direccion"]);
            $newHotel->setIMG(json_decode($hotel["IMG"],true));
            $objArrHotel[] = $newHotel;
        }

        return $objArrHotel;
    }

    /************************ FILTRADO: PRECIO,CALIFICACION,UBICACION *****************************/

    /*public function (){

    }*/

}


?>