<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['comment-id'], $_POST['author-id'])) {
    $commentId = (int)$_POST['comment-id'];
    $authorId = (int)$_POST['author-id'];
    $userId = (int)$_SESSION['user']['user_id'];

    if ($userId !== $authorId) {
        redirect('/posts.php');
    } else {
        $query = 'DELETE FROM comments WHERE id = :id';

        $statement = $pdo->prepare($query);
    
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
    
        $statement->execute([
            ':id' => $commentId
        ]);

        $json = ([
            'id' => $commentId,
        ]);

        echo json_encode($json);
    }
}
