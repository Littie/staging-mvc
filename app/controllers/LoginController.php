<?php

declare(strict_types = 1);

class LoginController extends Controller
{
    public function index() {
        $config = $this->config('login/oauth2');

        var_dump($config);

        $this->view('login/index');
    }
}