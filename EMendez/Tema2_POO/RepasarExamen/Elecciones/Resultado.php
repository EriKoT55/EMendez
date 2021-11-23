<?php

class Resultado
{
    private $district,$party,$votes,$escanyos;

    /**
     * @param $district
     * @param $party
     * @param $votes
     * @param $escanyos
     */
    public function __construct($district, $party, $votes,$escanyos)
    {
        $this->district = $district;
        $this->party = $party;
        $this->votes = $votes;
        $this->escanyos = $escanyos;

    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * @return mixed
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * @param mixed $party
     */
    public function setParty($party)
    {
        $this->party = $party;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    public function getEscanyos()
    {
        return $this->escanyos;
    }
    public function setEscanyos($escanyos)
    {
        $this->escanyos = $escanyos;
    }

}