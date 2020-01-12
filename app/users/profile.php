<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

$userId = $_SESSION['user']['user_id'];
$email = $_SESSION['user']['email'];
$username = $_SESSION['user']['username'];
$fullName = $_SESSION['user']['full_name'];
$avatar = $_SESSION['user']['avatar'];
$biography = $_SESSION['user']['biography'];

if (isset($_POST['update'])) {

    if (isset($_FILES['avatar'])) {
        $avatar = $_FILES['avatar'];
        $destination = __DIR__.'/../../uploads/'.date('ymd')."-".$_FILES['avatar']['name'];
        move_uploaded_file($avatar['tmp_name'], $destination); 

        if(!$_FILES['avatar']['error'] > 0) { 
    

        if ($avatar['tmp_name'] === "") {
        }
        
        $avatarPath = date('ymd')."-".$_FILES['avatar']['name'];


            $statement = $pdo->prepare("UPDATE users SET avatar = :avatar  WHERE user_id = :user_id");
            $statement->bindParam(":avatar", $avatarPath);
            $statement->bindParam(":user_id", $userId);
            $statement->execute();
        
            $successes[] = "Your avatar were successfully updated";

    }}

    if (isset($_POST['email'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $checkForEmail = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $checkForEmail->execute([$email]); 
            $emailExist = $checkForEmail->fetch();
        
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
                
                if ($_SESSION['user']['email'] != $email){

                    $successes[] = "Your email were successfully updated";
                
                }
    }}
        if (isset($_POST['username'])) {
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        
                $statement = $pdo->prepare('UPDATE users SET username = :username WHERE user_id = :user_id');
                
                if (!$statement) {
                    die(var_dump($pdo->errorInfo()));
                }
        
                $statement->execute([
                    ':user_id' => $userId,
                    ':username' => $username,
                    ]);
                    
                    if ($_SESSION['user']['username'] != $username){

                        $successes[] = "Your username were successfully updated";
                    
                    }
 }

        if (isset($_POST['full_name'])) {
            $fullName = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    
            $statement = $pdo->prepare('UPDATE users SET full_name = :full_name WHERE user_id = :user_id');
            
            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
    
            $statement->execute([
                ':user_id' => $userId,
                ':full_name' => $fullName,
                ]);
                
                if ($_SESSION['user']['full_name'] != $fullName){

                    $successes[] = "Your full name were successfully updated";
                }
    }

    if (isset($_POST['biography'])) {
        $newBiography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE user_id = :user_id');
        
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':user_id' => $userId,
            ':biography' => $newBiography,
            ]);

            if ($newBiography != $biography){

                $successes[] = "Your biography were successfully updated";
            }
        }

        if (count($errors) > 0){
            $_SESSION['errors'] = $errors;
            redirect("/../../profile.php?user_id=" . $userId);
            exit;
        }


    if (count($successes) > 0){
        $_SESSION['successes'] = $successes;
        redirect("/../../profile.php?user_id=" . $userId);
        exit;
    } 
    else {
        $errors[] = "You did not update anything!";
    }
    if (count($errors) > 0){
        $_SESSION['errors'] = $errors;
        redirect("/../../profile.php?user_id=" . $userId);
        exit;
    }
}