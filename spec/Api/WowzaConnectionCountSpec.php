<?php
/**
 * Created by PhpStorm.
 * User: gab88slash
 * Date: 26/07/16
 * Time: 01:38
 */

namespace spec\Topix\Hackademy\LaravelWowza\Api;

use PhpParser\Node\Arg;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Topix\Hackademy\LaravelWowza\Api\WowzaConnectionCount;
use Topix\Hackademy\LaravelWowza\Api\Type\ServerCountType;

class WowzaConnectionCountSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(Argument::is('url'), Argument::is(8087),Argument::is('user'), Argument::is('password'));
        $this->shouldHaveType(WowzaConnectionCount::class);
    }

    function it_is_configurable_in_contructor()
    {
        $this->beConstructedWith('urlo',8087,'user','password');
        $this->url->shouldNotBe('url');
        $this->url->shouldBe('urlo');
        $this->port->shouldBe(8087);
        $this->user->shouldBe('user');
        $this->password->shouldBe('password');
    }

    function it_has_a_callable_connection_counts()
    {
        $this->beConstructedWith('',8086,'','');

        $this->connectionCounts()->shouldBeAnInstanceOf(ServerCountType::class);

    }


}