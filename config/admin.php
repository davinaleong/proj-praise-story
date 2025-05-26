<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Display Name
    |--------------------------------------------------------------------------
    |
    | This value sets the display name for the administrator. It can be used
    | in dashboards, notifications, or UI elements where a user-friendly
    | name for the admin should appear. Configure this in your ".env" file.
    |
    */

    'name' => env('ADMIN_NAME', 'Admin'),

    /*
    |--------------------------------------------------------------------------
    | Admin Email
    |--------------------------------------------------------------------------
    |
    | This value is the administrator's email address used for authentication
    | or internal notifications. You may set this in your ".env" file to keep
    | sensitive data out of source control.
    |
    */

    'email' => env('ADMIN_EMAIL', 'johndoe@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Admin Password
    |--------------------------------------------------------------------------
    |
    | This value is the administrator's password used for authentication.
    | It is recommended to store this securely in your ".env" file and
    | use hashing in your authentication logic to protect credentials.
    |
    */

    'password' => env('ADMIN_PASSWORD', 'password@admin01'),

];
