<?php

declare(strict_types=1);

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        echo 'home/index';
    }

    public function test()
    {
        echo 'home/test';
    }
}
