<?php
require_once( "../BD/bd.php" );

class Reserva_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();
    }

    public function InsertReserv( $entrada, $salida, $usuarioID, $huespedes ) : bool
    {

        $sql = "INSERT INTO (Fecha_entrada,Fecha_salida,UsuarioID,Huespedes) VALUES (" . $entrada . "," . $salida . "," . $usuarioID . "," . $huespedes . ")";

        $this->bd->default();

        if( $this->bd->query( $sql )==true ) {
            return true;
        } else {
            return false;
        }

        $this->bd->close();

    }

    public function ComprobarDisponibilidad( $entrada, $salida, $hotelID, $huespedes )
    {

        $sql = "SELECT hh.HotelID,hr.Fecha_entrada,hr.Fecha_salida,hr.Huespedes,hh.HabitacionID FROM Hotel_Reserva hr 
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                WHERE hh.HotelID= " . $hotelID . " AND hh.numHuespedes=" . $huespedes . " AND hr.Fecha_entrada BETWEEN '" . $entrada . "' and '" . $salida . "'
                AND hr.Fecha_salida BETWEEN '" . $entrada . "' and '" . $entrada . "';";

        $this->bd->default();

        if( $this->bd->query( $sql ) ) {
            return true;
        } else {
            return false;
        }

        //NO UTILIZADA TODAVIA
        //$arrHabiResv=$resultQ->fetch_all(MYSQLI_ASSOC);


        /** Necesito ir sumando uno en la Fecha_entrada hasta llegar a Fecha_salida O NO, PODRIA PLANTEARLO DE OTRA MANERA **/
        /** entre DateTime metere la feha salida y entrada */
        /* $fechaSalida = new DateTime();
        $fechaEntrada = new DateTime();
        https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
        $result = $fechaEntrada->diff($fechaSalida)->format("%r%a");*/
    }

    public function numHabitacion($entrada, $salida, $hotelID, $usuarioID, $huespedes){
        /** HACER QUIERO COGER EL NUMERO DE LA HABITACION PARA CUANDO SE INSERTE LA RESERVA MOSTRAR ESE NUMERO AL USUARIO */
        $sql1 = "SELECT hh.numHabitacion FROM Hotel_Reserva hr
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID WHERE hr.Fecha_entrada='" . $entrada . "' AND hr.Fecha_salida='" . $salida . "' AND
                 hh.HotelID=" . $hotelID . " AND hr.UsuarioID=" . $usuarioID . " AND hr.Huespedes=" . $huespedes . ";";

        $result=$this->bd->query($sql1);
        $arrNumHabitacion=$result->fetch_all(MYSQLI_ASSOC);

        return $arrNumHabitacion[0]["numHabitacion"];
    }

}