<?php
/*
 * https://www.logitravel.com/hoteles/espana/madrid--eyJjaXR5IjoiNDUyMiJ9
 *
 * https://victorroblesweb.es/2013/11/18/tutorial-mvc-en-php-nativo/
 *
 * https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/
 */
class Hotel{
    private $bd;
    private $HotelID, $Nombre, $Precio, $Calificacion, $IMG, $Descripcion;

    public function __contruct($HotelID, $Nombre, $Precio, $Calificacion, $IMG, $Descripcion){

        $this->HotelID=(int) $HotelID;
        $this->Nombre=(string) $Nombre;
        $this->Precio=(float) $Precio;
        $this->Calificacion=(float) $Calificacion;
        $this->IMG=(string) $IMG;
        $this->Descripcion=(string) $Descripcion;

        require_once ("../BD/bd.php");
        $this->bd=Conexion::conn();

    }

}


?>