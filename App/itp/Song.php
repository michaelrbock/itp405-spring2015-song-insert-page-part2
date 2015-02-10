<?php

namespace Itp;

class Song extends \Itp\Base\Database {
    protected $id;
    protected $title;
    protected $artist_id;
    protected $genre_id;
    protected $price;

    public function __construct($title, $artist_id, $genre_id, $price) {
        parent::__construct();

        $this->title = $title;
        $this->artist_id = $artist_id;
        $this->genre_id = $genre_id;
        $this->price = $price;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setArtistId($artist_id)
    {
        $this->artist_id = $artist_id;
    }

    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function save()
    {
        $sql = "
            INSERT INTO songs (title, artist_id, genre_id, price)
            VALUES (?, ?, ?, ?)
        ";

        $statement = static::$pdo->prepare($sql);
        $statement->bindParam(1, $this->title);
        $statement->bindParam(2, $this->artist_id);
        $statement->bindParam(3, $this->genre_id);
        $statement->bindParam(4, $this->price);

        $statement->execute();

        // get/set id here
        $this->id = static::$pdo->lastInsertId();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }
}
