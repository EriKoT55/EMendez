<?php
require_once("../BD/bd.php");

class Reserva_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();
    }

    /** INSERTAR RESERVA POR FECHA_ENTRADA, FECHA_SALIDA Y HUESPEDES
     *  COMPROBAR SI ES POSIBLE LA RESERVA, NO SE SI EN LA MISMA FUNCION O EN OTRA
     */

    public function InsertReserv($entrada, $salida, $habitacionID, $usuarioID, $huespedes): bool
    {
        /** HACER QUIERO COGER EL NUMERO DE LA HABITACION PARA CUANDO SE INSERTE LA RESERVA MOSTRAR ESE NUMERO AL USUARIO */
        $sql1="SELECT hh.numHabitacion FROM Hotel_Reserva hr
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID";
        $sql = "INSERT INTO (Fecha_entrada,Fecha_salida,HabitacionID,UsuarioID,Huespedes) VALUES (" . $entrada . "," . $salida . "," . $habitacionID . "," . $usuarioID . "," . $huespedes . ")";


        $this->bd->default();

        if ($this->bd->query($sql) == true) {
            return true;
        } else {
            return false;
        }

        $this->bd->close();

    }

    public function ComprobarDisponibilidad($entrada, $salida, $hotelID, $huespedes)
    {

        $sql = "SELECT hh.numHabitacion FROM Hotel_Reserva hr 
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                WHERE hh.HotelID= ".$hotelID." AND hh.numHuespedes=".$huespedes." AND hr.Fecha_entrada BETWEEN '".$entrada."' and '".$salida."';";
        $this->bd->default();

       if($this->bd->query($sql)){
            return true;
       }else{
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

}