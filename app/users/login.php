<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Login user

if(isset($_POST['email'], $_POST['password'])){
    $email = strtolower(trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)));
    $password = htmlentities($_POST['password']);
    
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If user do not exist and/or password do not match, exit

    if (!$user || !password_verify($password, $user['password'])){
        $errors[] = "Wrong email or password";
    
        $_SESSION['errors'] = $errors;
        redirect('/../../index.php');
        exit;
    }

    // If user exist and password match, sign in 
    
    if (password_verify($password, $user['password'])){
        unset($user['password']);
        $_SESSION['user'] = $user;
        redirect('/posts.php');
    }
}