<?php

/*
 * This file is part of the Yawik project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// docker environment override
return [
    'module_listener_options' => [
        'cache_dir' => realpath(dirname(__DIR__)).'/var/cache/docker'
    ]
];
