<?php

class User
{

private $user_id,$mail,$password;

    /**
     * @param $user_id
     * @param $mail
     * @param $password
     */
    public function __construct($user_id, $mail, $password)
    {
        $this->user_id =(int) $user_id;
        $this->mail =(string) $mail;
        $this->password =(string) $password;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}