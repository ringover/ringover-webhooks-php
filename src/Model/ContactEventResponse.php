<?php

namespace RingoverSDK\Model;

use JsonSerializable;

class ContactEventResponse implements JsonSerializable
{
    public string $uuid;
    public string $firstname;
    public string $lastname;
    public string $company;
    public string $url;

    public array $data;
    public bool $isShared = false;

    /**
     * @param array{
     *   uuid: string,
     *   firstname: string,
     *   lastname: string,
     *   company: string,
     *   url: string,
     *   data: string[],
     *   is_shared: bool
     * } $data
     */
    public function __construct(array $data)
    {
        $this->uuid = $data['uuid'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->company = $data['company'];
        $this->url = $data['url'];
        $this->data = $data['data'];
        $this->isShared = boolval($data['is_shared']);
    }

    public function addData(string $key, string $value)
    {
        $this->data[$key] = $value;
    }

    public function jsonSerialize()
    {
        return [
            'uuid'      => $this->uuid,
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'company'   => $this->company,
            'url'       => $this->url,
            'data'      => $this->data,
            'isShared'  => $this->isShared
        ];
    }
}
