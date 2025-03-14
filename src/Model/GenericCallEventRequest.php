<?php

namespace RingoverSDK\Model;

class GenericCallEventRequest
{
    /**
     * @var ?string $id
     */
    public ?string $id;

    /**
     * @var ?float $startTime
     */
    public ?float $startTime;

    /**
     * @var ?string
     */
    public ?string $startDateTimeAtom;

    /**
     * @var ?string $direction call direction (inbound/outbound)
     */
    public ?string $direction;

    /**
     * @var ?string $fromNumber
     */
    public ?string $fromNumber;

    /**
     * @var ?string $toNumber
     */
    public ?string $toNumber;

    /**
     * @var ?string $userId
     */
    public ?string $userId;

    /**
     * @var ?bool $isInternal The call is coming from an internal number.
     */
    public ?bool $isInternal;

    /**
     * @var ?bool $isAnonymous
     */
    public ?bool $isAnonymous;

    /**
     * @var ?bool $isIvr The call is coming from an IVR.
     */
    public ?bool $isIvr;

    /**
     * @var ?CallIvrDataWebhook $ivrData
     */
    public ?CallIvrDataWebhook $ivrData;

    /**
     * @var ?IvrScenarioDataCallEventRequest $ivr
     */
    public ?IvrScenarioDataCallEventRequest $ivr;

    /**
     * @var ?UserDataCallEventRequest $user
     */
    public ?UserDataCallEventRequest $user;

    /**
     * @var ?string $status
     */
    public ?string $status;

    /**
     * @var ?string
     */
    private ?string $callId;

    /**
     * @var ?string
     */
    private ?string $channelId;

    /**
     * @param array{
     *   id?: ?string,
     *   callId?: ?int,
     *   channelId?: ?int,
     *   startTime?: ?float,
     *   direction?: ?string,
     *   fromNumber?: ?string,
     *   toNumber?: ?string,
     *   userId?: ?int,
     *   isInternal?: ?bool,
     *   isAnonymous?: ?bool,
     *   isIvr?: ?bool,
     *   ivrData?: ?CallIvrDataWebhook,
     *   user?: ?UserDataCallEventRequest,
     *   status?: ?string,
     * } $data
     */
    public function __construct(
        array $data = []
    ) {
        $callData = $data['data'] ?? null;

        $this->id = $callData['id'] ?? null;
        $this->callId = $callData['call_id'] ?? null;
        $this->channelId = $callData['channel_id'] ?? null;
        $this->startTime = $callData['start_time'] ?? null;
        $this->startDateTimeAtom = $callData['start_date_time_atom'] ?? null;
        $this->direction = $callData['direction'] ?? null;
        $this->fromNumber = $callData['from_number'] ?? null;
        $this->toNumber = $callData['to_number'] ?? null;
        $this->userId = $callData['user_id'] ?? null;
        $this->isInternal = $callData['is_internal'] ?? false;
        $this->isAnonymous = $callData['is_anonymous'] ?? false;
        $this->isIvr = $callData['is_ivr'] ?? false;
        $this->ivrData = CallIvrDataWebhook::fromArray($callData['ivr_data'] ?? null);
        $this->ivr = IvrScenarioDataCallEventRequest::fromArray($callData['ivr'] ?? null);
        $this->user = UserDataCallEventRequest::fromArray($callData['user'] ?? null);
        $this->status = $callData['status'] ?? null;
    }

    public static function fromArray(?array $data = []): ?GenericCallEventRequest
    {
        if (is_null($data)) {
            return null;
        }

        return new self($data);
    }
}

