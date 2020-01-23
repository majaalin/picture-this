<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if(isset($_POST['edit-comment'])) {
    $commentId = (int)$_POST['edit-comment'];

    // die(var_dump($commentId));

    $statement = $pdo->prepare('UPDATE comments SET comment = :comment WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        // ':comment' => $content,
        ':comment' => "TEST",
        ':id' => $commentId
    ]);

    $edit = ([
        'comment' => "ny kommentar"
    ]);

    echo json_encode($edit);

}