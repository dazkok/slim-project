<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$container->set('templating', function () {
    return new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(
            __DIR__ . '/../templates',
            ['extension' => '']
        ),
    ]);
});

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', [\App\Controller\SearchController::class, 'default']);

$app->get('/api', [\App\Controller\ApiController::class, 'search']);
$app->get('/search', [\App\Controller\SearchController::class, 'search']);
$app->any('/form', [\App\Controller\SearchController::class, 'form']);

$app->get('/bikes', [\App\Controller\ShopController::class, 'default']);
$app->get('/bikes/{id:[0-9]+}', [\App\Controller\ShopController::class, 'details']);

$app->get('/hello/{name}', [\App\Controller\SecondController::class, 'hello']);

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setErrorHandler(
    Slim\Exception\HttpNotFoundException::class,
    function (Psr\Http\Message\ServerRequestInterface $request) use ($container) {
        $controller = new \App\Controller\ExceptionController($container);
        return $controller->notFound($request);
    }
);

$app->run();