<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinLineInterface;
use Cucumber\Gherkin\Location;
use Cucumber\Gherkin\Token;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenSpec extends ObjectBehavior
{
    function let(Location $location, GherkinLineInterface $line)
    {
        $this->beConstructedWith($location, $line);
    }

    function it_is_eof_if_line_is_null(Location $location)
    {
        $this->beConstructedWith($location, null);
        $this->shouldBeEOF();
    }

    function its_token_value_is_EOF_when_it_is_EOF(Location $location)
    {
        $this->beConstructedWith($location, null);
        $this->getTokenValue()->shouldReturn('EOF');
    }

    function its_token_value_comes_from_gherkin_line(GherkinLineInterface $line)
    {
        $line->getLineText(-1)->willReturn('Foo');
        $this->getTokenValue()->shouldReturn('Foo');
    }
}
