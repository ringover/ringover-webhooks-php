<?php

namespace RingoverSDK\Model;

class VoicemailAvailableEventRequest implements EventRequestData
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
     * @var ?string $voicemailLink
     */
    public ?string $voicemailLink;

    /**
     * @var ?string $privateVoicemailLink
     */
    public ?string $privateVoicemailLink;

    /**
     * @var ?int $voicemailDurationInSeconds
     */
    public ?int $voicemailDurationInSeconds;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->voicemailLink = $callData['voicemail_link'] ?? null;
        $this->privateVoicemailLink = $callData['private_voicemail_link'] ?? null;
        $this->voicemailDurationInSeconds = $callData['voicemail_duration'] ?? null;
    }
}
