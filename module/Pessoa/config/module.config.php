<?php

namespace Pessoa;
use Zend\Router\Http\Segment;

return [
  'router' => [
    'routes' => [
      'pessoa' => [
        'type' => Segment::class,
        'options' => [
          'route'    => '/pessoa[/:action[/:id]]',
          'constraints' => [
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[a-zA-Z0-9-]*'
          ],
          'defaults' => [
            'controller' => Controller\PessoaController::class,
            'action' => 'index'
          ],
        ],
      ],
    ],
  ],
  'view_manager' => [
    'template_path_stack' => [
      __DIR__ . '/../view',
    ],
  ],
];
