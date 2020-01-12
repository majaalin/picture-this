<?php

declare(strict_types=1);

$likes = [];

if (isset($_SESSION['likes'])){

    $likes = $_SESSION['likes'];
    unset($_SESSION['likes']);
}
?>