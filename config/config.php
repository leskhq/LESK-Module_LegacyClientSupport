<?php
return [

    /*
    |------------------------------------------------------------------
    | Set the legacy client support middleware behaviour
    |------------------------------------------------------------------
    |
    | Supported behaviour modes are:
    |    allow: Pass through unimpeded.
    |    warn : Display a flash warning.
    |    force: Force a redirection to a static page.
    |
    */
    'behaviour' => [
        'default' => 'warn',
        'IE' => [
            'default' => 'block',
            '>10' => 'warn',
            '10'  => 'block',
            '<10' => 'block',
        ],
        'Edge' => [
            'default' => 'warn',
        ],
        'Chrome' => [
            'default' => 'allow',
        ],
        'Safari' => [
            'default' => 'allow',
        ],
        'Opera' => [
            'default' => 'allow',
        ],
    ],

    /*
    |------------------------------------------------------------------
    | Path to exempt from the legacy client support middleware
    |------------------------------------------------------------------
    |
    | List of path to exempt from the legacy client support middleware.
    |
    */
    'exemptions-path' => [
        'legacy_client_support',
    ],


    /*
    |-------------------------------------------------------------------------------------
    | Path to exempt from the legacy client support middleware based on Regular Expression
    |-------------------------------------------------------------------------------------
    |
    | Paths that should be exempt from the walled garden based on Regular
    | Expressions.
    |
    */
    'exemptions-regex' => [
        '/password\/reset\/.*/',
        '/auth\/verify\/.*/',
    ],

];

