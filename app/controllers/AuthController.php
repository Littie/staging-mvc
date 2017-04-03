<?php

declare(strict_types = 1);

/**
 * Class AuthController.
 */
class AuthController extends Controller
{
    protected $request;
    
    protected $config;
    
    protected $tokenInfo = null;

    public function __construct()
    {
        $this->request = new Request();
        $this->config = $this->config('login/oauth2');
    }

    /**
     * Index controller method.
     */
    public function index()
    {
        $this->setData();

        $this->request->redirect('board');
    }

    /**
     * Set data.
     */
    private function setData()
    {
        $result = $this->getToken();

        $this->tokenInfo = json_decode($result, true);

        $this->getUserData();
    }

    /**
     * Get user's data.
     */
    private function getUserData()
    {
        $params = $this->config['token_params'];
        $params['access_token'] = $this->tokenInfo['access_token'];
        $uri = $this->config['userUri'];

        $userInfo = json_decode(file_get_contents($uri . '?' . urldecode(http_build_query($params))), true);

        var_dump($userInfo);
    }

    /**
     * Get token data.
     *
     * @return mixed
     */
    private function getToken()
    {
        $authUri = $this->config['tokenUri'];
        $params = $this->config['token_params'];
        $params['code'] = $this->request->getParameter('code');

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $authUri);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}