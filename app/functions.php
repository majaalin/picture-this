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


