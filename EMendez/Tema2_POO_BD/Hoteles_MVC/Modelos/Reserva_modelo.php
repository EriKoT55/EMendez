<?php
require_once( "../BD/bd.php" );
require_once ("../A_Entidades/Habitacion.php");

//asdf
class Reserva_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();
    }

    public function InsertReserv( $entrada, $salida, $habitacionID, $usuarioID, $huespedes ): bool
    {

        $sql = "INSERT INTO (Fecha_entrada,Fecha_salida,HabitacionID,UsuarioID,Huespedes) VALUES (" . $entrada . "," . $salida . "," . $habitacionID . "," . $usuarioID . "," . $huespedes . ")";

        $this->bd->default();

        if( $this->bd->query( $sql )==true ) {
            return true;
        } else {
            return false;
        }

        $this->bd->close();

    }

    public function ComprobarDisponibilidad( $entrada, $salida, $hotelID /*,$huespedes*/ )
    {

        /** explicación de la query
         * https://stackoverflow.com/questions/2545947/check-overlap-of-date-ranges-in-mysql *
         */
        $sql = "SELECT hh.HabitacionID,hr.Fecha_entrada,hr.Fecha_salida FROM Hotel_Reserva hr 
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                WHERE hh.HotelID= " . $hotelID . " AND( 
                (hr.Fecha_entrada BETWEEN '" . $entrada . "' and '" . $salida . "')
                OR 
                (hr.Fecha_salida BETWEEN '" . $entrada . "' and '" . $salida . "')
                OR
                ('" . $entrada . "' BETWEEN hr.Fecha_entrada and hr.Fecha_salida)
                OR
                ('" . $salida . "' BETWEEN hr.Fecha_entrada and hr.Fecha_salida));";

        $sql1 = "SELECT * FROM Hotel_Habitaciones WHERE HotelID= " . $hotelID . ";";

        /*$sql2="SELECT hh.HabitacionID,hr.Fecha_entrada,hr.Fecha_Salida FROM Hotel_Reserva hr
                        JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                        WHERE hh.HotelID= ".$hotelID.";";*/

        $this->bd->default();
        $result = $this->bd->query( $sql );

        $result1 = $this->bd->query( $sql1 );

        //$result2=$this->bd->query( $sql2 );
        $this->bd->close();

        $arrResHab = $result->fetch_all( MYSQLI_ASSOC );
        $arrResHab1 = $result1->fetch_all( MYSQLI_ASSOC );
        /*$arrResHab2=$result2->fetch_all(MYSQLI_ASSOC);*/

        /** HECHO
         * COGER LO QUE ME DEVUELVE EL SQL (QUE SON LAS HABITACIONES NO DISPONIBLES EN ESE RANGO DE FECHAS)
         * AHORA HARIA UNA SELECT CON TODAS LAS HABITACIONES Y COMPARARIA LOS ID'S DE LAS NO DISPOBLES CON EL TOTAL
         */

        /** problema AL INSERTAR LA RESERVA DEBO INTRODUCIR HABITACIONID, PARA ELLO
         *  DEBERIA CREAR EL OBJETO HABITACION PARA DEVOLVER EL NUMERO DE LA HABITACION Y DICHA ID
         * PROBLEMA, con la comparacion anterior entre ID's solo se comparan los que estan en reserva cuando en HABITACIONID hay mas, por lo tanto no cerare un
         * OBJETO HABITACION COMPLETO,
         *
         * SI QUITARA LAS FECHAS DE LOS DOS SELECTS Y COMPARARA LOS ID'S, iria bien hasta que estuvieran todas las habitaciones reservadas, en ese entonces
         * deberia comparar fechas, pero claro no podria comparar fechas por que si las introduzco en la consulta lo anterior no se podra hacer, y estare en el punto inicial
         *
         * PODRIA CREAR OTRA CONSULTA CON LA CUAL SE COMPROBARA, SI LOS ID'S DE LAS HABITACIONES SON DIFERENTES, LAS FECHAS DE ESTOS SI SON IGUALES DEVUELVE OBJ USR 0 SINO OBJUSR
         *
         * CUANDO CONSIGA  LE DARE UNA HABITACION, QUE NO ESTE ENTRE ESAS FECHAS Y SEA RANDOM DEL OBJETO
         */
// SI NO HAY RESERVAS PARA ESAS FECHAS, SIGNIFICA QUE HAY DISPO ENTONCES TRUE, SINO ENTRA AL BUCLE Y EMPIEZA A COMPARAR
        if( count( $arrResHab ) > 0 ) {
            $objArrHabitacion = [];
            for( $i = 0; $i < count( $arrResHab1 ); $i++ ) {
                for( $j = 0; $j < count( $arrResHab ); $j++ ) {
                    //NO SE SI PONER EL 3 BUCLE AQUI
                    if( $arrResHab1[$i]["HabitacionID"]==$arrResHab[$j]["HabitacionID"] ) {
                        return new Habitacion( 0, 0, 0, 0 );
                    } else {
                        //O AQUI
                        /*for($k=0;$k<count($arrResHab2);$k++) {
                            //CREO QUE ASI LA COMPARACION NO FUNCIONARA
                            if( $arrResHab1[$j]["Fecha_entrada"]==$arrResHab[$k]["Fecha_entrada"] && $arrResHab1[$j]["Fecha_salida"]==$arrResHab[$k]["Fecha_salida"] ) {
                                return false;
                            }*/

                        $objArrHabitacion[$i] = new Habitacion( $arrResHab1[$i]["HabitacionID"], $arrResHab1[$i]["HotelID"], $arrResHab1[$i]["numHuespedes"], $arrResHab1[$i]["numHabitacion"] );
                        //NO SE SI QUITAR LOS CORCHETES o ponerle corchetes
                        return $objArrHabitacion;
                    }
                }
            }
        } else {
            //COMO NO HAY HABITACIONES RESERVADAS PUEDO DARLE CUALQUIERA TODAS ESTAN DISPONIBLES
            foreach( $arrResHab1 as $reshab1 ) {
                $objArrHabitacion[] = new Habitacion( $reshab1["HabitacionID"], $reshab1["HotelID"], $reshab1["numHuespedes"], $reshab1["numHabitacion"] );
            }
            //SUPUESTAMENTE ESTOY DEVOLVIENDO UN OBJ, pero me devuelve un array
            return $objArrHabitacion;
        }


        /** Necesito ir sumando uno en la Fecha_entrada hasta llegar a Fecha_salida O NO, PODRIA PLANTEARLO DE OTRA MANERA **/
        /** entre DateTime metere la feha salida y entrada */
        /* $fechaSalida = new DateTime();
        $fechaEntrada = new DateTime();
        https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
        $result = $fechaEntrada->diff($fechaSalida)->format("%r%a");*/
    }

    /*ESTO IRA DENTRO DE LA COMPROBACION QUE SERA LA QUE DEVUELVA EL HOTEL ID Y EL NUMERO DE LA HABITACION
    public function numHabitacion( $entrada, $salida, $hotelID, $huespedes )
    {
        //HACER QUIERO COGER EL NUMERO DE LA HABITACION PARA CUANDO SE INSERTE LA RESERVA MOSTRAR ESE NUMERO AL USUARIO
        $sql1 = "SELECT hh.numHabitacion,hh.HabitacionID FROM Hotel_Reserva hr
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID WHERE
                 hh.HotelID=" . $hotelID . " AND hr.Huespedes=" . $huespedes . ";";

        $result = $this->bd->query( $sql1 );
        $arrNumHabitacion = $result->fetch_all( MYSQLI_ASSOC );

        return $arrNumHabitacion;
    }*/

    /** NO DEVUELVE NADA , POR QUE LE PASO EN LA CONDICION UN ARRAY, PERO NO DA ERROR, PORQUE ESTA EN UNA FILA,
     * AHORA COMO HAGO PARA QUE EL WHERE ENTRE EN EL ARRAY
     *
     * SELECT * FROM Hotel_Habitaciones WHERE HotelID=1 AND HabitacionID=(SELECT JSON_ARRAYAGG(
     * JSON_OBJECT(
     * 'hID',hh.HabitacionID
     * ))FROM Hotel_Reserva hr
     * JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
     * WHERE hh.HotelID=1 AND(
     * (hr.Fecha_entrada BETWEEN '2022-01-31' and '2022-02-07')
     * OR
     * (hr.Fecha_salida BETWEEN '2022-01-31' and '2022-02-07')
     * OR
     * ('2022-01-31' BETWEEN hr.Fecha_entrada and hr.Fecha_salida)
     * OR
     * ('2022-02-07' BETWEEN hr.Fecha_entrada and hr.Fecha_salida)));
     */
}