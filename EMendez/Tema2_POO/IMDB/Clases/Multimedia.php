<?php

class Multimedia
{

    private $MultimediaID,$PeliculaID,$img_url,$trailer_url;

    /**
     * @param $MultimediaID
     * @param $PeliculaID
     * @param $img_url
     * @param $trailer_url
     */
    public function __construct($MultimediaID, $PeliculaID, $img_url, $trailer_url)
    {
        $this->MultimediaID = $MultimediaID;
        $this->PeliculaID = $PeliculaID;
        $this->img_url = $img_url;
        $this->trailer_url = $trailer_url;
    }

    /**
     * @return mixed
     */
    public function getMultimediaID()
    {
        return $this->MultimediaID;
    }

    /**
     * @param mixed $MultimediaID
     */
    public function setMultimediaID($MultimediaID)
    {
        $this->MultimediaID = $MultimediaID;
    }

    /**
     * @return mixed
     */
    public function getPeliculaID()
    {
        return $this->PeliculaID;
    }

    /**
     * @param mixed $PeliculaID
     */
    public function setPeliculaID($PeliculaID)
    {
        $this->PeliculaID = $PeliculaID;
    }

    /**
     * @return mixed
     */
    public function getImgUrl()
    {
        return $this->img_url;
    }

    /**
     * @param mixed $img_url
     */
    public function setImgUrl($img_url)
    {
        $this->img_url = $img_url;
    }

    /**
     * @return mixed
     */
    public function getTrailerUrl()
    {
        return $this->trailer_url;
    }

    /**
     * @param mixed $trailer_url
     */
    public function setTrailerUrl($trailer_url)
    {
        $this->trailer_url = $trailer_url;
    }

}