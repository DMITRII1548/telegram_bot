# About

This is a simple parser for kwork. Is parse projects in kwork.ru and send telegram message if project was created.


# Installation

- composer install
- copy env to .env.example
- setting up the parameters
TELEGRAM_BOT_KEY=
TELEGRAM_CHAT_ID=""
TEST_TELEGRAM_CHAT_ID=""
- php artisan key:generate
- php artisan queue:work


-- run parser with php artisan parse:kwork
