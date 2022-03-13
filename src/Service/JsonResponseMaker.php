<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class JsonResponseMaker
{
    public function makeJsonResponse(array $data): Response
    {
        $response = new Response();

        $response->setContent(json_encode($data));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
