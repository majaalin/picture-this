<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if(isset($_POST['comment-id'], $_POST['edit-comment'])) {
    $commentId = (int)$_POST['comment-id'];
    $editedComment = filter_var($_POST['edit-comment'], FILTER_SANITIZE_STRING);

//    die(var_dump($editedComment));

    $statement = $pdo->prepare('UPDATE comments SET comment = :comment WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':comment' => $editedComment,
        ':id' => $commentId
    ]);

    $edited = ([
        'comment' => $editedComment
    ]);

    echo json_encode($edited);

}

redirect('/posts.php');