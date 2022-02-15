<?php
require_once( "../BD/db.php" );
require_once( "../A_Entidades/User.php" );

class IniSesion_modelo
{

    private db $db;

    public function __construct()
    {

        $this->db = new db();

    }

    public function getUser( $mail, $contra )
    {

        $this->db->default();

        $mail = $this->db->real_escape_string( $mail );

        $sql = "SELECT * FROM users WHERE Mail='" . $mail . "'";

        $result = $this->db->query( $sql );
        $this->db->default();

        $arrUser = $result->fetch_all(MYSQLI_ASSOC);

        $objArrUser = [];

        foreach( $arrUser as $user ) {

            $objArrUser = new User( $user["Id"], $user["Mail"], $user["Password"] );

        }

        /*$passVerify = password_verify( $contra, $objArrUser[0]->getPassword() );

        if( $passVerify==true && $mail==$objArrUser[0]->getMail() ) {

            return $objArrUser;

        } else {

            return new User( 0, "-", "-" );

        }*/

        return $objArrUser;
    }

}

?>