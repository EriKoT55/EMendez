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

    /** DEVUELVE LA INFORMACION DE TODOS LOS HOTELES
     * @return array
     */
    public function getHotel(){
/* PETA
Fatal error: Uncaught Error: Call to a member function fetch_all() on bool in C:\xampp\htdocs\EMendez\EMendez\Tema2_POO_BD\Hoteles_MVC\Modelos\Main_modelo.php on line 36
        $sql="SELECT h.HotelID,h.Nombre,h.Precio,h.Calificacion,h.Descripcion,h.Ubicacion,
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                    'IMG',hm.img_url
                )
            )FROM Hotel_Multimedia hm JOIN Hotel h on hm.HotelID=h.HotelID WHERE ) AS IMG
            FROM Hoteles h;";
*/
        $sql="SELECT h.HotelID,h.Nombre,h.Precio,h.Calificacion,h.Descripcion,h.Ubicacion,hm.img_url
             FROM Hoteles h
             JOIN Hotel_Multimedia hm on h.HotelID=hm.HotelID;";
        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrHotel= $result->fetch_all(MYSQLI_ASSOC);

        $objArrHotel =[];

        foreach ($arrHotel as $hotel){

            $newHotel=new Hotel($hotel["HotelID"],$hotel["Nombre"],$hotel["Precio"],$hotel["Calificacion"],$hotel["Descripcion"],$hotel["Ubicacion"]);
            $newHotel->setIMG($hotel["img_url"]);
            $objArrHotel[]=$newHotel;
        }

        return $objArrHotel;
    }

    /************************ FILTRADO: PRECIO,CALIFICACION,UBICACION *****************************/

    /*public function (){

    }*/

}


?>