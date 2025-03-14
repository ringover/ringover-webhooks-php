<?php

namespace RingoverSDK\Model;

class RingingCallEventRequestCall extends GenericCallEventRequest implements EventRequestData
{
    public static function fromArray(?array $data = []): ?GenericCallEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
