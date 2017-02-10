<?php

namespace spec\Topix\Hackademy\LaravelWowza\Api\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;

class StreamCountTypeSpec extends ObjectBehavior
{

    function let()
    {
        $url = "";
        $port = 8086;
        $user = '';
        $password ='';
        $this->beConstructedWith(with(new WowzaConnectionCount($url, $port, $user, $password))->connectionCounts()->vhosts()->first()->applications()->first()->instances()->first()->streamsData()[0]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Topix\Hackademy\LaravelWowza\Api\Type\StreamCountType');
    }
}
