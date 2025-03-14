<?php

namespace RingoverSDK\Model;

use JsonSerializable;

class ContactSearchNumberEventResponse implements JsonSerializable
{
    public string $number;
    public string $type;

    /**
     * @var array
     */
    public array $numbers = [];
    public bool $isShared = false;

    public function __construct(string $number, string $type)
    {
        $this->number = $number;
        $this->type = $type;
    }

    public function jsonSerialize(): array
    {
        return [
            'number' => $this->number,
            'type'   => $this->type
        ];
    }
}
