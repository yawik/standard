<?php

$cacheDir = realpath(__DIR__.'/../../').'/var/cache/docker';
return [
    'doctrine' => [
        'configuration' => [
            'odm_default' => [
                'hydrator_dir' => $cacheDir.'/Doctrine/Hydrator',
                'proxy_dir' => $cacheDir.'/Doctrine/Proxy',
            ]
        ]
    ]
];
