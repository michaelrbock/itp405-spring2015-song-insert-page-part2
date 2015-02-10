<?php

namespace Itp;

class ArtistQuery extends \Itp\Base\Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "
            SELECT DISTINCT artist_id, artist_name
            FROM songs
            INNER JOIN artists
            ON songs.artist_id = artists.id
            ORDER BY artist_name
        ";

        $statement = static::$pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}