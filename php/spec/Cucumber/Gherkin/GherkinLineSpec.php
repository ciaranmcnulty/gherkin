<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinLine;
use Cucumber\Gherkin\GherkinLineInterface;
use Cucumber\Gherkin\GherkinLineSpan;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GherkinLineSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('    Feature:foo');
    }

    function it_is_a_gherkin_line()
    {
        $this->shouldHaveType(GherkinLineInterface::class);
    }

    function it_does_not_indent_a_line_without_one()
    {
        $this->beconstructedWith('Line');
        $this->indent()->shouldReturn(0);
    }

    function it_returns_the_indent_for_a_line()
    {
        $this->indent()->shouldReturn(4);
    }

    function it_can_detach()
    {
        $this->detach();
    }

    function it_returns_the_text()
    {
        $this->getLineText(0)->shouldReturn('    Feature:foo');
    }

    function it_returns_the_text_without_indent()
    {
        $this->getLineText(4)->shouldReturn('Feature:foo');
    }

    function it_returns_the_trimmed_text_when_indent_is_negative()
    {
        $this->getLineText(-4)->shouldReturn('Feature:foo');
    }

    function it_returns_the_trimmed_text_when_indent_is_too_large()
    {
        $this->getLineText(5)->shouldReturn('Feature:foo');
    }

    function it_is_empty_if_string_is_empty()
    {
        $this->beConstructedWith('');
        $this->shouldBeEmpty();
    }

    function it_is_not_empty_if_string_is_not_empty()
    {
        $this->beConstructedWith('abc');
        $this->shouldNotBeEmpty();
    }

    function it_is_empty_if_the_string_is_empty_when_trimmed()
    {
        $this->beConstructedWith('    ');
        $this->shouldBeEmpty();
    }

    function it_does_not_start_with_wrong_string()
    {
        $this->startsWith('Scenario')->shouldReturn(false);
    }

    function it_starts_with_string_if_trimmed_line_starts_with_string()
    {
        $this->startsWith('Feature')->shouldReturn(true);
    }

    function it_doesnt_return_any_tags_for_empty_string()
    {
        $this->beConstructedWith('     ');
        $this->getTags()->shouldReturn([]);
    }

    function it_returns_tags_when_string_contains_non_whitespace_chars()
    {
        $this->beConstructedWith('@this @is  @atag');
        $this->getTags()->shouldBeLike([
            new GherkinLineSpan(1, "@this"),
            new GherkinLineSpan(7, "@is"),
            new GherkinLineSpan(12, "@atag")
        ]);
    }

    function it_includes_indent_when_calculating_tag_offset()
    {
        $this->beConstructedWith("    @this @is  @atag  ");
        $this->getTags()->shouldBeLike([
            new GherkinLineSpan(5, "@this"),
            new GherkinLineSpan(11, "@is"),
            new GherkinLineSpan(16, "@atag")
        ]);
    }

    function it_returns_rest_of_string_after_offset()
    {
        $this->beConstructedWith('foo     bar');

        $this->getRestTrimmed(4)->shouldReturn('bar');
    }

    /**
     * @todo implement getTableCells
     */
}
