<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinLineSpan;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GherkinLineSpanSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, 'foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GherkinLineSpan::class);
    }

    function it_equals_itself()
    {
        $this->equals($this)->shouldReturn(true);
    }

    function it_equals_another_equivalent_span()
    {
        $this->equals(new GherkinLineSpan(1, 'foo'))->shouldReturn(true);
    }

    function it_does_not_equal_a_different_span()
    {
        $this->equals(new GherkinLineSpan(2, 'bar'))->shouldReturn(false);
    }

    function it_does_not_equal_a_different_object()
    {
        $this->equals(new \StdClass)->shouldReturn(false);
    }
}
