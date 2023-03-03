<?php

namespace App\Services\Messenger\DTO;

use Faker\Factory as FakerFactory;

class SmsMessengerDTO
{

    private string $recipientPhoneNumber;
    private string $message;

    /**
     * @param string $recipientPhoneNumber
     * @param string|null $message
     */
    public function __construct(string $recipientPhoneNumber, string $message = null)
    {
        $this->recipientPhoneNumber = $recipientPhoneNumber;
        if (empty($message)) {
            $message = FakerFactory::create()->text(50);
        }
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getRecipientPhoneNumber(): string
    {
        return $this->recipientPhoneNumber;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}
