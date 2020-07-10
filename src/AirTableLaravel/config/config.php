<?php

return [

    /*
    Token - https://airtable.com/account
    */
    'token' => env('AIRTABLE_TOKEN'),

    /*
    Base - https://airtable.com/api
    */
    'base' => env('AIRTABLE_BASE'),

    /*
    Client - "curl" or "guzzle"
    */
    'http_client' => env('AIRTABLE_HTTP_CLIENT'),

    /*
    Default table
    */
    'default_table' => env('AIRTABLE_TABLE'),
];