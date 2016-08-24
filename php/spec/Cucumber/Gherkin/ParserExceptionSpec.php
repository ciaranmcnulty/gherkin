<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\ParserException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserExceptionSpec extends ObjectBehavior
{
    function it_is_an_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }
}
