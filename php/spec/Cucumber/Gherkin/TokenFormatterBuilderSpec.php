<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinLine;
use Cucumber\Gherkin\Location;
use Cucumber\Gherkin\RuleType;
use Cucumber\Gherkin\Token;
use Cucumber\Gherkin\TokenBuilderInterface;
use Cucumber\Gherkin\TokenType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenFormatterBuilderSpec extends ObjectBehavior
{
    function it_is_a_builder()
    {
        $this->shouldHaveType(TokenBuilderInterface::class);
    }

    function it_can_start_rule()
    {
        $this->startRule(RuleType::_Comment);
    }

    function it_can_end_rule()
    {
        $this->endRule(RuleType::_Comment);
    }

    function it_can_be_reset()
    {
        $this->reset();
    }

    function it_returns_empty_string_when_initialised()
    {
        $this->getResult()->shouldReturn('');
    }

    function it_returns_formatted_tokens_with_carriage_return_when_built()
    {
        $token = new Token(new Location(1, 1), new GherkinLine('Feature: Foo'));
        $token->matchedType = TokenType::FeatureLine;
        $token->matchedKeyword = 'Feature';
        $token->matchedText = 'Foo';
        $token->matchedItems = null;

        $this->build($token);

        $token = new Token(new Location(1, 2));
        $token->matchedType = TokenType::EOF;

        $this->build($token);

        $this->getResult()->shouldReturn(<<<TOKENEND
(1:1)FeatureLine:Feature/Foo/
EOF

TOKENEND
);
    }

}
