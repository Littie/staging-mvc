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

    protected $method = 'index';

    protected $params = [];

    protected $uri = null;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->parseUrl();

        $pathToControllerFile = $this->getControllerPath();

        if (file_exists($pathToControllerFile)) {
            require_once $pathToControllerFile;

            $this->controller = $this->getController();
            $this->setMethodName();
            $this->params = $this->getParameters();
        }


        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Get parameters.
     *
     * @return array
     */
    private function getParameters(): array
    {
        return $this->uri ? array_values($this->uri) : [];
    }

    /**
     * Get method name.
     *
     * @return string
     */
    private function setMethodName()
    {
        if (isset($this->uri[1]) && method_exists($this->controller, $this->uri[1])) {
            $this->method = $this->uri[1];

            unset($this->uri[1]);
        }
    }

    /**
     * Parse URI.
     */
    public function parseUrl() {
        $this->uri = $_SERVER['REQUEST_URI'];

        if(null !== $this->uri) {
            $this->uri = explode('/', filter_var(trim($this->uri, '/')), FILTER_SANITIZE_URL);
        }
    }

    /**
     * Return controller path.
     *
     * @return string
     *
     * @internal param array $uri
     */
    private function getControllerPath(): string
    {
        return __DIR__ . '/../controllers/' . ucfirst($this->uri[0]) . 'Controller.php';
    }

    /**
     * Get controller name.
     *
     * @return Controller
     *
     * @internal param array $uri
     */
    private function getController(): Controller
    {
        $controllerName = ucfirst($this->uri[0]) . 'Controller';

        unset($this->uri[0]);

        return new $controllerName;
    }
}
