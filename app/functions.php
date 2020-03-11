<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

/**
 * Get comments from database
 *
 * @param integer $postId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function getComments(int $postId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT comment, id, username, author_id FROM comments INNER JOIN users on author_id = users.user_id WHERE post_id = :post_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId
    ]);

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}
