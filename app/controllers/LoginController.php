<?php

declare(strict_types = 1);

/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    public function index() {
        //'code' => $_GET['code'],

        $config = $this->config('login/oauth2');

        $authUri = $config['authUri'];

        $href = $authUri . '?' . urldecode(http_build_query($config['auth_params']));

//        var_dump($href);

        $this->view('login/index', ['href' => $href]);
    }
}