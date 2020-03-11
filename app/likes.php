<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

$likes = [];

if (isset($_SESSION['likes'])) {
    $likes = $_SESSION['likes'];
    unset($_SESSION['likes']);
}
