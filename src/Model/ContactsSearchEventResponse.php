<?php

namespace RingoverSDK\Model;

use JsonSerializable;

class ContactsSearchEventResponse implements JsonSerializable
{
    public ContactSearchEventResponse $contacts;

    public function __construct(array $data)
    {
        $this->contacts = $data['contacts'] ?? [];
    }

    public function addContact(ContactSearchEventResponse $contact)
    {
        $this->contacts[] = $contact;
    }

    public function jsonSerialize()
    {
        return $this->contacts;
    }
}
