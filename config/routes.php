<?php

return [
    '/' => [
        'controller' => \Controller\HomeController::class,
        'action' => 'index',
        'methods' => ['GET'],
        'redirect' => '/'
    ],
    '/answer' => [
        'controller' => \Controller\AnswerController::class,
        'action' => 'index',
        'methods' => ['POST'],
        'redirect' => '/'
    ]
];