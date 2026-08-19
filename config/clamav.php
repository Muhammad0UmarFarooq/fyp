<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ClamAV Virus Scanner Enabled Flag
    |--------------------------------------------------------------------------
    |
    | When enabled, uploaded files will be scanned using ClamAV.
    |
    */
    'enabled' => env('CLAMAV_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | ClamAV Binary Path
    |--------------------------------------------------------------------------
    |
    | Path to the clamscan executable.
    |
    */
    'binary' => env('CLAMAV_BINARY', '/usr/bin/clamscan'),

    /*
    |--------------------------------------------------------------------------
    | Scan Timeout
    |--------------------------------------------------------------------------
    |
    | Maximum execution time in seconds for a clamscan process.
    |
    */
    'timeout' => env('CLAMAV_TIMEOUT', 60),
];
