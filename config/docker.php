<?php

/*
 * This file is part of the Yawik project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$cacheDir = realpath(__DIR__.'/..').'/var/cache/docker';

// override cache directories in docker environment
return [
    'module_listener_options' => [
        'cache_dir' => $cacheDir.'/var/cache/docker'
    ],
    'doctrine' => [
        'configuration' => [
            'odm_default' => [
                'hydrator_dir' => $cacheDir.'/Doctrine/Hydrator',
                'proxy_dir' => $cacheDir.'/Doctrine/Proxy',
            ]
        ]
    ]
];
