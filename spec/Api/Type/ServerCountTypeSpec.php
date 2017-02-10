<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 16:06
 */

namespace spec\Topix\Hackademy\LaravelWowza\Api\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\Type\ServerCountType;
use Topix\Hackademy\LaravelWowza\Api\Type\VHostCountType;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;

class ServerCountTypeSpec extends ObjectBehavior
{

    function let()
    {
        $url = "";
        $port = 8086;
        $user = '';
        $password ='';
        $this->beConstructedWith(with(new WowzaConnectionCount($url, $port, $user, $password))->connectionCountsRaw());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ServerCountType::class);
    }

    function it_gives_server_info()
    {
        $this->getInfo()->shouldBeArray();
    }

    function it_gets_vhosts()
    {
        $this->vhosts()->first()->shouldBeAnInstanceOf(VHostCountType::class);
    }
}