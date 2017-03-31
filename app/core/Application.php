<?php

declare(strict_types=1);

/**
 * Core of application. Main class.
 *
 * Class Application.
 */
class Application
{
    protected $controller = '';

    protected $method = '';

    protected $params = [];

    public function __construct()
    {
        $uri = $this->parseUrl();
        $a = file_exists('./controllers/HomeController.php');
//        if (file_exists('../controllers/' . ucfirst($uri[0]) . 'Controller.php')) {
        if (file_exists(realpath('../controllers/HomeController.php'))) {
            $this->controller = ucfirst($uri[0]) . 'Controller.php';
            unset($uri[0]);
        }

        require_once '../controllers/' . $this->controller;

        echo $this->controller;
    }

    public function parseUrl() {
        $uri = $_SERVER['REQUEST_URI'];

        if(isset($uri)) {
            return explode('/', filter_var(trim($uri, '/')), FILTER_SANITIZE_URL);
        }
    }
}
