<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 25/07/16
 * Time: 14:33
 */

namespace Topix\Hackademy\LaravelWowza\Handler;


use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;
use Topix\Hackademy\WowzaApi\ApiClient;
use Topix\Hackademy\WowzaApi\Configuration;

class WowzaHandlerSdk
{

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;


    protected $wrappedObject;


    public function url($url)
    {
        $this->setUrl($url);

        return $this;
    }

    public function port($url)
    {
        $this->setPort($url);

        return $this;
    }

    public function credentials($user, $password)
    {
        $this->setUsername($user);
        $this->setPassword($password);

        return $this;
    }


    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function with($classname)
    {

        if(!class_exists($classname)) return $this;

        if($classname == WowzaConnectionCount::class)
            $this->wrappedObject = new $classname($this->getUrl(), 8086, $this->getUsername(), $this->getPassword());
        else {
            $this->wrappedObject = new $classname($this->getWowzaRestApiClient());
        }
        return $this;
    }


    private function getWowzaRestApiClient()
    {
        $config = new Configuration();
        $config->setHost($this->getUrl() . ':' . $this->getPort());
        $config->setUsername($this->getUsername());
        $config->setPassword($this->getPassword());
        $config->setSSLVerification(false);
        $config->setDebug(false); //turn on just if tests are failing for major debug

        return new ApiClient($config);
    }

    /**
     * Handle dynamic method calls into the wrapped object.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $wrappedObject = $this->getWrappedObject();

        if( $wrappedObject && method_exists ( $wrappedObject , $method )) return call_user_func_array([$wrappedObject, $method], $parameters);


        return $this;
    }

    /**
     * @return mixed
     */
    public function getWrappedObject()
    {
        return isset($this->wrappedObject) ? $this->wrappedObject : false;
    }

}