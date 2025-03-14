<?php

namespace RingoverSDK\Model;

use JsonSerializable;

class SmartRoutingEventResponse implements JsonSerializable
{
    public string $name;

    public string $dispatch;

    public int $maxAttempts;

    public int $startDelay;

    public bool $isStayNotConnected;

    public bool $isStayInCall;

    public bool $isStayPlannedSnoozed;

    public bool $isStaySnoozed;

    public int $ringOverlap;

    /** @var SmartRoutingAgentsEventResponse[] */
    public array $agents = [];

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? "redirections";
        $this->dispatch = $data['dispatch'] ?? "ringall";
        $this->maxAttempts = intval($data['max_attempts'] ?? 1);
        $this->startDelay = intval($data['start_delay'] ?? 0);
        $this->isStayNotConnected = boolval($data['is_stay_not_connected'] ?? true);
        $this->isStayInCall = boolval($data['is_stay_in_call'] ?? false);
        $this->isStayPlannedSnoozed = boolval($data['is_stay_planned_snoozed'] ?? true);
        $this->isStaySnoozed = boolval($data['is_stay_snoozed'] ?? false);
        $this->ringOverlap = boolval($data['ring_overlap'] ?? false);
    }

    public function addAgent(SmartRoutingAgentsEventResponse $agent)
    {
        $this->agents[] = $agent;
    }

    public function jsonSerialize(): array
    {
        return [
            'name'                    => $this->name,
            'dispatch'                => $this->dispatch,
            'max_attempts'            => $this->maxAttempts,
            'start_delay'             => $this->startDelay,
            'is_stay_not_connected'   => intval($this->isStayNotConnected),
            'is_stay_in_call'         => intval($this->isStayInCall),
            'is_stay_planned_snoozed' => intval($this->isStayPlannedSnoozed),
            'is_stay_snoozed'         => intval($this->isStaySnoozed),
            'ring_overlap'            => intval($this->ringOverlap),
            'agents'                  => $this->agents
        ];
    }
}
