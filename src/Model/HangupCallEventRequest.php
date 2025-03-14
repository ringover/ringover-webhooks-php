<?php

namespace RingoverSDK\Model;

class HangupCallEventRequest extends GenericCallEventRequest implements EventRequestData
{
    /**
     * @var ?int
     */
    public ?int $durationInSeconds;

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
    public ?string $answeringMachineDetection;
    /**
     * @var ?string
     */
    public ?string $record;
    /**
     * @var ?string
     */
    public ?string $privateRecord;

    public function __construct(
        array $data = []
    ) {
        parent::__construct($data);
        $callData = $data['data'] ?? null;

        $this->durationInSeconds = $callData['duration_in_seconds'] ?? null;
        $this->hangupTime = $callData['hangup_time'] ?? null;
        $this->hangupDateTimeAtom = $callData['hangup_date_time_atom'] ?? null;
        $this->answeringMachineDetection = $callData['answering_machine_detection'] ?? null;
        $this->record = $callData['record'] ?? null;
        $this->privateRecord = $callData['private_record'] ?? null;
    }

    public static function fromArray(?array $data = []): ?HangupCallEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
