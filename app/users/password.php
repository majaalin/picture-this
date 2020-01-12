<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_new_password'])) {
    $oldPassword = $_POST['old_password'];
    $userId = $_SESSION['user']['user_id'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($oldPassword, $user['password'])){
        $errors[] = "Old password dosent match";
    } else if ($_POST['new_password'] !== $_POST['confirm_new_password']) {
        $errors[] = "Your password doesn't match";
    }

    if (count($errors) > 0){
        $_SESSION['errors'] = $errors;
        redirect('/../../change-password.php');
        exit;
    }

    $newPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $confirmNewPassword = password_hash($_POST['confirm_new_password'], PASSWORD_BCRYPT);

    $statement = $pdo->prepare('UPDATE users SET password = :new_password WHERE user_id = :user_id');
            
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId,
        ':new_password' => $newPassword,
        ]);
        
        $successes[] = "Your password were successfully updated";

    if (count($successes) > 0){
        $_SESSION['successes'] = $successes;
        redirect('/../../change-password.php');
        exit;
    }
}
