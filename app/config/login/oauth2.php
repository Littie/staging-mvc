<?php

return [
    'auth_params' => [
        'redirect_uri'  => 'http://oauth.local.com/auth',
        'response_type' => 'code',
        'client_id'     => '132086215844-7vs9eh9up1ol1abn86i7eoh6m5cr6fih.apps.googleusercontent.com',
        'scope'        => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
    ],

    'token_params' => [
        'client_id'     => '132086215844-7vs9eh9up1ol1abn86i7eoh6m5cr6fih.apps.googleusercontent.com',
        'client_ecret' => 'kqlYB_pVHIK9E3xlnQ7LsvMO',
        'redirect_uri'  => 'http://oauth.local.com/board',
        'grant_type' => 'authorization_code',
    ],

    'authUri'      => 'https://accounts.google.com/o/oauth2/auth',
    'tokenUri'     => 'https://www.googleapis.com/oauth2/v4/token',
];