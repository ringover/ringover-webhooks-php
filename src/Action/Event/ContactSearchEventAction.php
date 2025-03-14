<?php

namespace RingoverSDK\Action\Event;

use RingoverSDK\Action\Action;
use RingoverSDK\Model\EventRequest;
use RingoverSDK\Model\ContactSearchEventResponse;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use RingoverSDK\Transformer\CallEventTransformer;

abstract class ContactSearchEventAction extends Action
{
    private CallEventTransformer $transformer;

    protected EventRequest $callWebhook;

    public function __construct(CallEventTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function process(): ResponseInterface
    {
        $requestRawBody = $this->request->getBody()->getContents();
        $decodedBody = json_decode($requestRawBody, true);
        if (!$decodedBody) {
            throw new InvalidArgumentException('Invalid JSON body');
        }

        $this->callWebhook = $this->transformer->getEventRequestObject($decodedBody);
        $contactEventResponse = $this->action();

        if (is_null($contactEventResponse)) {
            $httpResponse = $this->response->withStatus(204);
        } else {
            $json = json_encode($contactEventResponse, JSON_PRETTY_PRINT);
            $this->response->getBody()->write($json);

            $httpResponse = $this->response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        return $httpResponse;
    }

    abstract public function action(): ?ContactSearchEventResponse;
}
