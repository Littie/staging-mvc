<?php

declare(strict_types = 1);

/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    public function index() {
        $config = $this->config('login/oauth2');

        $authUri = $config['authUri'];

        $href = $authUri . '?' . urldecode(http_build_query($config['auth_params']));

        $this->view('login/index', ['href' => $href]);
    }
}