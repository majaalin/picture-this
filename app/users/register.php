<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['username'], $_POST['full_name'], $_POST['password'], $_POST['confirm_password'])) {
    $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $fullName = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    $errors = [];

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $errors[] = "Your password doesn't match";
    }

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $confirmPassword = password_hash($_POST['confirm_password'], PASSWORD_BCRYPT);

    $checkForEmail = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $checkForEmail->execute([$email]); 
    $emailExist = $checkForEmail->fetch();
    
    if ($emailExist) {
        $errors[] = "Email already exists!";
}    

$checkForUsername = $pdo->prepare("SELECT * FROM users WHERE username=?");
$checkForUsername->execute([$username]); 
$usernameExist = $checkForUsername->fetch();

if ($usernameExist) {
    $errors[] = "Username already exists!";
}    

    if (count($errors) > 0){
        $_SESSION['errors'] = $errors;
        redirect('/register.php');
        exit;
    }

    $query = 'INSERT INTO users (email, username, full_name, password) VALUES (:email, :username, :full_name, :password)';

    $statement = $pdo->prepare($query);
   
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':full_name', $fullName, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    
    $statement->execute();

    $_SESSION['authenticated'] = true;

};