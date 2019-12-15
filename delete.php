<?php 


declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_SESSIOn['user'], $_POST['id'])) {
    // DELETE FROM posts WHERE ID = :id AND user_id = :user_id;
}

redirect('/');