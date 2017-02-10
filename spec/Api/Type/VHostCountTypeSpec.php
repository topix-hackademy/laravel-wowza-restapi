<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 16:52
 */

namespace spec\Topix\Hackademy\LaravelWowza\Api\Type;

use Illuminate\Support\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\Type\ApplicationCountType;
use Topix\Hackademy\LaravelWowza\Api\Type\VHostCountType;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;

class VHostCountTypeSpec extends ObjectBehavior
{

    function let()
    {
        $url = "";
        $port = 8086;
        $user = '';
        $password ='';
        $this->beConstructedWith(with(new WowzaConnectionCount($url, $port, $user, $password))->connectionCounts()->vhostsData());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(VHostCountType::class);
    }

    function it_gives_server_info()
    {
        $this->getInfo()->shouldBeArray();
    }

    function it_gives_applications()
    {
        $this->applicationsData()->shouldBeArray();
    }

    function it_gets_applications_list()
    {
        $this->applications()->shouldBeAnInstanceOf(Collection::class);
        $this->applications()->first()->shouldBeAnInstanceOf(ApplicationCountType::class);
    }
}