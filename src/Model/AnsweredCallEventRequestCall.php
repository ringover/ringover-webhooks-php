<?php

namespace RingoverSDK\Model;

class AnsweredCallEventRequestCall extends GenericCallEventRequest implements EventRequestData
{
    /**
     * @var ?float
     */
    public ?float $answeredTime;
    /**
     * @var ?string
     */
    public ?string $answeredDateTimeAtom;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->answeredTime = $callData['answered_time'] ?? null;
        $this->answeredDateTimeAtom = $callData['answered_date_time_atom'] ?? null;
    }

    public static function fromArray(?array $data = []): ?AnsweredCallEventRequestCall
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
