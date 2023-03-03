# CLI Messenger for sending sms and emails
Simple cli tool for sending messeges via sms or email

## Setup

Build `docker-compose up -d --build app`.

Set ENV variables into `src/.env` file. You can copy `src/.env.example`. You need to set variables for Twilio: `TWILIO_ACCOUNT_SID, TWILIO_ACCOUNT_PHONE_NUMBER, TWILIO_AUTH_TOKEN` and variables for Mailgun: `MAILGUN_PRIVATE_API_KEY, MAILGUN_API_HOSTNAME, MAILGUN_DOMAIN`.

Run composer to install `docker-compose run --rm composer install`

## Usage

Use this to see instructions:
> php artisan messenger:email:send --help
> 
> php artisan messenger:sms:send --help

Use command like that: `php artisan messenger:email:send callcenter@ssu.gov.ua "Hello SSU" "How are you today?"`