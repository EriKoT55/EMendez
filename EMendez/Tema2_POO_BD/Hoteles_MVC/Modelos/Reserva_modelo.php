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

        $sql = "INSERT INTO Hotel_Reserva (Fecha_entrada,Fecha_salida,HabitacionID,UsuarioID,Huespedes) VALUES ('" . $entrada . "','" . $salida . "'," . $habitacionID . "," . $usuarioID . "," . $huespedes . ")";

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

        /** PODRIA HACER UN hh.numHuespedes BETWEEN hh.numHuespedes and $huespedes
         * para así tener las habitaciones con ese numero de personas, pero tiene pinta que hare algo parecido
         * a las fechas, ya que un numero entre 3 y 5 es 4 y si el usuario mete 5 personas
         * una habitacion de 4 no bastara.
         */

/* DEVUELVE LAS NO DISPONIBLES*/ /** $arrResHab */
        $sql = "SELECT hh.*,hr.Fecha_entrada,hr.Fecha_salida FROM Hotel_Reserva hr 
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                WHERE hh.HotelID= " . $hotelID . "/*AND WHERE hh.numHuespedes=huespedes*/ AND( 
                (hr.Fecha_entrada BETWEEN '" . $entrada . "' and '" . $salida . "')
                OR 
                (hr.Fecha_salida BETWEEN '" . $entrada . "' and '" . $salida . "')
                OR
                ('" . $entrada . "' BETWEEN hr.Fecha_entrada and hr.Fecha_salida)
                OR
                ('" . $salida . "' BETWEEN hr.Fecha_entrada and hr.Fecha_salida));";

/* DEVUELVE TODAS LAS HABITACIONES*/ /** $arrHab */
        $sql2 = "SELECT * FROM Hotel_Habitaciones WHERE HotelID= " . $hotelID . ";";

/* DEVUELVE TODAS LAS RESERVADAS HABITACIONES */ /** $arrResHab1 */
        $sql1="SELECT hh.*,hr.Fecha_entrada,hr.Fecha_salida FROM Hotel_Reserva hr 
                JOIN Hotel_Habitaciones hh on hr.HabitacionID=hh.HabitacionID
                WHERE hh.HotelID= " . $hotelID . " ;";

        $this->bd->default();
        $result = $this->bd->query( $sql );

        $result1 = $this->bd->query( $sql1 );

        $result2 = $this->bd->query( $sql2 );
        $this->bd->close();

        $arrResHab = $result->fetch_all( MYSQLI_ASSOC );
        $arrResHab1 = $result1->fetch_all( MYSQLI_ASSOC );
        $arrHab = $result2->fetch_all( MYSQLI_ASSOC );


// SI NO HAY RESERVAS PARA ESAS FECHAS, SIGNIFICA QUE HAY DISPO ENTONCES TRUE, ENTRA AL IF, ENTRA AL BUCLE Y EMPIEZA A COMPARAR
// SI HAY ALGUN ID DIFERENTE, ESO QUE ES QUE HAY DISPO TRUE
        $objArrHabitacion = [];
        if( count( $arrResHab ) > 0 ) {
                for( $j = 0; $j < count( $arrResHab ); $j++ ) {
                    if( $arrResHab1[$j]["HabitacionID"]==$arrResHab[$j]["HabitacionID"] ) {
                       $dispo=false;
                    } else {
                        $dispo=true;
                    }
                }
        }else{
            $dispo=true;
        }
        if($dispo==true){
            $i=0;
            /** PROBLEMA
             * ME RECORRE LOS ARRAYS, EN EL PRIMER ARRAY ESTA EL 1 Y EL 8 Y EN EL SEGUNDO 1 2 3 7 8
             * PRIMERA VUELTA 1 ES DIFERENTE DE 1 NO, ENTONCES NO LO METE,
             * SEGUNDA VUELTA 8 ES DIFERENTE DE 2 SI, ME LO METE YA EL RESTO ENTRAN
             * ME ENTRA UNO QUE NO QUIERO EL 8
             * POR QUE EL ARRAY RECORRE 1 A 1, COMO PODRIA HACER QUE RECORRIENDO UNO A UNO ME QUITARA EL 8,
             * SIN CONTAR QUE AL  HABER MAS HABITACIONES QUE RESERVAS PETA EL arrResHab
             */
            $reservNoDisp=[];
            $totalHabs=[];
            $habsDispo=[];
            foreach( $arrHab as $habs ) {
                //AQUI ESTABA DESESPERADO, para que no pete arrResHab y salga del bucle, tampoco funciona
                if($i==count($arrHab)){
                    break;
                }
                $reservNoDisp=$arrResHab[$i]["HabitacionID"];
                $totalHabs=$habs["HabitacionID"];
//SI LOS ID'S DE LAS HABTIACIONES RESERVADAS SON DIFERENTES A LOS ID'S DE LAS HABITACIONES, me crea los objetos que son diferentes a las reservas
                /** https://www.w3schools.com/php/func_array_diff.asp */
                /*$habsDispo[]=array_diff($reservNoDisp, $totalHabs);*/
                /*$arrResHab[$i]["HabitacionID"] != $habs["HabitacionID"] */
                //AQUI ESTAN LAS HABITACIONES CON DISPO, PERO TENGO EL MISMO PROBLEMA AHORA DEBO COMPARARLAS
                // Y 1 ES DIFERENTE DE 2 YA NO ENTRARIA
                $habsDispo=array_diff($reservNoDisp, $totalHabs);
                if($habsDispo[$i]) {
                    $objArrHabitacion[] = new Habitacion( $habs["HabitacionID"], $habs["HotelID"], $habs["numHuespedes"], $habs["numHabitacion"] );
                }
                $i++;
            }
            return $objArrHabitacion;
        }else{
            return new Habitacion(0,0,0,0);
        }

        /** Necesito ir sumando uno en la Fecha_entrada hasta llegar a Fecha_salida O NO, PODRIA PLANTEARLO DE OTRA MANERA **/
        /** entre DateTime metere la feha salida y entrada */
        /* $fechaSalida = new DateTime();
        $fechaEntrada = new DateTime();
        https://stackoverflow.com/questions/2040560/finding-the-number-of-days-between-two-dates
        $result = $fechaEntrada->diff($fechaSalida)->format("%r%a");*/
    }


    public function numHabitacion($habID)
    {
        //HACER QUIERO COGER EL NUMERO DE LA HABITACION PARA CUANDO SE INSERTE LA RESERVA MOSTRAR ESE NUMERO AL USUARIO
        $sql = "SELECT numHabitacion FROM Hotel_Habitaciones WHERE HabitacionID=".$habID." ;";
        $this->bd->default();
        $result = $this->bd->query( $sql );
        $this->bd->close();
        $arrNumHabitacion = $result->fetch_all( MYSQLI_ASSOC );

        return $arrNumHabitacion;
    }

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