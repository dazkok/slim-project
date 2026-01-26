<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SecureController extends Controller
{
    public function default(Request $request, Response $response): Response
    {
        return $this->render($response, 'secure.html', [
            'user' => $this->ci->get('session')->get('user')
        ]);
    }

    public function status(Request $request, Response $response): Response
    {
        return $this->render($response, 'status.html', []);
    }
}