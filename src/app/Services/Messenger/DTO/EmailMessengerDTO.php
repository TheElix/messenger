<?php

namespace App\Services\Messenger\DTO;

use Faker\Factory as FakerFactory;

class EmailMessengerDTO
{

    private string $recipientEmail;
    private string $subject;
    private string $message;

    /**
     * @param string $recipientEmail
     * @param string|null $subject
     * @param string|null $message
     */
    public function __construct(string $recipientEmail, string $subject = null, string $message = null)
    {
        $this->recipientEmail = $recipientEmail;

        if (empty($subject)) {
            $subject = FakerFactory::create()->text(50);
        }
        $this->subject = $subject;

        if (empty($message)) {
            $message = FakerFactory::create()->text(250);
        }
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getRecipientEmail(): string
    {
        return $this->recipientEmail;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}
