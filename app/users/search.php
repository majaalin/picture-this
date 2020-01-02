<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_GET['search'])){
    $search = $_GET['search'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE full_name LIKE '%$search%' OR username LIKE '%$search%'");

    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0){
        $_SESSION['users'] = $users;
        redirect('/../../search-result.php');
        exit;
    } 

    $errors[] = "Can't find";

    if (count($errors) > 0){
        $_SESSION['errors'] = $errors;
        redirect('/../../search-result.php');
        exit;

}
}
