<?php

declare(strict_types=1);

$messages = [];

if (isset($_SESSION['messages'])){
    $messages = $_SESSION['messages'];
    unset($_SESSION['messages']);
}


$successes = [];

if (isset($_SESSION['successes'])){
    $successes = $_SESSION['successes'];
    unset($_SESSION['successes']);
}

?>