<?php

namespace App\Services\Messenger;

use App\Services\Messenger\DTO\EmailMessengerDTO;
use Mailgun\Mailgun;

class EmailMessenger implements Messenger
{

    private string $privateApiKey;
    private string $apiHostName;
    private string $domain;

    private Mailgun $client;

    private EmailMessengerDTO $emailMessengerDTO;

    public function __construct()
    {
        $this->privateApiKey = getenv("MAILGUN_PRIVATE_API_KEY");
        $this->apiHostName = getenv("MAILGUN_API_HOSTNAME");
        $this->domain = getenv("MAILGUN_DOMAIN");

        $this->client = Mailgun::create($this->privateApiKey, $this->apiHostName);
    }

    public function setData(EmailMessengerDTO $emailMessengerDTO) {
        $this->emailMessengerDTO = $emailMessengerDTO;
    }

    public function send()
    {
        $this->client->messages()->send($this->domain, [
            'from'    => '<mailgun@' . $this->domain . '>',
            'to'      => $this->emailMessengerDTO->getRecipientEmail(),
            'subject' => $this->emailMessengerDTO->getSubject(),
            'text'    => $this->emailMessengerDTO->getMessage()
        ]);
    }
}
