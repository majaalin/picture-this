<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$userId = $_SESSION['user']['user_id'];
$errors = [];
$successes = [];

// If user not logged in
if (!isset($_SESSION['user'])) {
    $errors[] = "You need to login";
    $_SESSION['errors'] = $errors;
    redirect("/");
    exit;
}

if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_new_password'])) {
    $oldPassword = $_POST['old_password'];

    // Get user information
    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If the password does not match the old password
    if (!password_verify($oldPassword, $user['password'])) {
        $errors[] = "Old password doesn't match";
    }
    
    // If the password does not match the confirm password
    if ($_POST['new_password'] !== $_POST['confirm_new_password']) {
        $errors[] = "Your new password doesn't match";
    
    // Update password
    } else {
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
        
        $successes[] = "Your password was successfully updated";
    }
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        redirect('/../../change-password.php');
        exit;
    }
    if (count($successes) > 0) {
        $_SESSION['successes'] = $successes;
        redirect('/../../change-password.php');
        exit;
    }
}
