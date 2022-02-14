<?php

class Ciudad
{

    public $Code,$Name,$Populatio,$GNP,$Capital,$UserId,$Lenguage,$CityName;

    /**
     * @param $Code
     * @param $Name
     * @param $Populatio
     * @param $GNP
     * @param $Capital
     * @param $UserId
     */
    public function __construct($Code, $Name, $Populatio, $GNP, $Capital, $UserId)
    {
        $this->Code =(string) $Code;
        $this->Name =(string) $Name;
        $this->Populatio =(int) $Populatio;
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
    public function getPopulatio(): int
    {
        return $this->Populatio;
    }

    /**
     * @param int $Populatio
     */
    public function setPopulatio(int $Populatio): void
    {
        $this->Populatio = $Populatio;
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

}