<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinLine;
use Cucumber\Gherkin\Location;
use Cucumber\Gherkin\Token;
use Cucumber\Gherkin\TokenFormatter;
use Cucumber\Gherkin\TokenType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenFormatterSpec extends ObjectBehavior
{
    function it_can_format_EOF_Token()
    {
        $this->formatToken(new Token(new Location(10,10), null))->shouldReturn('EOF');
    }

    function it_can_format_matched_feature()
    {
        $token = new Token(new Location(10,10), new GherkinLine('Feature: foo'));
        $token->matchedType = TokenType::FeatureLine;
        $token->matchedKeyword = 'Feature';
        $token->matchedText = 'foo';
        $token->matchedItems = null;

        $this->formatToken($token)->shouldReturn('(10:10)FeatureLine:Feature/foo/');
    }
}
