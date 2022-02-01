<?php
require_once ("../BD/bd.php");
require_once ("../A_Entidades/Country.php");

class Main_modelo
{

    private bd $bd;


    public function __construct( )
    {
        $this->bd = new bd();
    }

    public function getCountries(){

        $sql="SELECT co1.*,
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
               'leng',cl.Language
            )
            )FROM countrylanguages cl JOIN countries co2 on cl.CountryCode=co2.Code WHERE co2.Code=co1.Code) as 'leng',
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
            'city',ci.Name
            )
            )FROM cities ci JOIN countries co2 on ci.CountryCode=co2.Code WHERE co2.Code=co1.Code) as 'city'
         FROM countries co1;";

        $this->bd->default();

        $result=$this->bd->query($sql);

        $this->bd->close();

        $arrCountries=$result->fetch_all(MYSQLI_ASSOC);

        $objArrCountries=[];

        foreach($arrCountries as $arrCountry){

            $newCountry= new Country($arrCountry["Code"],$arrCountry["Name"],$arrCountry["Population"],$arrCountry["GNP"],$arrCountry["Capital"],$arrCountry["UserId"]);
            $newCountry->setLanguages(json_decode($arrCountry["leng"],true));
            $newCountry->setCities(json_decode($arrCountry["city"],true));
            $objArrCountries[]=$newCountry;
        }

        return $objArrCountries;

    }

    public function getCountryUser($userID){

        $sql="SELECT co1.*,
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
               'leng',cl.Language
            )
            )FROM countrylanguages cl JOIN countries co2 on cl.CountryCode=co2.Code WHERE co2.Code=co1.Code) as 'leng',
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
            'city',ci.Name
            )
            )FROM cities ci JOIN countries co2 on ci.CountryCode=co2.Code WHERE co2.Code=co1.Code) as 'city'
         FROM countries co1 WHERE co1.UserId=".$userID.";";

        $this->bd->default();

        $result=$this->bd->query($sql);

        $this->bd->close();

        $arrCountries=$result->fetch_all(MYSQLI_ASSOC);

        $objArrCountries=[];

        foreach($arrCountries as $arrCountry){

            $newCountry= new Country($arrCountry["Code"],$arrCountry["Name"],$arrCountry["Population"],$arrCountry["GNP"],$arrCountry["Capital"],$arrCountry["UserId"]);
            $newCountry->setLanguages(json_decode($arrCountry["leng"],true));
            $newCountry->setCities(json_decode($arrCountry["city"],true));
            $objArrCountries[]=$newCountry;
        }

        return $objArrCountries;

    }

    public function getCountryNPC($code){

        $sql="SELECT co1.*,
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
               'leng',cl.Language
            )
            )FROM countrylanguages cl JOIN countries co2 on cl.CountryCode=co2.Code WHERE co2.Code=co1.Code) as 'leng',
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
            'city',ci.Name
            )
            )FROM cities ci JOIN countries co2 on ci.CountryCode=co2.Code WHERE co2.Code=co1.Code) as 'city'
         FROM countries co1 WHERE co1.Code='".$code."';";

        $this->bd->default();

        $result=$this->bd->query($sql);

        $this->bd->close();

        $arrCountries=$result->fetch_all(MYSQLI_ASSOC);

        $objArrCountries=[];

        foreach($arrCountries as $arrCountry){

            $newCountry= new Country($arrCountry["Code"],$arrCountry["Name"],$arrCountry["Population"],$arrCountry["GNP"],$arrCountry["Capital"],$arrCountry["UserId"]);
            $newCountry->setLanguages(json_decode($arrCountry["leng"],true));
            $newCountry->setCities(json_decode($arrCountry["city"],true));
            $objArrCountries[]=$newCountry;
        }

        return $objArrCountries;

    }

    public function userXcountry($userID){

        $sql="SELECT Mail FROM users WHERE Id=".$userID.";";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrMail=$result->fetch_all(MYSQLI_ASSOC);

        return $arrMail[0]["Mail"];

    }

    public function countryATK($userID,$code){

        $sql="UPDATE countries SET UserId = ".$userID." WHERE Code like '".$code."' ";

        $this->bd->default();
        if($this->bd->query($sql)){

        }
        $this->bd->close();
    }

}