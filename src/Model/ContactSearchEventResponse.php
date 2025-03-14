<?php

namespace RingoverSDK\Model;

use JsonSerializable;

class ContactSearchEventResponse implements JsonSerializable
{
    public string $firstname;
    public string $lastname;
    public string $company;
    public string $url;

    /** @var ContactSearchNumberEventResponse[] $numbers */
    public array $numbers;


    /**
     * @param array{
     *     firstname: string,
     *     lastname: string,
     *     company: string,
     *     url: string,
     *     numbers: string[]
     * } $data
     */
    public function __construct(array $data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->company = $data['company'];
        $this->url = $data['url'];
    }

    public function addNumber(ContactSearchNumberEventResponse $number)
    {
        $this->numbers[] = $number;
    }

    public function jsonSerialize()
    {
        return [

            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'company'   => $this->company,
            'url'       => $this->url,
            'numbers'   => $this->numbers
        ];
    }
}
