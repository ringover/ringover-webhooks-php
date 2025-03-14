<?php

namespace RingoverSDK\Model;

class RecordAvailableEventRequestEvent  implements EventRequestData
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
     * @var ?string $recordLink
     */
    public ?string $recordLink;

    /**
     * @var ?string $privateRecordLink
     */
    public ?string $privateRecordLink;

    /**
     * @var ?int $recordDurationInSeconds
     */
    public ?int $recordDurationInSeconds;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->recordLink = $callData['record_link'] ?? null;
        $this->privateRecordLink = $callData['private_record_link'] ?? null;
        $this->recordDurationInSeconds = $callData['record_duration'] ?? null;
    }
}
