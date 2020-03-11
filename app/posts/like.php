<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_GET['photo_id'])) {
    $photoId = $_GET['photo_id'];
    $userId = $_SESSION['user']['user_id'];

    $statement = $pdo->prepare('SELECT * FROM likes WHERE user_id = :user_id AND photo_id = :photo_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

    $statement->execute();

    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    // If the user liked the image, unlike
    if ($likes) {
        $query = 'DELETE FROM likes WHERE user_id = :user_id AND photo_id = :photo_id';

        $statement = $pdo->prepare($query);
   
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
    
        $statement->execute();

        redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    // If the user not liked the image, like
    else {
        $query = 'INSERT INTO likes (user_id, photo_id) VALUES (:user_id, :photo_id)';

        $statement = $pdo->prepare($query);
   
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

        $statement->execute();
    
        redirect($_SERVER['HTTP_REFERER']);
        exit;
    }
}
