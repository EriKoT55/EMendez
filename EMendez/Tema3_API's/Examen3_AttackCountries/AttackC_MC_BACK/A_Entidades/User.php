<?php

class User
{

    public $Id, $Mail,$Password;

    /**
     * @param $Id
     * @param $Mail
     * @param $Password
     */
    public function __construct($Id, $Mail, $Password)
    {
        $this->Id =(int) $Id;
        $this->Mail =(string) $Mail;
        $this->Password =(string) $Password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->Mail;
    }

    /**
     * @param string $Mail
     */
    public function setMail(string $Mail): void
    {
        $this->Mail = $Mail;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void
    {
        $this->Password = $Password;
    }

}