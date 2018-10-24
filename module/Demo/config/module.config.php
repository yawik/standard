<?php

/*
 * This file is part of the Yawik project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Zend\ServiceManager\Factory\InvokableFactory;
use Demo\Controller\IndexController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'lang' => [
                'child_routes' => [
                    'demo' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/demo[/:action]',
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                ],
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'demo/index/index' => __DIR__ . '/../view/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
