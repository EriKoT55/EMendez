<?php

class Partido
{
    private $id,$name,$acronym,$logo,$colour, $votos, $escanyos;

    /**
     * @param $id
     * @param $name
     * @param $acronym
     * @param $logo
     * @param $colour
     */
    public function __construct($id, $name, $acronym, $logo, $colour)
    {
        $this->id = $id;
        $this->name = $name;
        $this->acronym = $acronym;
        $this->logo = $logo;
        $this->colour = $colour;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * @param mixed $acronym
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * @param mixed $colour
     */
    public function setColour($colour)
    {
        $this->colour = $colour;
    }
    public function getVotos()
    {
        return $this->votos;
    }


    public function setVotos($votos)
    {
        $this->votos = $votos;
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