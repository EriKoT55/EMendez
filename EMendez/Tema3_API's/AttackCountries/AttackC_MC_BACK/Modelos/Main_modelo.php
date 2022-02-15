<?php
require_once("../BD/db.php");
require_once("../A_Entidades/Country.php");

class Main_modelo
{

    private db $db;

    public function __construct()
    {

        $this->db = new db();

    }

    public function getCountries()
    {
        $sql = "SELECT co1.*,
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'language',cl.Language 
                )
            )FROM countrylanguages cl JOIN countries co2 on cl.CountryCode=co2.Code WHERE co2.Code=co1.Code)as language,
             (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'Owner',u.Mail 
                )
            )FROM users u JOIN countries co2 on u.Id=co2.UserId WHERE co2.Code=co1.Code)as Owner,
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'cityName',ci.Name
                )
                )FROM cities ci JOIN countries co2 on ci.CountryCode=co2.Code WHERE co2.Code=co1.Code)as cityName
            FROM countries co1";

        $this->db->default();
        $result=$this->db->query($sql);
        $this->db->close();

        $arrCountries= $result->fetch_all(MYSQLI_ASSOC);

        $objArrCountries=[];

        foreach($arrCountries as $country){

            $newCountry= new Country($country["Code"],$country["Name"],$country["Population"],$country["GNP"],$country["Capital"],$country["UserId"]);
            $newCountry->setLenguage(json_decode($country["language"],true));
            $newCountry->setOwner(json_decode($country["Owner"],true));
            $newCountry->setCityName(json_decode($country["cityName"],true));
            $objArrCountries[]=$newCountry;

        }

        return $objArrCountries;

    }

    public function getCountriesUsr($usrID){

        $sql = "SELECT co1.*, 
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'language',cl.Language 
                )
            )FROM countrylanguages cl JOIN countries co2 on cl.CountryCode=co2.Code WHERE co2.Code=co1.Code)as language,
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'cityName',ci.Name
                )
                )FROM cities ci JOIN countries co2 on ci.CountryCode=co2.Code WHERE co2.Code=co1.Code)as cityName
            FROM countries co1 WHERE co1.UserID=".$usrID.";";

        $this->db->default();
        $result=$this->db->query($sql);
        $this->db->close();

        $arrCountriesUsr= $result->fetch_all(MYSQLI_ASSOC);

        $objArrCountriesUsr=[];

        foreach($arrCountriesUsr as $country){

            $newCountry= new Country($country["Code"],$country["Name"],$country["Population"],$country["GNP"],$country["Capital"],$country["UserId"]);
            $newCountry->setLenguage(json_decode($country["language"],true));
            $newCountry->setCityName(json_decode($country["cityName"],true));
            $objArrCountriesUsr[]=$newCountry;

        }

        return $objArrCountriesUsr;

    }

    public function getCountryAtk($code){

        $sql = "SELECT co1.*, 
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'language',cl.Language 
                )
            )FROM countrylanguages cl JOIN countries co2 on cl.CountryCode=co2.Code WHERE co2.Code=co1.Code)as language,
            (SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                'cityName',ci.Name
                )
                )FROM cities ci JOIN countries co2 on ci.CountryCode=co2.Code WHERE co2.Code=co1.Code)as cityName
            FROM countries co1 WHERE co1.Code='".$code."';";

        $this->db->default();
        $result=$this->db->query($sql);
        $this->db->close();

        $arrCountriesUsr= $result->fetch_all(MYSQLI_ASSOC);

        $objArrCountriesAtk=[];

        foreach($arrCountriesUsr as $country){

            $newCountry= new Country($country["Code"],$country["Name"],$country["Population"],$country["GNP"],$country["Capital"],$country["UserId"]);
            $newCountry->setLenguage(json_decode($country["language"],true));
            $newCountry->setCityName(json_decode($country["cityName"],true));
            $objArrCountriesAtk[]=$newCountry;

        }

        return $objArrCountriesAtk;

    }

    public function updATKCountry($userID,$code){

        $sql="UPDATE countries SET UserId=".$userID." WHERE Code='".$code."';";

        $this->db->default();
        $this->db->query($sql);
        $this->db->close();

    }

}