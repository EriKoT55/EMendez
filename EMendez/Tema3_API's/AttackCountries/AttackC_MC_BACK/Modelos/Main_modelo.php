<?php
require_once("../BD/db.php");
require_once("../");

class Main_modelo
{

    private bd $bd;

    public function __construct()
    {

        $this->bd = new bd();

    }

    public function getCountries()
    {

        $sql = "";

    }

}