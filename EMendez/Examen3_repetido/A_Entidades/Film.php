<?php

class Film
{
    private $film_id,$title,$description,$release_year,$leangueage_id,$length,$rating,$user_id,$last_update,$language,$acotores,$category;

    /**
     * @param $film_id
     * @param $title
     * @param $description
     * @param $release_year
     * @param $leangueage_id
     * @param $lenght
     * @param $rating
     * @param $user_id
     * @param $last_update
     */
    public function __construct($film_id, $title, $description, $release_year, $leangueage_id, $length, $rating, $user_id, $last_update)
    {
        $this->film_id =(int) $film_id;
        $this->title =(string) $title;
        $this->description =(string) $description;
        $this->release_year =(string) $release_year;
        $this->leangueage_id =(int) $leangueage_id;
        $this->length =(int) $length;
        $this->rating =(string) $rating;
        $this->user_id =(int) $user_id;
        $this->last_update =(string) $last_update;
    }

    /**
     * @return int
     */
    public function getFilmId(): int
    {
        return $this->film_id;
    }

    /**
     * @param int $film_id
     */
    public function setFilmId(int $film_id): void
    {
        $this->film_id = $film_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getReleaseYear(): string
    {
        return $this->release_year;
    }

    /**
     * @param string $release_year
     */
    public function setReleaseYear(string $release_year): void
    {
        $this->release_year = $release_year;
    }

    /**
     * @return int
     */
    public function getLeangueageId(): int
    {
        return $this->leangueage_id;
    }

    /**
     * @param int $leangueage_id
     */
    public function setLeangueageId(int $leangueage_id): void
    {
        $this->leangueage_id = $leangueage_id;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getRating(): string
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(string $rating): void
    {
        $this->rating = $rating;
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
    public function getLastUpdate(): string
    {
        return $this->last_update;
    }

    /**
     * @param string $last_update
     */
    public function setLastUpdate(string $last_update): void
    {
        $this->last_update = $last_update;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getAcotores()
    {
        return $this->acotores;
    }

    /**
     * @param mixed $acotores
     */
    public function setAcotores($acotores): void
    {
        $this->acotores = $acotores;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

}