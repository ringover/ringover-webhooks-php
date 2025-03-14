<?php

namespace RingoverSDK\Model;

/**
 * @deprecated
 */
class CallIvrDataWebhook
{
    /**
     * @var ?string $number
     */
    public ?string $number;

    /**
     * @var ?string $scenarioName
     */
    public ?string $scenarioName;

    /**
     * @var ?string $ivrName
     */
    public ?string $ivrName;

    /**
     * @param array{
     *   number?: ?string,
     *   scenarioName?: ?string,
     *   ivrName?: ?string,
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $this->number = $data['number'] ?? null;
        $this->scenarioName = $data['scenarioName'] ?? null;
        $this->ivrName = $data['ivrName'] ?? null;
    }

    public static function fromArray(?array $data = []): ?CallIvrDataWebhook
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
