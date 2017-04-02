<?php

declare(strict_types=1);

/**
 * Main controller.
 *
 * Class Controller.
 */
class Controller
{
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
