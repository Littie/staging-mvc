<?php

declare(strict_types = 1);

/**
 * Class Request.
 */
class Request
{
    const GET = 'GET';
    const POST = 'POST';

    protected $params = [];

    protected $uri = '';

    public function __construct()
    {
        $this->init();
    }

    public function getParameter(string $parameter)
    {
        return $this->params[$parameter];
    }
    
    /**
     * Redirect helper;
     * 
     * @param $url
     */
    public function redirect($url)
    {
        header('Location: ' . $url);

        exit();
    }

    /**
     * Return query string path.
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Init POST parameters.
     */
    private function initPost()
    {

    }

    /**
     * Init GET parameters.
     */
    private function initGet()
    {
        parse_str($_SERVER['QUERY_STRING'], $this->params);
        $this->uri = $_SERVER['REDIRECT_URL'];
    }

    /**
     * Init parameters.
     */
    private function init()
    {
        if ($_SERVER['REQUEST_METHOD'] === self::GET) {
            $this->initGet();
        } elseif ($_SERVER['REQUEST_METHOD'] === self::POST) {
            $this->initPost();
        }
    }
}