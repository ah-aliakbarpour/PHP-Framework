<?php

/**
 * user: AHAAP
 * Date: 1401/4/6
 */

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\{Application, Router};


$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

$app->router->get('/contact', 'contact');

$app->router->get('/callback/test', function () {
    return "Callback test.";
});


echo $app->run();