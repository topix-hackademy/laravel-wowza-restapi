<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 25/07/16
 * Time: 14:35
 */

namespace spec\Topix\Hackademy\LaravelWowza\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\Type\ServerCountType;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;
use Topix\Hackademy\LaravelWowza\Handler\WowzaHandlerSdk;
use Topix\Hackademy\LaravelWowza\ServiceProvider;
use Topix\Hackademy\WowzaApi\Client\VserversApi;
use Topix\Hackademy\WowzaApi\Configuration;
use Topix\Hackademy\WowzaApi\Model\ServerConfig;
use Topix\Hackademy\WowzaApi\Model\ServersConfig;


class WowzaHandlerSdkSpec extends ObjectBehavior
{

    protected $app;

    function let()
    {
        $this->app = new \Illuminate\Foundation\Application(
            realpath(__DIR__.'/../')
        );

        $serviceProvider = with(new ServiceProvider($this->app))->register();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(WowzaHandlerSdk::class);
    }

    function it_is_registered()
    {

        $this->shouldHaveType($this->app->make(WowzaHandlerSdk::class));

    }

    public function it_sets_an_url()
    {
        $url = 'or01.top-ix.org';

        $this->setUrl($url);

        $this->getUrl()->shouldBe($url);
    }

    function it_adds_a_url_concatenating()
    {
        $url = 'or01.top-ix.org';

        $this->url($url)->shouldReturnAnInstanceOf(WowzaHandlerSdk::class);

        $this->getUrl()->shouldBe($url);
    }

    function it_sets_a_port()
    {
        $port = 8087;

        $this->setPort($port);

        $this->getPort()->shouldBe($port);
    }

    function it_adds_a_port_concatenating()
    {
        $port = 8087;

        $this->port($port)->shouldReturnAnInstanceOf(WowzaHandlerSdk::class);

        $this->getPort()->shouldBe($port);
    }


    function it_sets_user_and_password()
    {
        $user = "user";
        $password = "password";

        $this->setUsername($user);
        $this->getUsername()->shouldBe($user);
        $this->setPassword($password);
        $this->getPassword()->shouldBe($password);

    }

    function it_adds_credentials_concatenating()
    {
        $user = "user";
        $password = "password";

        $this->credentials($user, $password)->shouldReturnAnInstanceOf(WowzaHandlerSdk::class);
        $this->getUsername()->shouldBe($user);
        $this->getPassword()->shouldBe($password);
    }

    function it_call_connection_counts()
    {
        $url = "";
        $port = 8086;
        $user = "";
        $password = "";

        $this->credentials($user,$password);
        $this->url($url);
        $this->port($port);

        $this->with(WowzaConnectionCount::class)->shouldReturnAnInstanceOf(WowzaHandlerSdk::class);
        $this->getWrappedObject()->shouldReturnAnInstanceOf(WowzaConnectionCount::class);
        $this->connectionCounts()->shouldReturnAnInstanceOf(ServerCountType::class);

    }

    function it_calls_a_wowza_rest_api_method()
    {
        $url = 'or01.top-ix.org';
        $port = 8087;
        $user = "";
        $password = "";

        $this->credentials($user,$password);
        $this->url($url);
        $this->port($port);

        $this->with(VserversApi::class)->shouldReturnAnInstanceOf(WowzaHandlerSdk::class);
        $this->getWrappedObject()->shouldReturnAnInstanceOf(VserversApi::class);
        $obj = $this->getWrappedObject();

        $obj->getConfig()->shouldReturnAnInstanceOf(Configuration::class);

        $this->getServersConfig()->shouldReturnAnInstanceOf(ServersConfig::class);
    }


}