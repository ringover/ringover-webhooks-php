<?php

namespace RingoverSDK\Model;

class ContactSearchEventRequest implements EventRequestData
{
    /**
     * @var ?string $querySearch
     */
    public ?string $querySearch;

    /**
     * @var ?int
     */
    public ?int $userId;

    /**
     * @param array{
     *     querySearch: ?string,
     *     user_id: ?int
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $this->querySearch = $data['query_search'] ?? null;
        $this->userId = $data['user_id'] ?? null;
    }

    public static function fromArray(?array $data = []): ?ContactSearchEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
