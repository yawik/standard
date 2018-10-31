<?php

/*
 * This file is part of the Yawik project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Demo;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 *
 * @package Demo
 */
class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
}
