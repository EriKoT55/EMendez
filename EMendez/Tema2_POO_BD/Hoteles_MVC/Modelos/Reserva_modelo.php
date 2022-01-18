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

    public function InsertReserv($entrada,$salida,$huespedes){

        $sql="INSERT INTO (Fecha_entrada,Fecha_salida,Huespedes) VALUES (".$entrada.",".$salida.",".$huespedes.")";



        $this->bd->default();

        if($this->bd->query($sql)==true){
            return true;
        }else{
            return false;
        }

        $this->bd->close();

    }

    public function ComprobarDisponibilidad(){
        /** Necesito ir sumando uno en la Fecha_entrada hasta llegar a Fecha_salida  **/
        $sql="";



    }

}