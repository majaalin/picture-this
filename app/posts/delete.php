<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}

// Get post information
if (isset($_GET['photo_id'])) {
    $photoId = $_GET['photo_id'];

    $statement = $pdo->prepare('SELECT * FROM photos WHERE photo_id = :photo_id');

    $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

    $statement->execute();

    $photo = $statement->fetch(PDO::FETCH_ASSOC);

    $image = $photo['image'];
    $caption = $photo['caption'];
    $userId = $photo['user_id'];
}

if ($_SESSION['user']['user_id'] != $userId) {
    $errors[] = "You can't delete this post";
}

if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    redirect('/../../my-posts.php');
    exit;
}

// Delete post
if (isset($_POST)) {
    if (isset($_GET['photo_id'])) {
        $statement = $pdo->prepare('DELETE FROM photos WHERE photo_id = :photo_id');

        $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
    
        $statement->execute();

        $successes[] = "Your post was deleted";
    }

    if (count($successes) > 0) {
        $_SESSION['successes'] = $successes;
        redirect("/profile.php?user_id=" . $userId . "?");
        exit;
    }
}
