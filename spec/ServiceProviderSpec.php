<?php

namespace spec\Topix\Hackademy\LaravelWowza;

use Illuminate\Contracts\Foundation\Application;
use Topix\Hackademy\LaravelWowza\Handler\WowzaHandlerSdk;
use Topix\Hackademy\LaravelWowza\ServiceProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ServiceProviderSpec extends ObjectBehavior
{

    protected $app;

    function let(Application $app)
    {
        $this->app = new \Illuminate\Foundation\Application(
            realpath(__DIR__.'/../')
        );
        $this->beConstructedWith($this->app, true);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ServiceProvider::class);

    }

    function it_is_registerable()
    {
        $this->register();

    }

}
