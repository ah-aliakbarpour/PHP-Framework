<?php

/**
 * user: AHAAP
 * Date: 1401/4/6
 */

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\models\User;


// Require composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);


$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->post('contact',  [SiteController::class, 'handleContact']);



$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login',  [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register',  [AuthController::class, 'register']);
$app->router->get('/logout',  [AuthController::class, 'logout']);

$app->router->get('/profile',  [AuthController::class, 'profile']);



$app->router->get('/string/test', 'home');

$app->router->get('/callback/test', function () {
    return 'callback test';
});


$app->run();