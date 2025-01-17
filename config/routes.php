<?php

return [
    '/' => [
        'controller' => \Controller\HomeController::class,
        'methods' => ['GET'],
        'redirect' => '/'
    ],
    '/login' => [
        'controller' => \Controller\LoginController::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/login'
    ],
    '/signup' => [
        'controller' => \Controller\SignUpController::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/signup'
    ],
    '/logout' => [
        'controller' => \Controller\LogoutController::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/'
    ],
    '/quiz' => [
        'controller' => \Controller\QuizController::class,
        'methods' => ['GET'],
        'redirect' => '/'
    ],
    '/answer' => [
        'controller' => \Controller\AnswerController::class,
        'methods' => ['POST'],
        'redirect' => '/'
    ]
];