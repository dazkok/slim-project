<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class SearchController extends Controller
{
    public function default(Request $request, Response $response): Response
    {
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);

        return $this->render($response, 'default.html', [
            'albums' => $albums
        ]);
    }

    public function search(Request $request, Response $response): Response
    {
        $albums = $this->getAlbums();

        $queryParams = $request->getQueryParams();
        $query = $queryParams['q'] ?? null;

        if ($query) {
            $albums = array_values(array_filter($albums, function ($album) use ($query) {
                return str_contains($album['title'], $query) ||
                    str_contains($album['artist'], $query);
            }));
        }

        return $this->render($response, 'search.html', [
            'albums' => $albums
        ]);
    }

    public function form(Request $request, Response $response): Response
    {
        $albums = $this->getAlbums();

        $queryParams = $request->getParams();
        $query = $queryParams['q'] ?? null;

        if ($query) {
            $albums = array_values(array_filter($albums, function ($album) use ($query) {
                return str_contains($album['title'], $query) ||
                    str_contains($album['artist'], $query);
            }));
        }

        return $this->render($response, 'form.html', [
            'albums' => $albums
        ]);
    }

    private function getAlbums()
    {
        return json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);
    }
}