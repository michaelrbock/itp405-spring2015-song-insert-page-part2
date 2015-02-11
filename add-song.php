<?php

    require_once __DIR__ . '/vendor/autoload.php';

    $session = new \Symfony\Component\HttpFoundation\Session\Session();
    $session->start();

    $artist_query = new \Itp\ArtistQuery();
    $genre_query = new \Itp\GenreQuery();

    if (isset($_POST['title']) && isset($_POST['artist']) &&
        isset($_POST['genre']) && isset($_POST['price'])) {
        $title = $_POST['title'];
        $artist_id = $_POST['artist'];
        $genre_id = $_POST['genre'];
        $price = $_POST['price'];

        $song = new \Itp\Song($title, $artist_id, $genre_id, $price);
        $song->save();

        $session->getFlashBag()->add('success-message', 'The song' . $song->getTitle());
        $session->getFlashBag()->add('success-message', ' with an ID of ' . $song->getId());
        $session->getFlashBag()->add('success-message', ' was inserted succesfully!');

        header('Location: add-song.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Song</title>
</head>

<body>
    <div></div>
    <form method="post">
        <div>
            Title: <input type="text" name="title">
        </div>
        <div>
            Artists:
            <select name="artist">
                <?php foreach($artist_query->getAll() as $artist) : ?>
                    <option value="<?php echo $artist->artist_id ?>">
                        <?php echo $artist->artist_name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            Genre:
            <select name="genre">
                <?php foreach($genre_query->getAll() as $genre) : ?>
                    <option value="<?php echo $genre->genre_id ?>">
                        <?php echo $genre->genre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            Price: <input type="text" name="price">
        </div>
        <input type="submit" value="Add Song">
    </form>
    <br>
    <p>
    <?php foreach($session->getFlashBag()->get('success-message') as $message) : ?>
            <?php echo $message ?>
    <?php endforeach; ?>
    </p>
</body>
</html>