<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

$userId = $_SESSION['user']['user_id'];
$successes = [];
$errors = [];


// Find user that is logged in

$findUser = $pdo->prepare("SELECT * FROM users WHERE user_id=?");
$findUser->execute([$userId]); 
$user = $findUser->fetch();

$oldUsername = $user['username'];
$oldEmail = $user['email'];
$oldFullName = $user['full_name'];
$oldBiography = $user['biography'];
$oldAvatar = $user['avatar'];


if (isset($_POST['update'])) {

    if (isset($_FILES['avatar'])) {
        $avatar = $_FILES['avatar'];
        $destination = __DIR__.'/../../uploads/'.date('ymd')."-".$_FILES['avatar']['name'];
        move_uploaded_file($avatar['tmp_name'], $destination); 

        $avatarName = date('ymd')."-".$_FILES['avatar']['name'];

        if ($avatar['tmp_name'] != "") {

            $statement = $pdo->prepare("UPDATE users SET avatar = :avatar  WHERE user_id = :user_id");
            $statement->bindParam(":avatar", $avatarName);
            $statement->bindParam(":user_id", $userId);
            $statement->execute();
        
            $successes[] = "Your avatar were successfully updated";

    }}


    if (isset($_POST['email'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $checkForEmail = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $checkForEmail->execute([$email]); 
            $emailExist = $checkForEmail->fetch();

            if ($oldEmail != $email) {
                

            if ($emailExist) {
                $errors[] = "Email already exists!";
            } else {

            $statement = $pdo->prepare('UPDATE users SET email = :email WHERE user_id = :user_id');
            
            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
    
            $statement->execute([
                ':user_id' => $userId,
                ':email' => $email,
                ]);

            $successes[] = "Your email were successfully updated";
                
  }}}

        if (isset($_POST['username'])) {
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

                $checkForUsername = $pdo->prepare("SELECT * FROM users WHERE username=?");
                $checkForUsername->execute([$username]); 
                $usernameExist = $checkForUsername->fetch();

                if ($oldUsername != $username) {

                if ($usernameExist) {
                    $errors[] = "Username already exists!";
                } else {

                    $statement = $pdo->prepare('UPDATE users SET username = :username WHERE user_id = :user_id');
                
                if (!$statement) {
                    die(var_dump($pdo->errorInfo()));
                }
        
                $statement->execute([
                    ':user_id' => $userId,
                    ':username' => $username,
                    ]);

                    $successes[] = "Your username were successfully updated";

                }}
        
 }

        if (isset($_POST['full_name'])) {
            $fullName = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);

            if ($oldFullName != $fullName) {
    
            $statement = $pdo->prepare('UPDATE users SET full_name = :full_name WHERE user_id = :user_id');
            
            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
    
            $statement->execute([
                ':user_id' => $userId,
                ':full_name' => $fullName,
                ]);
            
                $successes[] = "Your full name were successfully updated";
        }
    }

    if (isset($_POST['biography'])) {
        $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);

        if ($oldBiography != $biography ){

        $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE user_id = :user_id');
        
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':user_id' => $userId,
            ':biography' => $biography,
            ]);

            $successes[] = "Your biography were successfully updated";
            
        }}

        if (count($errors) > 0){
            $_SESSION['errors'] = $errors;
            redirect("/../../edit-profile.php?user_id=" . $userId);
            exit;
        }

        if (count($successes) > 0){
            $_SESSION['successes'] = $successes;
            redirect("/../../profile.php?user_id=" . $userId);
            exit;
        } else {

            $errors[] = "You did not update anything";
            $_SESSION['errors'] = $errors;
            redirect("/../../profile.php?user_id=" . $userId);
            exit;
        }
}
