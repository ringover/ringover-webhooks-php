<?php

namespace RingoverSDK\Model;

class IvrScenarioDataCallEventRequest implements EventRequestData
{
    /**
     * @var ?string $number
     */
    public ?string $number;

    /**
     * @var ?string $ivrName
     */
    public ?string $ivrName;

    /**
     * @var ?ScenarioDataCallEventRequest $scenario
     */
    public ?ScenarioDataCallEventRequest $scenario;


    /**
     * @param array{
     * name?: ?string,
     * number?: ?string,
     * scenario?: ?ScenarioDataCallEventRequest
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $this->number = $data['number'] ?? null;
        $this->ivrName = $data['name'] ?? null;
        $this->scenario = ScenarioDataCallEventRequest::fromArray($data['scenario'] ?? null);
    }

    public static function fromArray(?array $data = []): ?IvrScenarioDataCallEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
