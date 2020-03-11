<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['delete-profile'])) {
    $userId = $_SESSION['user']['user_id'];


    // Delete user
    $statement = $pdo->prepare('DELETE FROM users WHERE user_id = :user_id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->execute([
        ':user_id' => $userId
    ]);


    // Delete all posts by user
    $statement = $pdo->prepare('DELETE FROM photos WHERE user_id = :user_id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->execute([
        ':user_id' => $userId
    ]);


    // Delete all comments written by user
    $statement = $pdo->prepare('DELETE FROM comments WHERE author_id = :user_id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->execute([
        ':user_id' => $userId
    ]);


    // Delete users likes
    $statement = $pdo->prepare('DELETE FROM likes WHERE user_id = :user_id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->execute([
        ':user_id' => $userId
    ]);


    // Delete users followers and following
    $statement = $pdo->prepare('DELETE FROM follower WHERE user_id_1 = :user_id OR user_id_2 = :user_id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->execute([
        ':user_id' => $userId
    ]);

    
    session_destroy();
    redirect('/register.php');
}
