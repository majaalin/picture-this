<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['comment-id'], $_POST['username'], $_POST['edit-comment'])) {
    $commentId = (int) $_POST['comment-id'];
    $editedComment = filter_var($_POST['edit-comment'], FILTER_SANITIZE_STRING);
    $username = $_POST['username'];

    $statement = $pdo->prepare('UPDATE comments SET comment = :comment WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':comment' => $editedComment,
        ':id'      => $commentId,
    ]);

    $edited = ([
        'comment' => $editedComment,
        'name'    => $username,
    ]);

    echo json_encode($edited);
}
