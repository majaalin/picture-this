<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// die(var_dump($_POST));

if(isset($_POST['edit-comment'])) {
    $commentId = (int)$_POST['edit-comment'];

    // die(var_dump($commentId));

    $statement = $pdo->prepare('UPDATE comments SET comment = :comment WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':comment' => $content,
        ':id' => $commentId
        ]);
}