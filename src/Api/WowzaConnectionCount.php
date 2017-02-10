<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 01:38
 */

namespace Topix\Hackademy\LaravelWowza\Api;


use GuzzleHttp\Client;
use Sabre\Xml\Reader;
use Sabre\Xml\Service;
use Topix\Hackademy\LaravelWowza\Api\Type\ServerCountType;
use Verdant\XML2Array;

class WowzaConnectionCount
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $port;

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * WowzaConnectionCount constructor.
     * @param string $url
     * @param string $port
     * @param string $user
     * @param string $password
     */
    public function __construct($url, $port = 8086, $user, $password)
    {
        $this->url = $url;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

    public function connectionCountsRaw()
    {
        $client = new Client([
            'base_uri' => $this->url . ':' . $this->port . '/',
            'auth' => [$this->user, $this->password, 'digest'],
        ]);

        $res = $client->request('GET', 'connectioncounts');

        return $res->getBody()->getContents();
    }

    public function connectionCounts()
    {
        $result = XML2Array::createArray($this->connectionCountsRaw());
        return new ServerCountType($result);
    }


}