<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.

if(isset($_POST['email'], $_POST['password'])){
    $email = strtolower(trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)));
    $password = htmlentities($_POST['password']);
    
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])){
        $messages[] = "Wrong email or password";
    } 

    // if (!password_verify($password, $user['password'])){
    //     $messages[] = "Wrong password";
    // }

    if (count($messages) > 0){
        $_SESSION['messages'] = $messages;
        redirect('/../../index.php');
        exit;
    }
    
    if (password_verify($password, $user['password'])){
        unset($user['password']);
        $_SESSION['user'] = $user;

        redirect('/all-posts.php');
    }
}
