<?php

return [
    //Default SMS gateway
    'default'   => env('IRANIANSMS_DEFAULT', 'log'), // laravel built in log

    'mehrafraz' => [
        'gateway'  => env('IRANIANSMS_MEHRAFRAZ_GATEWAY', 'http://mehrafraz.com/webservice/Service.asmx?WSDL'),
        'username' => env('IRANIANSMS_MEHRAFRAZ_USERNAME', 'test'),
        'password' => env('IRANIANSMS_MEHRAFRAZ_PASSWORD', 'test'),
    ],

    'kavenegar' => [
        'gateway' => env('IRANIANSMS_KAVENEGAR_GATEWAY', 'http://api.kavenegar.com/v1/%s/%s/%s.json/'),
        'api_key' => env('IRANIANSMS_KAVENEGAR_APIKEY', 'test'),
        'sender'  => env('IRANIANSMS_KAVENEGAR_SENDER', 'test'),
    ],

    'smsir' => [
        'gateway' => env('IRANIANSMS_SMSIR_GATEWAY', 'https://ws.sms.ir/'),
        'api_key' => env('IRANIANSMS_SMSIR_API_KEY', 'test'),
        'secret_key'  => env('IRANIANSMS_SMSIR_SECRET_KEY', 'test'),
        'line_no'  => env('IRANIANSMS_SMSIR_LINENO', 'test'),
    ],

    'ghasedak'=> [
        'api_key' => env('IRANIANSMS_GHASEDAK_APIKEY', 'test'),
        'sender'  => env('IRANIANSMS_GHASEDAK_SENDER', 'test'),
    ],

    'slack' => [
        'url' => env('IRANIANSMS_SLACK_URL')
    ],

    'discord' => [
        'url' => env('IRANIANSMS_DISCORD_URL')
    ],

    'parsasms' => [
        'gateway' => env('IRANIANSMS_PARSASMS_GATEWAY','http://api.parsasms.com/v2/sms/send/simple'),
        'api_key' => env('IRANIANSMS_PARSASMS_APIKEY','test'),
        'sender' => env('IRANIANSMS_PARSASMS_SENDER','test')
    ]
];
