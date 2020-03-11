<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}


$successes = [];

if (isset($_SESSION['successes'])) {
    $successes = $_SESSION['successes'];
    unset($_SESSION['successes']);
}
