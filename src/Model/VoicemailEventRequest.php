<?php

namespace RingoverSDK\Model;

class VoicemailEventRequest implements EventRequestData
{
    /**
     * @var ?float
     */
    public ?float $hangupTime;
    /**
     * @var ?string
     */
    public ?string $hangupDateTimeAtom;

    /**
     * @var ?string
     */
    public ?string $message;

    /**
     * @var ?string
     */
    public ?string $privateMessage;

    /**
     * @var ?string
     */
    public ?string $reason;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->hangupTime = $callData['hangup_time'] ?? null;
        $this->hangupDateTimeAtom = $callData['hangup_date_time_atom'] ?? null;
        $this->message = $callData['message'] ?? null;
        $this->privateMessage = $callData['private_message'] ?? null;
        $this->reason = $callData['reason'] ?? null;
    }

    public static function fromArray(?array $data = []): ?VoicemailEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
