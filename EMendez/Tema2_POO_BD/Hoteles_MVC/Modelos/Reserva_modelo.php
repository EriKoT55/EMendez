<?php
require_once( "../BD/bd.php" );
//asdf
class Reserva_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();
    }

    public function InsertReserv( $entrada, $salida, $habitacionID, $usuarioID/*, $huespedes */) : bool
    {

        $sql = "INSERT INTO (Fecha_entrada,Fecha_salida,HabitacionID,UsuarioID,Huespedes) VALUES (" . $entrada . "," . $salida . ",".$habitacionID."," . $usuarioID . "," . $huespedes . ")";

        $this->bd->default();

        if( $this->bd->query( $sql )==true ) {
            return true;
        } else {
            return false;
        }

        $this->bd->close();

    }

    public function ComprobarDisponibilidad( $entrada, $salida, $hotelID /*,$huespedes*/)
    {

    /** explicación de la query
     * https://stackoverflow.com/questions/2545947/check-overlap-of-date-ranges-in-mysql *
     */
        $sql = "SELECT hh.HabitacionID,hr.Fecha_entrada,hr.Fecha_salida FROM Hotel_Reserva hr 
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                WHERE hh.HotelID= " . $hotelID . " AND( 
                (hr.Fecha_entrada BETWEEN '".$entrada."' and '".$salida."')
                OR 
                (hr.Fecha_salida BETWEEN '".$entrada."' and '".$salida."')
                OR
                ('".$entrada."' BETWEEN hr.Fecha_entrada and hr.Fecha_salida)
                OR
                ('".$salida."' BETWEEN hr.Fecha_entrada and hr.Fecha_salida));";

        $this->bd->default();
        $result=$this->bd->query( $sql );

        $arrResHab=$result->fetch_all(MYSQLI_ASSOC);
    /** QUEDA COGER LO QUE ME DEVUELVE EL SQL (QUE SON LAS HABITACIONES EN NO DISPONIBLES EN ESE RANGO DE FECHAS)
     * AHORA HARIA UNA SELECT CON TODAS LAS HABITACIONES Y COMPARARIA LOS ID'S DE LAS NO DISPOBLES CON EL TOTAL
     */
        foreach ($arrResHab as $resHab){
            if(){
                //aqui deberia estar el sql
            }
        }

        //NO UTILIZADA TODAVIAA
        //$arrHabiResv=$resultQ->fetch_all(MYSQLI_ASSOC);

        /** Necesito ir sumando uno en la Fecha_entrada hasta llegar a Fecha_salida O NO, PODRIA PLANTEARLO DE OTRA MANERA **/
        /** entre DateTime metere la feha salida y entrada */
        /* $fechaSalida = new DateTime();
        $fechaEntrada = new DateTime();
        https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
        $result = $fechaEntrada->diff($fechaSalida)->format("%r%a");*/
    }

    /* ESTO IRA DENTRO DE LA COMPROBACION QUE SERA LA QUE DEVUELVA EL HOTEL ID Y EL NUMERO DE LA HABITACION
     *
     public function numHabitacion($entrada, $salida, $hotelID, $usuarioID, $huespedes){
        /** HACER QUIERO COGER EL NUMERO DE LA HABITACION PARA CUANDO SE INSERTE LA RESERVA MOSTRAR ESE NUMERO AL USUARIO
        $sql1 = "SELECT hh.numHabitacion FROM Hotel_Reserva hr
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID WHERE hr.Fecha_entrada='" . $entrada . "' AND hr.Fecha_salida='" . $salida . "' AND
                 hh.HotelID=" . $hotelID . " AND hr.UsuarioID=" . $usuarioID . " AND hr.Huespedes=" . $huespedes . ";";

        $result=$this->bd->query($sql1);
        $arrNumHabitacion=$result->fetch_all(MYSQLI_ASSOC);

        return $arrNumHabitacion[0]["numHabitacion"];
    }*/

}