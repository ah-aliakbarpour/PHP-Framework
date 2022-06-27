<?php

/**
 * user: AHAAP
 * Date: 1401/4/6
 */

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\{Application, Router};


$app = new Application();

$app->router->get('/', function () {
    return "Hello World!";
});

$app->router->get('/contact', function () {
    return "Contact";
});


$app->run();