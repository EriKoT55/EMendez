<?php

class Country
{

    private $Code, $Name, $Population, $GNP, $Capital, $UserId, $Languages, $Cities;

    /**
     * @param $Code
     * @param $Name
     * @param $Population
     * @param $GNP
     * @param $Capital
     * @param $UserId
     */
    public function __construct( $Code, $Name, $Population, $GNP, $Capital, $UserId )
    {
        $this->Code =(string)$Code;
        $this->Name =(string) $Name;
        $this->Population =(int) $Population;
        $this->GNP = (int)$GNP;
        $this->Capital = (string)$Capital;
        $this->UserId = (int)$UserId;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @param string $Code
     */
    public function setCode( $Code )
    {
        $this->Code = $Code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName( $Name )
    {
        $this->Name = $Name;
    }

    /**
     * @return int
     */
    public function getPopulation()
    {
        return $this->Population;
    }

    /**
     * @param int $Population
     */
    public function setPopulation( $Population )
    {
        $this->Population = $Population;
    }

    /**
     * @return int
     */
    public function getGNP()
    {
        return $this->GNP;
    }

    /**
     * @param int $GNP
     */
    public function setGNP( $GNP )
    {
        $this->GNP = $GNP;
    }

    /**
     * @return string
     */
    public function getCapital()
    {
        return $this->Capital;
    }

    /**
     * @param string $Capital
     */
    public function setCapital( $Capital )
    {
        $this->Capital = $Capital;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->UserId;
    }

    /**
     * @param int $UserId
     */
    public function setUserId( $UserId )
    {
        $this->UserId = $UserId;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->Languages;
    }

    /**
     * @param mixed $Languages
     */
    public function setLanguages( $Languages )
    {
        $this->Languages = $Languages;
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
    public function setCities( $Cities )
    {
        $this->Cities = $Cities;
    }

}