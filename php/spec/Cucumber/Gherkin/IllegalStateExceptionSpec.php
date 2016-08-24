<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\IllegalStateException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IllegalStateExceptionSpec extends ObjectBehavior
{
    function it_is_an_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }
}
