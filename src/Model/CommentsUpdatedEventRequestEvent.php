<?php

namespace RingoverSDK\Model;

class CommentsUpdatedEventRequestEvent implements EventRequestData
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
     * @var ?string $comments
     */
    public ?string $comments;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->comments = $callData['comments'] ?? null;
    }
}
