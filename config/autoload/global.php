<?php
$manifestFile = __DIR__.'/../../public/build/manifest.json';
if (!is_dir($dir=dirname($manifestFile))) {
    mkdir($dir, 0755, true);
}
if (!is_file($manifestFile)) {
    file_put_contents($manifestFile, '{}', LOCK_EX);
}
return [
    'core_options' => [
        'publicDir' => __DIR__.'/../../public',
    ],
    'view_helper_config' => [
        'asset' => [
            'resource_map' => json_decode(file_get_contents($manifestFile), true),
        ]
    ]
];
