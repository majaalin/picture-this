<?php declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_FILES['image'], $_POST['caption'])) {
    $image = $_FILES['image'];
    $destination = __DIR__.'/../../uploads/images/'.date('ymd')."-".$_FILES['image']['name'];
    move_uploaded_file($image['tmp_name'], $destination); 

    $imagePath = date('ymd')."-".$_FILES['image']['name'];
    $caption = $_POST['caption'];
    $userId = $_SESSION['user']['user_id'];
    date_default_timezone_set('Europe/Stockholm');
    $dateCreated = date("Y-m-d H:i:s");

$query = 'INSERT INTO photos (image, caption, user_id, date_created) VALUES (:image, :caption, :user_id, :date_created)';

    $statement = $pdo->prepare($query);
   
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':image', $imagePath, PDO::PARAM_STR);
    $statement->bindParam(':caption', $caption, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $statement->bindParam(':date_created', $dateCreated, PDO::PARAM_STR);
    
    $statement->execute();

    $successes[] = "Image uploaded!";

    if (count($successes) > 0){
        $_SESSION['successes'] = $successes;
        redirect('/my-posts.php');
        exit;
    }
}

//  $avatarPath = date('ymd')."-".$_FILES['image']['name'];


// $picture = $_FILES['image'];
// $description = $_POST['description'];
// $userId = $_SESSION['user']['user_id'];

// die(var_dump($description));

// $query = 'INSERT INTO photos (user_id, caption, image, date_created) VALUES (:user_id, :caption, :image, now())';

// $statement = $pdo->prepare($query);

// if (!$statement) {
//     die(var_dump($pdo->errorInfo()));
// }

// $statement->bindParam(':image', $image, PDO::PARAM_STR);
// $statement->bindParam(':description', $description, PDO::PARAM_STR);
// $statement->bindParam(':user', $userId, PDO::PARAM_STR);

// $statement->execute();