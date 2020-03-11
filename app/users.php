<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

$users = [];

if (isset($_SESSION['users'])) {
    $users = $_SESSION['users'];
    unset($_SESSION['users']);
}
