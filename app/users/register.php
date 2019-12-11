<?php

declare(strict_types=1);

$pdo = new PDO('/app/database/sqlite:database.db');

if (isset($_POST['email'], $_POST['name'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $password = htmlentities($_POST['password']);
}

$query = 'UPDATE users 
SET email = :email, name = :name, password = :password';

$statment = $pdo->prepare($query);

if (!$statment) {
    die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':name', $name, PDO::PARAM_STR);
$statement->bindParam('password', $password, PDO::PARAM_STR);

$statement->execute();

die(var_dump($statement));

