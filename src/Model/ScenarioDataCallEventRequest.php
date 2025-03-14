<?php

namespace RingoverSDK\Model;

class ScenarioDataCallEventRequest implements EventRequestData
{
    /**
     * @var ?int $scenarioId
     */
    public ?int $scenarioId;

    /**
     * @var ?int $ivrId
     */
    public ?int $ivrId;

    /**
     * @var ?string $scenarioName
     */
    public ?string $scenarioName;

    /**
     * @var ?string $scenarioType
     */
    public ?string $scenarioType;


    /**
     * @param array{
     *   scenario_id?: ?int,
     *   ivr_id?: ?int,
     *   name?: ?string,
     *   scenario_type?: ?string
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $this->ivrId = $data['ivr_id'] ?? null;
        $this->scenarioId = $data['scenario_id'] ?? null;
        $this->scenarioName = $data['name'] ?? null;
        $this->scenarioType = $data['scenario_type'] ?? null;
    }

    public static function fromArray(?array $data = []): ?ScenarioDataCallEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
