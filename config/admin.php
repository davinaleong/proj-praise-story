<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Route Prefix
    |--------------------------------------------------------------------------
    |
    | This value determines the URL prefix for all admin panel routes. You can
    | change it in your ".env" file to obscure the admin area (e.g. from "/admin"
    | to "/dashboard-superzone"). This helps enhance security through obscurity
    | while keeping route organization clean and flexible.
    |
    */

    'prefix' => env('ADMIN_PREFIX', '/admin'),

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

    'password' => env('ADMIN_PASSWORD', 'password'),

];
