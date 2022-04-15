<?php
use App\Notifications\Seller\ConfirmEmailNotification;
return [
    'notification' => ConfirmEmailNotification::class,

    'verify_email' => env('CMS_SELLER_VERIFY_EMAIL', true)
];
