<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['comment'])) {

    $userId = (int)$_SESSION['user']['user_id'];
    $postId = (int)$_POST['post-id'];
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $author = $_POST['logged-in-user'];

    date_default_timezone_set('Europe/Stockholm');
    $date = date('Y/m/d H:i');

    $query = 'INSERT INTO comments (post_id, author_id, comment, date) VALUES (:post_id, :author_id, :comment, :date)';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId,
        ':author_id' => $userId,
        ':comment' => $comment,
        ':date' => $date
    ]);

    $comments = ([
        'comment' => $comment,
        'name' => $author
    ]);

    echo json_encode($comments);

}