<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

/**
* Get all photos order by date 
*
* @param string $photos
* @return array
*/ 
function getAllPhotos(array $photos)
{
    $statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');
    
    $statement->execute();
    
    $photos = $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPhotosFromFollows(array $photos)
{
    $loggedInUser = $_SESSION['user']['user_id'];

$statement = $pdo->prepare("SELECT user_id_2 FROM follower WHERE user_id_1 = '$loggedInUser'");

$statement->execute();

$follows = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($follows as $follow) {
    $foll = $follow['user_id_2'];
    
$statement = $pdo->prepare("SELECT * FROM photos where user_id = :user_id ORDER BY  date_created DESC");

$statement->bindParam(':user_id', $foll, PDO::PARAM_INT);

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);
}}


