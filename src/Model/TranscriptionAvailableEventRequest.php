<?php

namespace RingoverSDK\Model;

class TranscriptionAvailableEventRequest implements EventRequestData
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
     * @var ?string $transcriptionLink
     */
    public ?string $transcriptionLink;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->transcriptionLink = $callData['transcription_link'] ?? null;
    }

    public static function fromArray(?array $data = []): ?TranscriptionAvailableEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
