<?php

/**
 * If you need an environment-specific system or application configuration,
 * there is an example in the documentation
 * @see https://docs.zendframework.com/tutorials/advanced-config/#environment-specific-system-configuration
 * @see https://docs.zendframework.com/tutorials/advanced-config/#environment-specific-application-configuration
 */

$modules = require __DIR__.'/modules.config.php';

if (!file_exists(__DIR__ . '/autoload/yawik.config.global.php')) {
    $modules = [
        'Install',
        'Core',
        'Auth',
        'Jobs',
    ];
}else{
    foreach (glob(__DIR__ . '/autoload/*.module.php') as $moduleFile) {
        $addModules = require $moduleFile;
        foreach ($addModules as $addModule) {
            if (strpos($addModule, '-') === 0) {
                $remove = substr($addModule, 1);
                $modules = array_filter($modules, function ($elem) use ($remove) {
                    return strcasecmp($elem, $remove);
                });
            } else {
                if (!in_array($addModule, $modules)) {
                    $modules[] = $addModule;
                }
            }
        }
    }
}

$env = getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV'):'development';

$modules = \Core\Yawik::generateModuleConfiguration($modules);

return [
    // Retrieve list of modules used in this application.
    'modules' => $modules,

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => [
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' => [
            './module',
            './vendor',
        ],

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => [
            realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php',
        ],

        // Whether or not to enable a configuration cache.
        // If enabled, the merged configuration will be cached and used in
        // subsequent requests.
        'config_cache_enabled' => ($env === 'production'),

        // The key used to create the configuration cache file name.
        'config_cache_key' => $env,

        // Whether or not to enable a module class map cache.
        // If enabled, creates a module class map cache which will be used
        // by in future requests, to reduce the autoloading process.
        'module_map_cache_enabled' => ($env === 'production'),

        // The key used to create the class map cache file name.
        'module_map_cache_key' => 'application.module.cache',

        // The path in which to cache merged configuration.
        'cache_dir' => realpath(dirname(__DIR__)).'/var/cache',

        // Whether or not to enable modules dependency checking.
        // Enabled by default, prevents usage of modules that depend on other modules
        // that weren't loaded.
        // 'check_dependencies' => true,
    ],

    // Used to create an own service manager. May contain one or more child arrays.
    // 'service_listener_options' => [
    //     [
    //         'service_manager' => $stringServiceManagerName,
    //         'config_key'      => $stringConfigKey,
    //         'interface'       => $stringOptionalInterface,
    //         'method'          => $stringRequiredMethodName,
    //     ],
    // ],

    // Initial configuration with which to seed the ServiceManager.
    // Should be compatible with Zend\ServiceManager\Config.
    // 'service_manager' => [],
];
