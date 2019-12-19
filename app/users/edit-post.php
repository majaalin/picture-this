<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(!isset($_SESSION['user'])) {
    redirect('/');
}

$photoId = $_GET['photo_id'];
$userId = $_SESSION['user']['user_id'];

$statement = $pdo->prepare('SELECT user_id FROM photos WHERE user_id = :photo_id');

$statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

$statement->execute();

$photos = $statement->fetch(PDO::FETCH_ASSOC);

if (!$photos){
}

if(isset($_GET['photo_id'])){
    $photoId = $_GET['photo_id'];

}



if (isset($_FILES['image'], $_POST['caption'])) {
    $caption = $_POST['caption'];
    die(var_dump($caption));

}