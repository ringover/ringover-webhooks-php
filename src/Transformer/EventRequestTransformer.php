<?php

namespace RingoverSDK\Transformer;

use RingoverSDK\Model\AftercallEventRequest;
use RingoverSDK\Model\AnsweredCallEventRequestCall;
use RingoverSDK\Model\ContactEventRequest;
use RingoverSDK\Model\ContactSearchEventRequest;
use RingoverSDK\Model\EventRequest;
use RingoverSDK\Model\CommentsUpdatedEventRequestEvent;
use RingoverSDK\Model\EventRequestData;
use RingoverSDK\Model\HangupCallEventRequest;
use RingoverSDK\Model\IvrResponseEventRequest;
use RingoverSDK\Model\MissedCallEventRequestCall;
use RingoverSDK\Model\RecordAvailableEventRequestEvent;
use RingoverSDK\Model\RingingCallEventRequestCall;
use RingoverSDK\Model\SmartRoutingEventRequest;
use RingoverSDK\Model\SummaryAvailableEventRequest;
use RingoverSDK\Model\TagsUpdatedEventRequest;
use RingoverSDK\Model\TranscriptionAvailableEventRequest;
use RingoverSDK\Model\VoicemailAvailableEventRequest;
use RingoverSDK\Model\VoicemailEventRequest;
use InvalidArgumentException;

class EventRequestTransformer
{

    private string $invalidEventErrorMessage = 'Invalid event';
    private string $invalidResourceErrorMessage = 'Invalid resource';


    public function getCallEventRequestObject(array $decodedPayload): ?EventRequestData
    {
        switch ($decodedPayload['event']) {
            case 'ringing':
                $eventRequestData = RingingCallEventRequestCall::fromArray($decodedPayload);
                break;
            case 'answered':
                $eventRequestData = AnsweredCallEventRequestCall::fromArray($decodedPayload);
                break;
            case 'hangup':
                $eventRequestData = HangupCallEventRequest::fromArray($decodedPayload);
                break;
            case 'missed':
                $eventRequestData = MissedCallEventRequestCall::fromArray($decodedPayload);
                break;
            case 'voicemail':
                $eventRequestData = VoicemailEventRequest::fromArray($decodedPayload);
                break;
            case 'contact':
                $eventRequestData = ContactEventRequest::fromArray($decodedPayload);
                break;
            case 'ivr_response_code':
                $eventRequestData = IvrResponseEventRequest::fromArray($decodedPayload);
                break;
            case 'routing':
                $eventRequestData = SmartRoutingEventRequest::fromArray($decodedPayload);
                break;
            default:
                throw new InvalidArgumentException($this->invalidEventErrorMessage);
        }

        return $eventRequestData;
    }

    public function getContactEventRequestObject(array $decodedPayload): ?EventRequestData
    {
        if ($decodedPayload['event'] == 'contact') {
            $eventRequestData = ContactSearchEventRequest::fromArray($decodedPayload);
        } else {
            throw new InvalidArgumentException($this->invalidEventErrorMessage);
        }

        return $eventRequestData;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getEventRequestObject(array $decodedPayload): ?EventRequest
    {
        if (!empty($decodedPayload['resource']) && $decodedPayload['resource'] === 'call') {
            $eventRequestData = $this->getCallEventRequestObject($decodedPayload);
        } elseif (!empty($decodedPayload['ressource']) && $decodedPayload['ressource'] === 'search') {
            $eventRequestData = $this->getContactEventRequestObject($decodedPayload);
        } else {
            throw new InvalidArgumentException($this->invalidResourceErrorMessage);
        }

        return EventRequest::fromArray($decodedPayload, $eventRequestData);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getAftercallObject(array $decodedPayload): ?EventRequest
    {
        switch ($decodedPayload['event']) {
            case 'comments_updated':
                $afterCallObject = CommentsUpdatedEventRequestEvent::fromArray($decodedPayload);
                break;
            case 'tags_updated':
                $afterCallObject = TagsUpdatedEventRequest::fromArray($decodedPayload);
                break;
            case 'aftercall':
                $afterCallObject = AftercallEventRequest::fromArray($decodedPayload);
                break;
            case 'record_available':
                $afterCallObject = RecordAvailableEventRequestEvent::fromArray($decodedPayload);
                break;
            case 'voicemail_available':
                $afterCallObject = VoicemailAvailableEventRequest::fromArray($decodedPayload);
                break;
            case 'transcription_available':
                $afterCallObject = TranscriptionAvailableEventRequest::fromArray($decodedPayload);
                break;
            case 'summary_available':
                $afterCallObject = SummaryAvailableEventRequest::fromArray($decodedPayload);
                break;
            default:
                throw new InvalidArgumentException($this->invalidEventErrorMessage);
        }

        return $afterCallObject;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getCallObjectFromRaw(array $rawObject): ?EventRequest
    {
        if ($rawObject['resource'] == 'call') {
            $callObject = $this->getEventRequestObject($rawObject);
        } elseif ($rawObject['resource'] == 'aftercall') {
            $callObject = $this->getAftercallObject($rawObject);
        }

        return $callObject;
    }
}
