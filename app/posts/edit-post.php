<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

$userId = $_SESSION['user']['user_id'];

// Get post information
$statement = $pdo->prepare('SELECT user_id FROM photos WHERE user_id = :photo_id');

$statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

$statement->execute();

$photos = $statement->fetch(PDO::FETCH_ASSOC);


if(isset($_GET['photo_id'])){
    $photoId = $_GET['photo_id'];

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $destination = __DIR__.'/../../uploads/'.date('ymd')."-".$_FILES['image']['name'];
        move_uploaded_file($image['tmp_name'], $destination); 
        $imagePath = date('ymd')."-".$_FILES['image']['name'];

        if ($imagePath === date('ymd')."-") {
            $errors[] = "You have not choosen a picture";
        }

        if (count($errors) > 0){
            $_SESSION['errors'] = $errors;
            redirect("/edit-post.php?photo_id=" . $photoId);
            exit;
        }
        
        $statement = $pdo->prepare('UPDATE photos SET image = :image WHERE photo_id = :photo_id');
            
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
       
        $statement->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
        
        $statement->execute();
    
        $successes[] = "Image is uppdated!";

    }

    if (isset($_POST['caption'])) {
        $caption = $_POST['caption'];

        $statement = $pdo->prepare('UPDATE photos SET caption = :caption WHERE photo_id = :photo_id');
            
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
       
        $statement->bindParam(':caption', $caption, PDO::PARAM_STR);
        $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
        
        $statement->execute();

        $successes[] = "Caption is uppdated!";
    }

    if (count($successes) > 0){
        $_SESSION['successes'] = $successes;
        redirect("/edit-post.php?photo_id=" . $photoId);
        exit;
    }
}
    
