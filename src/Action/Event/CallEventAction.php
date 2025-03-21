<?php

namespace RingoverSDK\Action\Event;


use RingoverSDK\Action\Action;
use RingoverSDK\Model\EventRequest;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use RingoverSDK\Transformer\EventRequestTransformer;

abstract class CallEventAction extends Action
{
    private EventRequestTransformer $transformer;

    protected EventRequest $eventRequestPayload;

    public function __construct(EventRequestTransformer $transformer)
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

        $this->eventRequestPayload = $this->transformer->getEventRequestObject($decodedBody);
        return $this->action();
    }

    abstract public function action(): ResponseInterface;
}
