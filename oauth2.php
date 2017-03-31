<?php

declare(strict_types = 1);



$clientId = '132086215844-7vs9eh9up1ol1abn86i7eoh6m5cr6fih.apps.googleusercontent.com';
$clientSecret = 'kqlYB_pVHIK9E3xlnQ7LsvMO';
$redirectUri = 'http://oauth.local.com';

$authUri = 'https://accounts.google.com/o/oauth2/auth';

$params = [
    'redirect_uri'  => $redirectUri,
    'response_type' => 'code',
    'client_id'     => $clientId,
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
];

echo $link = '<p><a href="' . $authUri . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Google</a></p>';

if (isset($_GET['code'])) {
    $result = false;

    $params = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code',
        'code' => $_GET['code']
    ];

    $authUri = 'https://www.googleapis.com/oauth2/v4/token';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $authUri);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $tokenInfo = json_decode($result, true);

//    var_dump($tokenInfo);

    if (isset($tokenInfo['access_token'])) {
        $params['access_token'] = $tokenInfo['access_token'];

        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }
}
