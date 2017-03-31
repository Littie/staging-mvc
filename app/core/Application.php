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
        $pathToControllerFile = $this->getControllerPath($uri);

        if (file_exists($pathToControllerFile)) {
            $this->getControllerName($uri);
        }

        require_once $pathToControllerFile;

        $this->controller = new $this->controller();
    }

    public function parseUrl() {
        $uri = $_SERVER['REQUEST_URI'];

        if(isset($uri)) {
            return explode('/', filter_var(trim($uri, '/')), FILTER_SANITIZE_URL);
        }
    }

    /**
     * Return controller path.
     *
     * @param array $uri
     *
     * @return string
     */
    private function getControllerPath(array $uri): string
    {
        return __DIR__ . '/../controllers/' . ucfirst($uri[0]) . 'Controller.php';
    }

    /**
     *
     */
    private function getControllerName(array &$uri)
    {
        $this->controller = ucfirst($uri[0]) . 'Controller';
        unset($uri[0]);
    }
}
