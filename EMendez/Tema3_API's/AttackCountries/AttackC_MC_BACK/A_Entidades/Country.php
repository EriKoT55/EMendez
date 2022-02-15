<?php

class Country
{

    public $Code,$Name,$Population,$GNP,$Capital,$UserId,$Lenguage,$CityName,$Owner;

    /**
     * @param $Code
     * @param $Name
     * @param $Populatio
     * @param $GNP
     * @param $Capital
     * @param $UserId
     */
    public function __construct($Code, $Name, $Population, $GNP, $Capital, $UserId)
    {
        $this->Code =(string) $Code;
        $this->Name =(string) $Name;
        $this->Population =(int) $Population;
        $this->GNP =(int) $GNP;
        $this->Capital =(string) $Capital;
        $this->UserId =(int) $UserId;

    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->Code;
    }

    /**
     * @param string $Code
     */
    public function setCode(string $Code): void
    {
        $this->Code = $Code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->Population;
    }

    /**
     * @param int $Population
     */
    public function setPopulatio(int $Population): void
    {
        $this->Population = $Population;
    }

    /**
     * @return int
     */
    public function getGNP(): int
    {
        return $this->GNP;
    }

    /**
     * @param int $GNP
     */
    public function setGNP(int $GNP): void
    {
        $this->GNP = $GNP;
    }

    /**
     * @return string
     */
    public function getCapital(): string
    {
        return $this->Capital;
    }

    /**
     * @param string $Capital
     */
    public function setCapital(string $Capital): void
    {
        $this->Capital = $Capital;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->UserId;
    }

    /**
     * @param int $UserId
     */
    public function setUserId(int $UserId): void
    {
        $this->UserId = $UserId;
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
    public function getCityName()
    {
        return $this->CityName;
    }

    /**
     * @param mixed $CityName
     */
    public function setCityName($CityName): void
    {
        $this->CityName = $CityName;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->Owner;
    }

    /**
     * @param mixed $Owner
     */
    public function setOwner( $Owner )
    {
        $this->Owner = $Owner;
    }

}