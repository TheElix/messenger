<?php

namespace App\Console\Commands;

use App\Services\Messenger\DTO\SmsMessengerDTO;
use App\Services\Messenger\SmsMessenger;
use Illuminate\Console\Command;

class MessengerSendSms extends Command
{
    protected $signature = 'messenger:sms:send
    {phoneNumber : Phone number in E.164 format e.g +380442569991}
    {message? : Message that would be sent. In case of empty message random text would be generated}';

    protected $description = 'Messenger will send SMS to provided phoneNumber with provided message.';

    public function __construct(
        protected SmsMessenger $provider,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $smsData = new SmsMessengerDTO(
            $this->argument('phoneNumber'),
            $this->argument('message')
        );

        try {
            $this->provider->setData($smsData);
            $this->provider->send();

            $this->info('Sms was successfully sent to `' . $smsData->getRecipientPhoneNumber() . '`');
        } catch (\Exception $exception) {
            $this->warn('Sms sending error: ' . $exception->getMessage());
        }
    }
}
