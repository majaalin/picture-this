<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(isset($_POST['comment-id'], $_POST['author-id'])) {
    $commentId = (int)$_POST['comment-id'];
    $authorId = (int)$_POST['author-id'];
    $userId = (int)$_SESSION['user']['user_id'];

    // die(var_dump($authorId));

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
    
        $successes[] = "Your comment was deleted";
    
        if (count($successes) > 0){
            $_SESSION['successes'] = $successes;
            redirect("/posts.php");
            exit;
        }

    }

}
