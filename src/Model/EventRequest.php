<?php

namespace RingoverSDK\Model;

class EventRequest
{
    /**
     * @var ?string $event
     */
    public ?string $event;

    /**
     * @var ?string $resource
     */
    public ?string $resource;

    /**
     * @var ?float $timestamp
     */
    public ?float $timestamp;

    /**
     * @var ?int $attempt
     */
    public ?int $attempt;

    public ?EventRequestData $data;

    /**
     * RingingCallWebhook constructor.
     *
     * @param array{
     *    event?: ?int,
     *    resource?: ?string,
     *    timestamp?: ?float,
     *    attempt?: ?int
     *  } $data
     */
    public function __construct(array $data = [], ?EventRequestData $eventRequestData = null)
    {
        $this->event = $data['event'] ?? null;
        $this->resource = $data['resource'] ?? null;
        $this->timestamp = $data['timestamp'] ?? null;
        $this->attempt = $data['attempt'] ?? null;
        $this->data = $eventRequestData;
    }

    public static function fromArray(?array $data = [], ?EventRequestData $eventRequestData = null): ?EventRequest
    {
        if (is_null($data)) {
            return null;
        }

        $eventRequest = new self($data);
        $eventRequest->data = $eventRequestData;

        return $eventRequest;
    }
}
