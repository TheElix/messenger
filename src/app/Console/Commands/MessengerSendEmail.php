<?php

namespace App\Console\Commands;

use App\Services\Messenger\DTO\EmailMessengerDTO;
use App\Services\Messenger\EmailMessenger;
use Illuminate\Console\Command;

class MessengerSendEmail extends Command
{

    protected $signature = 'messenger:email:send
    {recipientEmail : Email address e.g callcenter@ssu.gov.ua}
    {subject? : Subject of the mail. In case of empty message random text would be generated}
    {message? : Email message. In case of empty message random text would be generated}';

    protected $description = 'Messenger will sent email';

    public function __construct(
        protected EmailMessenger $messenger
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $emailData = new EmailMessengerDTO(
            $this->argument('recipientEmail'),
            $this->argument('subject'),
            $this->argument('message')
        );

        try {
            $this->messenger->setData($emailData);
            $this->messenger->send();

            $this->info('Email was successfully sent to `' . $emailData->getRecipientEmail() . '`');
        } catch (\Exception $exception) {
            $this->warn('Email sending error: ' . $exception->getMessage());
        }
    }
}
