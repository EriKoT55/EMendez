<?php
require_once ("../BD/bd.php");
require_once("../A_Entidades/Film.php");

class Main_modelo
{

    private bd $bd;

    public function __construct()
    {
        $this->bd= new bd();
    }

    /**
     * @return array
     */
    public function getFilms(){

        $sql="SELECT f1.*,l.name,
            (SELECT 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                      'category',c.name
                    )
                )FROM category c JOIN film_category fc on c.category_id=fc.category_id JOIN film f2 on fc.film_id= f2.film_id WHERE f2.film_id=f1.film_id) as 'category',
                (SELECT 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                      'actores',concat(a.first_name,' ',a.last_name)
                    )
                )FROM actor a JOIN film_actor fa on a.actor_id=fa.actor_id JOIN film f2 on fa.film_id= f2.film_id WHERE f2.film_id=f1.film_id) as 'actores'
            FROM film f1
            JOIN language l  on l.language_id=f1.language_id ORDER BY RAND(1234) LIMIT 20";

        $this->bd->default();
        $result=$this->bd->query($sql);
        $this->bd->close();

        $arrFilms = $result->fetch_all(MYSQLI_ASSOC);

        $objArrFilms=[];
        foreach ($arrFilms as $films){

            $newFilm= new Film($films["film_id"],$films["title"],$films["description"],$films["release_year"],$films["leangueage_id"],$films["length"],$films["rating"],$films["user_id"],$films["last_update"]);
            $newFilm->setLanguage($films["name"]);
            $newFilm->setAcotores(json_decode($films["actores"],true));
            $newFilm->setCategory(json_decode($films["category"],true));
            $objArrFilms[]=$newFilm;
        }

        return $objArrFilms;

    }

    /**
     * @param $userID
     * @return array
     */
    public function getFilmsUsr($userID){

        $sql1="SELECT f1.*,l.name,
            (SELECT 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                      'category',c.name
                    )
                )FROM category c JOIN film_category fc on c.category_id=fc.category_id JOIN film f2 on fc.film_id= f2.film_id WHERE f2.film_id=f1.film_id) as 'category',
                (SELECT 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                      'actores',concat(a.first_name,' ',a.last_name)
                    )
                )FROM actor a JOIN film_actor fa on a.actor_id=fa.actor_id JOIN film f2 on fa.film_id= f2.film_id WHERE f2.film_id=f1.film_id) as 'actores'
            FROM film f1
            JOIN language l  on l.language_id=f1.language_id
            WHERE f1.user_id=".$userID.";";

        $this->bd->default();
        $result=$this->bd->query($sql1);
        $this->bd->close();

        $arrFilmsUsr = $result->fetch_all(MYSQLI_ASSOC);

        $objArrFilmsUsr=[];
        foreach ($arrFilmsUsr as $films){

            $newFilm= new Film($films["film_id"],$films["title"],$films["description"],$films["release_year"],$films["leangueage_id"],$films["length"],$films["rating"],$films["user_id"],$films["last_update"]);
            $newFilm->setLanguage($films["name"]);
            $newFilm->setAcotores(json_decode($films["actores"],true));
            $newFilm->setCategory(json_decode($films["category"],true));
            $objArrFilmsUsr[]=$newFilm;
        }

        return $objArrFilmsUsr;

    }

    /**
     * @param $userID
     * @param $filmID
     * @return void
     */
    public function reserPeli ($userID,$filmID){

        $sql="UPDATE film set user_id=".$userID." WHERE film_id=".$filmID." ";

        $this->bd->default();
        $this->bd->query($sql);

        $this->bd->close();

    }

    /**
     * @param $filmID
     * @return void
     */
    public function devolverPeli ($filmID){

        $sql="UPDATE film set user_id= IS NULL WHERE film_id=".$filmID." ";

        $this->bd->default();
        $this->bd->query($sql);
        $this->bd->close();

    }

}