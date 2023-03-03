<?php

namespace App\Services\Messenger;

use App\Services\Messenger\DTO\SmsMessengerDTO;
use Twilio\Rest\Client;

class SmsMessenger implements Messenger
{

    private string $sId;
    private string $token;
    private string $twilioNumber;

    private Client $client;

    private SmsMessengerDTO $smsMessengerDTO;

    public function __construct()
    {
        $this->sId = getenv("TWILIO_ACCOUNT_SID");
        $this->token = getenv("TWILIO_AUTH_TOKEN");
        $this->twilioNumber = getenv("TWILIO_ACCOUNT_PHONE_NUMBER");

        $this->client = new Client($this->sId, $this->token);
    }

    public function setData(SmsMessengerDTO $smsMessengerDTO) {
        $this->smsMessengerDTO = $smsMessengerDTO;
    }

    public function send()
    {
        $this->client->messages
            ->create($this->smsMessengerDTO->getRecipientPhoneNumber(),
                ["body" => $this->smsMessengerDTO->getMessage(), "from" => $this->twilioNumber]
            );
    }

}
