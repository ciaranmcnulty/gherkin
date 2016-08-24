<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinLine;
use Cucumber\Gherkin\Location;
use Cucumber\Gherkin\Token;
use Cucumber\Gherkin\TokenScannerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenScannerSpec extends ObjectBehavior
{
    function let(\SplFileObject $file)
    {
        $this->beConstructedWith($file);
    }

    function it_is_a_token_scanner()
    {
        $this->shouldHaveType(TokenScannerInterface::class);
    }

    function it_returns_a_null_token_for_null_first_line(\SplFileObject $file)
    {
        $file->fgets()->willReturn(false);

        $token = $this->read();

        $token->shouldBeLike(new Token(new Location(1, 0), null));
    }

    function it_returns_a_token_when_line_is_not_null(\SplFileObject $file)
    {
        $file->fgets()->willReturn('Foo');

        $token = $this->read();

        $token->shouldBeLike(new Token(new Location(1, 0), new GherkinLine('Foo')));
    }

}
