<?php

namespace RingoverSDK\Model;

class MissedCallEventRequestCall extends GenericCallEventRequest implements EventRequestData
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
    public ?string $reason;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->hangupTime = $callData['hangup_time'] ?? null;
        $this->hangupDateTimeAtom = $callData['hangup_date_time_atom'] ?? null;
        $this->reason = $callData['reason'] ?? null;
    }

    public static function fromArray(?array $data = []): ?MissedCallEventRequestCall
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
