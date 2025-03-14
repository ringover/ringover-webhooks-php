<?php

namespace RingoverSDK\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;

abstract class Action
{
    /**
     * @var ServerRequestInterface
     */
    protected ServerRequestInterface $request;

    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->response = $response;
        $this->request = $request;

        return $this->process();
    }

    /**
     * @param array $payload
     * @param int $httpStatusCode
     * @return Response
     */
    protected function respondWithJson(array $payload, int $httpStatusCode = 200): ResponseInterface
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($httpStatusCode);
    }

    /**
     * @return ResponseInterface
     */
    abstract protected function process(): ResponseInterface;
}
