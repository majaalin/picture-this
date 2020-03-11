<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}

// Get users from search results

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE full_name LIKE '%$search%' OR username LIKE '%$search%'");

    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0) {
        $_SESSION['users'] = $users;
        redirect('/../../search-results.php');
        exit;
    }

    $errors[] = "Can't find user";

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        redirect('/../../search-results.php');
        exit;
    }
}
