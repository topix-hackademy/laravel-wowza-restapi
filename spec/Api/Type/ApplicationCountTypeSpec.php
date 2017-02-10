<?php

namespace spec\Topix\Hackademy\LaravelWowza\Api\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\Type\InstanceCountType;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;

class ApplicationCountTypeSpec extends ObjectBehavior
{

    function let()
    {
        $url = "";
        $port = 8086;
        $user = '';
        $password ='';
        $this->beConstructedWith(with(new WowzaConnectionCount($url, $port, $user, $password))->connectionCounts()->vhosts()->first()->applicationsData()[0]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Topix\Hackademy\LaravelWowza\Api\Type\ApplicationCountType');
    }

    function it_gives_server_info()
    {
        $this->getInfo()->shouldBeArray();
    }

    function it_gives_instances()
    {
        $this->instancesData()->shouldBeArray();
    }

    function it_gets_applications_list()
    {
        $this->instances()->first()->shouldBeAnInstanceOf(InstanceCountType::class);
    }
}
