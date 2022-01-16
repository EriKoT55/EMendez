<?php
require_once ("../BD/bd.php");

class Reserva_modelo
{

    private bd $bd;

    public function __construct(){

        $this->bd=new bd();
    }

    /** INSERTAR RESERVA POR FECHA_ENTRADA, FECHA_SALIDA Y HUESPEDES
     *  COMPROBAR SI ES POSIBLE LA RESERVA, NO SE SI EN LA MISMA FUNCION O EN OTRA
     */


}