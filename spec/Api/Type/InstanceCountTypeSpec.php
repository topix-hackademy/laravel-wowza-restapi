<?php

namespace spec\Topix\Hackademy\LaravelWowza\Api\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\Type\InstanceCountType;
use Topix\Hackademy\LaravelWowza\Api\Type\StreamCountType;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;

class InstanceCountTypeSpec extends ObjectBehavior
{

    function let()
    {
        $url = "";
        $port = 8086;
        $user = '';
        $password ='';
        $this->beConstructedWith(with(new WowzaConnectionCount($url, $port, $user, $password))->connectionCounts()->vhosts()->first()->applications()->first()->instancesData());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(InstanceCountType::class);
    }

    function it_gives_server_info()
    {
        $this->getInfo()->shouldBeArray();
    }

    function it_gives_streams()
    {
        $this->streamsData()->shouldBe(false);
    }

    function it_gets_streams_list()
    {
        $this->streams()->first()->shouldBe(null);
    }
}
