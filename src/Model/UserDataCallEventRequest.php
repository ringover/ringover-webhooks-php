<?php

namespace RingoverSDK\Model;

class UserDataCallEventRequest implements EventRequestData
{
    /**
     * @var ?int $userId
     */
    public ?int $userId;

    /**
     * @var ?string $firstname
     */
    public ?string $firstname;

    /**
     * @var ?string $lastname
     */
    public ?string $lastname;

    /**
     * @var ?string $email
     */
    public ?string $email;

    /**
     * @var ?string $photo
     */
    public ?string $photo;

    /**
     * @param array{
     *   userId?: ?int,
     *   firstname?: ?string,
     *   lastname?: ?string,
     *   email?: ?string,
     *   photo?: ?string,
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $this->userId = $data['userId'] ?? null;
        $this->firstname = $data['firstname'] ?? null;
        $this->lastname = $data['lastname'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->photo = $data['photo'] ?? null;
    }

    public static function fromArray(?array $data = []): ?UserDataCallEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}
