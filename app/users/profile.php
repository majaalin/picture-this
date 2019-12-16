<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_POST['email'])) {
    $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $userId = $_SESSION['user']['user_id'];
    
    $query = 'UPDATE users SET email = :email WHERE user_id = :user_id';

    $updateProfile = $pdo->prepare($query);
    
    if (!$updateProfile) {
        die(var_dump($pdo->errorInfo()));
    }

    $updateProfile->bindParam(':email', $email, PDO::PARAM_STR);

    $updateProfile->execute();
} 