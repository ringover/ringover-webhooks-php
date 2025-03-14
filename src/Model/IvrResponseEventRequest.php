<?php

namespace RingoverSDK\Model;

class IvrResponseEventRequest implements EventRequestData
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
     * @var ?int
     */
    public ?int $code;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $contactEventData = $data['data'] ?? null;

        $this->callId = $contactEventData['call_id'] ?? null;
        $this->toNumber = $contactEventData['to_number'] ?? null;
        $this->fromNumber = $contactEventData['from_number'] ?? null;
        $this->direction = $contactEventData['direction'] ?? null;
        $this->code = $contactEventData['code'] ?? null;
    }

    public static function fromArray(?array $data = []): ?IvrResponseEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
