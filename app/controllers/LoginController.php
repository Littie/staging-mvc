<?php

declare(strict_types = 1);

class LoginController extends Controller
{
    public function index() {
        $this->view('login/index');
    }
}