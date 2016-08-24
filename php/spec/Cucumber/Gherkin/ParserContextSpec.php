<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\ParserContext;
use Cucumber\Gherkin\TokenMatcherInterface;
use Cucumber\Gherkin\TokenScannerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserContextSpec extends ObjectBehavior
{
    function let(TokenScannerInterface $tokenScanner, TokenMatcherInterface $tokenMatcher)
    {
        $this->beConstructedWith($tokenScanner, $tokenMatcher, [], []);
    }

    function it_exposes_properties(TokenScannerInterface $tokenScanner, TokenMatcherInterface $tokenMatcher)
    {
        $this->tokenScanner->shouldBe($tokenScanner);
        $this->tokenMatcher->shouldBe($tokenMatcher);
        $this->tokenQueue->shouldBe([]);
        $this->tokenQueue->shouldBe([]);
    }
}
