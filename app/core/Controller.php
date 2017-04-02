<?php

declare(strict_types=1);

/**
 * Main controller.
 *
 * Class Controller.
 */
class Controller
{
    /**
     * Config handler.
     * 
     * @param $config
     * 
     * @return array
     */
    protected function config($config): array
    {
        return require_once '../app/config/' . $config . '.php';
    }

    /**
     * View handler.
     *
     * @param $view
     * @param array $data
     */
    protected function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
