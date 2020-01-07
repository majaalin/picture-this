<?php

declare(strict_types=1);

$errors = [];

if (isset($_SESSION['errors'])){
    $messages = $_SESSION['errors'];
    unset($_SESSION['errors']);
}


$successes = [];

if (isset($_SESSION['successes'])){
    $successes = $_SESSION['successes'];
    unset($_SESSION['successes']);
}

?>