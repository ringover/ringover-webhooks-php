<?php

namespace RingoverSDK\Model;

class ContactEventRequest implements EventRequestData
{
    /**
     * @var ?string $callId
     */
    public ?string $callId;

    /**
     * @var ?string
     */
    public ?string $direction;

    /**
     * @var ?string
     */
    public ?string $fromNumber;

    /**
     * @var ?string
     */
    public ?string $toNumber;

    /**
     * @param array{
     *     call_id: ?string,
     *     to_number: ?string,
     *     from_number: ?string,
     *     direction: ?string
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $this->callId = $data['call_id'] ?? null;
        $this->toNumber = $data['to_number'] ?? null;
        $this->fromNumber = $data['from_number'] ?? null;
        $this->direction = $data['direction'] ?? null;
    }

    public static function fromArray(?array $data = []): ?ContactEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
