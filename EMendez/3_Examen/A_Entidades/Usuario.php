<?php

class Usuario
{

    private $Id, $Mail, $Password;

    /**
     * @param $Id
     * @param $Mail
     * @param $Password
     */
    public function __construct( $Id, $Mail, $Password )
    {
        $this->Id =(int) $Id;
        $this->Mail =(string) $Mail;
        $this->Password =(string) $Password;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId( $Id )
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->Mail;
    }

    /**
     * @param string $Mail
     */
    public function setMail( $Mail )
    {
        $this->Mail = $Mail;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword( $Password )
    {
        $this->Password = $Password;
    }

}