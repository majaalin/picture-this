<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

// This file contains a list of global configuration settings.

return [
    'title' => 'Project',
    'database_path' => sprintf('sqlite:%s/database/database.db', __DIR__),
];
