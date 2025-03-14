<?php

namespace RingoverSDK\Model;

class SummaryAvailableEventRequest implements EventRequestData
{
    /**
     * @var ?string $callId
     */
    public ?string $callId;

    /**
     * @var ?string $channelId
     */
    public ?string $channelId;

    /**
     * @var ?string $summary
     */
    public ?string $summary;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->summary = $callData['summary'] ?? null;
    }

    public static function fromArray(?array $data = []): ?SummaryAvailableEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
