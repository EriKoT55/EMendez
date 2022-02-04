<?php
require_once( "../BD/bd.php" );
require_once ("../A_Entidades/Habitacion.php");


class Reserva_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();
    }

    /**
     * @param $entrada
     * @param $salida
     * @param $habitacionID
     * @param $usuarioID
     * @param $huespedes
     * @return bool
     */
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

    /** VA SUMANDO SI HAY DISPO O NO, SI HAY MAS DISPO ENTRARA EN EL IF Y DEVOLVERA LAS HABITACIONES DISPONIBLES
     * @param $entrada
     * @param $salida
     * @param $hotelID
     * @return array
     */
    public function ComprobarDisponibilidad( $entrada, $salida, $hotelID /*,$huespedes*/)
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

        $numDispo=0;
        $numNoDispo=0;
        if( count( $arrResHab ) > 0 ) {
            for( $j = 0; $j < count( $arrResHab ); $j++ ) {
                //$dispo = true;
                for($k=0;$k<count($arrResHab1);$k++) {
                    if( $arrResHab1[$k]["HabitacionID"]==$arrResHab[$j]["HabitacionID"] ) {
                        //$dispo = false;
                        $numNoDispo++;
                    } else {
                        //$dispo = true;
                        $numDispo++;
                    }
                }
            }
        }else{
            //$dispo=true;
            $numDispo++;
        }

        if($numDispo>$numNoDispo){
           /** FUNCIONAMIENTO
            * EJEMPLO:
            * EN EL PRIMER ARRAY TENGO 1,2,3,7,8 Y EN EL SEGUNDO 1,3,7,8
            * DENTRO DEL PRIMER BUCLE CREO UN BOOLEANO, COMIENZA COMO DIFF=TRUE, SI SON IGUALES, NO SON DIFERENTES ENTONCES FALSE
            * VUELTA CERO DE $i VUELTA CERO de $j 1 ES IGUAL A 1, SON IGUALES ENTONCES, NO SON DIFERENTES, FALSE
            * VUELTA CERO DE $i VUELTA UNO DE $j 1 ES DIFERENTE DE 3, ENTONCES diff=true
            * VUELTA CERO DE $i VUELTA DOS DE $j 1 ES DIFERENTE DE 7, ENTONCES diff=true
            * VUELTA CERO DE $i VUELTA TRES DE $j 1 ES DIFERENTE DE 8, ENTONCES diff=true
            * AL HABER HECHO LA VUELTA CERO DE $i en $j DEVUELVE FALSE YA QUE HABIA UNO IGUAL A UNO LOS VALORES
            * ENTONCES NO METE NINGUNO,
            * COMIENZA LA VUELTA UNO, DEVOLVERA TRUE SI EN ALGUNA VUELTA ENCUENTRA ALGUN VALOR QUE NO SE REPITA
            */
            $objArrHabitacion=[];

            for($i=0;$i<count($arrHab);$i++){
                $diff=true;
                //ANTES IGUALABA $j a $i y ese era el problema
                for($j=0;$j<count($arrResHab);$j++){
                    if($arrResHab[$j]["HabitacionID"]==$arrHab[$i]["HabitacionID"]){
                        $diff=false;
                        break;
                    }
                }
                if( $diff==true) {
                    //Lo meto en un array para no tener problema al cogerlo en el controlador.
                    $objArrHabitacion[] = new Habitacion($arrHab[$i]["HabitacionID"], $arrHab[$i]["HotelID"], $arrHab[$i]["numHuespedes"], $arrHab[$i]["numHuespedes"]);
                }

            }

            return $objArrHabitacion;

        }else {
            $objArrHabitacion[]= new Habitacion(0, 0, 0, 0);
            return $objArrHabitacion;
        }

    }

    /**
     * @param $habID
     * @return array|mixed
     */
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