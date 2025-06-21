<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default User Password for Seeding
    |--------------------------------------------------------------------------
    |
    | This value is used as the default password when creating user accounts
    | through database seeders (e.g., UserSeeder). It should be defined in
    | your ".env" file using the key USER_PASSWORD for security and flexibility.
    | Make sure to hash this password when assigning it to user records.
    |
    */

    'password' => env('USER_PASSWORD', 'password'),

];
