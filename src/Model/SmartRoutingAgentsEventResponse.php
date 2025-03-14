<?php

namespace RingoverSDK\Model;

use JsonSerializable;

class SmartRoutingAgentsEventResponse implements JsonSerializable
{
    public string $agentType;

    public int $ringDuration;

    public int $ringDelay;

    public int $order;

    public int $number;

    public bool $isPreAnswer;

    public bool $isCallerId;

    public bool $isHeadLine;

    public function __construct(array $data)
    {
        $this->agentType = $data['agent_type'] ?? "agent_external";
        $this->ringDuration = intval($data['ring_duration'] ?? 25);
        $this->ringDelay = intval($data['ring_delay'] ?? 0);
        $this->order = intval($data['order'] ?? 0);
        $this->number = $data['number'];
        $this->isPreAnswer = boolval($data['is_pre_answer'] ?? false);
        $this->isCallerId = boolval($data['is_caller_id'] ?? true);
        $this->isHeadLine = boolval($data['is_head_line'] ?? false);
    }

    public function jsonSerialize(): array
    {
        return [
            'agent_type'    => $this->agentType,
            'ring_duration' => $this->ringDuration,
            'ring_delay'    => $this->ringDelay,
            'order'         => $this->order,
            'number'        => $this->number,
            'is_pre_answer' => intval($this->isPreAnswer),
            'is_caller_id'  => intval($this->isCallerId),
            'is_head_line'  => intval($this->isHeadLine)
        ];
    }
}
