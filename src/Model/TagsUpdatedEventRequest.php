<?php

namespace RingoverSDK\Model;

class TagsUpdatedEventRequest implements EventRequestData
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
     * @var ?string[] $tags
     */
    public ?array $tags;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->tags = $callData['tags'] ?? null;
    }

    public static function fromArray(?array $data = []): ?TagsUpdatedEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
