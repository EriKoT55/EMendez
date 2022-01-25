<?php

class Country
{

    private $Code,$Name,$Population,$GNP,$Capital,$Userid,$Lenguage,$Cities;

    /**
     * @param $Code
     * @param $Name
     * @param $Population
     * @param $GNP
     * @param $Capital
     * @param $Userid
     */
    public function __construct($Code, $Name, $Population, $GNP, $Capital, $Userid)
    {
        $this->Code = $Code;
        $this->Name = $Name;
        $this->Population = $Population;
        $this->GNP = $GNP;
        $this->Capital = $Capital;
        $this->Userid = $Userid;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @param mixed $Code
     */
    public function setCode($Code)
    {
        $this->Code = $Code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->Population;
    }

    /**
     * @param mixed $Population
     */
    public function setPopulation($Population)
    {
        $this->Population = $Population;
    }

    /**
     * @return mixed
     */
    public function getGNP()
    {
        return $this->GNP;
    }

    /**
     * @param mixed $GNP
     */
    public function setGNP($GNP)
    {
        $this->GNP = $GNP;
    }

    /**
     * @return mixed
     */
    public function getCapital()
    {
        return $this->Capital;
    }

    /**
     * @param mixed $Capital
     */
    public function setCapital($Capital)
    {
        $this->Capital = $Capital;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->Userid;
    }

    /**
     * @param mixed $Userid
     */
    public function setUserid($Userid)
    {
        $this->Userid = $Userid;
    }

    /**
     * @return mixed
     */
    public function getLenguage()
    {
        return $this->Lenguage;
    }

    /**
     * @param mixed $Lenguage
     */
    public function setLenguage($Lenguage): void
    {
        $this->Lenguage = $Lenguage;
    }

    /**
     * @return mixed
     */
    public function getCities()
    {
        return $this->Cities;
    }

    /**
     * @param mixed $Cities
     */
    public function setCities($Cities): void
    {
        $this->Cities = $Cities;
    }

}