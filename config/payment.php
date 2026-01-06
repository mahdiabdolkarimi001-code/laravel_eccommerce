<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IDPay Configuration
    |--------------------------------------------------------------------------
    |
    | تنظیمات اتصال به درگاه پرداخت IDPay.
    | مقدارها از فایل .env خوانده می‌شوند. در حالت تست از sandbox استفاده می‌شود.
    |
    */

    'idpay_api_key' => env('IDPAY_API_KEY', 'your-api-key-here'), // کلید API دریافتی از IDPay
    'idpay_sandbox' => env('IDPAY_SANDBOX', true),                // اگر true باشد حالت تست فعال است
    'idpay_callback_url' => env('IDPAY_CALLBACK_URL', 'http://localhost:8000/payment/callback'),
    'idpay_endpoint' => env('IDPAY_ENDPOINT', 'https://api.idpay.ir/v1.1/payment'), // آدرس API

];
