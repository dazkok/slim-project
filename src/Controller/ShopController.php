<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class ShopController extends Controller
{
    public function default(Request $request, Response $response): Response
    {
        $bikes = $this->getBikes();

        return $this->render($response, 'shop.html', [
            'bikes' => $bikes
        ]);
    }

    public function details(Request $request, Response $response, $args = [])
    {
        $bikes = $this->getBikes();

        $key = array_search($args['id'], array_column($bikes, 'id'));

        if ($key === false) {
            throw new HttpNotFoundException($request, $response);
        }

        return $this->render($response, 'shop-details.html', [
            'bike' => $bikes[$key]
        ]);
    }

    private function getBikes()
    {
        return json_decode(file_get_contents(__DIR__ . '/../../data/bikes.json'), true);
    }
}