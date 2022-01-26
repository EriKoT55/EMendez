<?php
require_once("../BD/bd.php");
require_once("../A_Entidades/Country.php");
require_once("../A_Entidades/User.php");

class Main_modelo
{
    private bd $bd;


    public function __construct()
    {
        $this->bd = new bd();

    }

    public function getCountries()
    {

        $sql = "SELECT co2.*,
	        (SELECT JSON_ARRAYAGG(
		        JSON_OBJECT(
			    'lenguage',cl.Language   
			    )
	        )FROM countrylanguages cl JOIN countries co1 on cl.CountryCode=co1.Code WHERE co1.Code = co2.Code) AS lenguage,
            (SELECT JSON_ARRAYAGG(
		        JSON_OBJECT(
			    'nameCities',ci.Name   
			    )
	        )FROM cities ci JOIN countries co1 on ci.CountryCode=co1.Code WHERE co1.Code = co2.Code) AS cities
	        FROM countries co2 
           ";

        $this->bd->default();
        $result = $this->bd->query($sql);
        $this->bd->close();

        $arrCountries=$result->fetch_all(MYSQLI_ASSOC);

        $countriesArrObj=[];

        foreach ($arrCountries AS $countries){

            $newCountry= new Country($countries["Code"],$countries["Name"],$countries["Population"],$countries["GNP"],$countries["Capital"],$countries["UserId"]);
            $newCountry->setLenguage(json_decode($countries["lenguage"],true));
            $newCountry->setCities(json_decode($countries["cities"],true));
            $countriesArrObj[]=$newCountry;

        }
        return $countriesArrObj;
    }

    public function getCountry($userID)
    {

        $sql = "SELECT co.*,
	        (SELECT JSON_ARRAYAGG(
		        JSON_OBJECT(
			    'lenguage',cl.Language   
			    )
	        )FROM countrylanguages cl JOIN countries co1 on cl.CountryCode=co1.Code WHERE co1.UserId = '".$userID."') AS lenguage,
            (SELECT JSON_ARRAYAGG(
		        JSON_OBJECT(
			    'nameCities',ci.Name   
			    )
	        )FROM cities ci JOIN countries co1 on ci.CountryCode=co1.Code WHERE co1.UserId = '".$userID."') AS cities
	        FROM countries co
            WHERE co.UserId='".$userID."';
           ";

        $this->bd->default();
        $result = $this->bd->query($sql);
        $this->bd->close();

        $arrCountries=$result->fetch_all(MYSQLI_ASSOC);

        $countriesArrObj=[];

        foreach ($arrCountries AS $countries){

            $newCountry= new Country($countries["Code"],$countries["Name"],$countries["Population"],$countries["GNP"],$countries["Capital"],$countries["UserId"]);
            $newCountry->setLenguage(json_decode($countries["lenguage"],true));
            $newCountry->setCities(json_decode($countries["cities"],true));
            $countriesArrObj[]=$newCountry;

        }
        return $countriesArrObj;
    }

    public function getUserT($id){

        $this->bd->default();

        $sql="SELECT * FROM users WHERE Id = '".$id."';";

        $result=$this->bd->query($sql);
        $this->bd->close();
        $arrUser = $result->fetch_all(MYSQLI_ASSOC);

        $userObjArr = [];

        foreach ($arrUser as $user) {

            $userObjArr[] = new User($user["Id"], $user["Mail"], $user["Password"]);

        }
        return $userObjArr;

    }

}