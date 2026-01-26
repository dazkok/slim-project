<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class Authenticate
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        if ($this->session->exists('user')) {
            return $handler->handle($request);
        }

        $response = new Response();
        return $response
                ->withHeader('Location', '/login')
                ->withStatus(302);
    }
}
