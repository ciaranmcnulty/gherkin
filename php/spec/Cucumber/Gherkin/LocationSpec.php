<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\Location;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(10, 20);
    }

    function it_stores_line()
    {
        $this->getLine()->shouldReturn(10);
    }

    function it_stores_column()
    {
        $this->getColumn()->shouldReturn(20);
    }
}
