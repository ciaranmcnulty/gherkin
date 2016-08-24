<?php

namespace spec\Cucumber\Gherkin;

use Cucumber\Gherkin\GherkinDialectProviderInterface;
use Cucumber\Gherkin\GherkinLine;
use Cucumber\Gherkin\GherkinLineSpan;
use Cucumber\Gherkin\Location;
use Cucumber\Gherkin\Token;
use Cucumber\Gherkin\TokenMatcherInterface;
use Cucumber\Gherkin\TokenType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenMatcherSpec extends ObjectBehavior
{
    function let(GherkinDialectProviderInterface $dialectProvider)
    {
        $this->beConstructedWith($dialectProvider);
    }

    function it_is_a_token_matcher()
    {
        $this->shouldHaveType(TokenMatcherInterface::class);
    }

    function it_can_be_reset()
    {
        $this->reset();
    }

    function it_matches_EOF()
    {
        $token = new Token(new Location(0,0), null);

        $this->match_EOF($token)->shouldReturn(true);

        assert($token->matchedType == TokenType::EOF);
    }

    function it_matches_language()
    {
        $token = new Token(new Location(10,10), new GherkinLine('# language: en'));

        $this->match_Language($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::Language);
        assert($token->matchedText === 'en');
    }

    function it_matches_tagline()
    {
        $token = new Token(new Location(10,10), new GherkinLine(' @foo @bar @baz'));

        $this->match_TagLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::TagLine);
        assert($token->matchedText === null);
        assert($token->matchedItems == [
            new GherkinLineSpan(2, '@foo'),
            new GherkinLineSpan(7, '@bar'),
            new GherkinLineSpan(12, '@baz')
        ]);
    }

    function it_matches_empty_lines()
    {
        $token = new Token(new Location(10,10), new GherkinLine(''));

        $this->match_Empty($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::Empty);
    }

    function it_matches_comments()
    {
        $token = new Token(new Location(10,10), new GherkinLine('# foo'));

        $this->match_Comment($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::Comment);
        assert($token->matchedText === '# foo');
        assert($token->matchedIndent === 0);
    }

    function it_matches_background_lines()
    {
        $token = new Token(new Location(10,10), new GherkinLine('Background:'));

        $this->match_BackgroundLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::BackgroundLine);
        assert($token->matchedText === '');
        assert($token->matchedKeyword === 'Background');
    }

    function it_matches_feature_line()
    {
        $token = new Token(new Location(10,10), new GherkinLine('Feature: Doing stuff'));

        $this->match_FeatureLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::FeatureLine);
        assert($token->matchedText === 'Doing stuff');
        assert($token->matchedKeyword === 'Feature');
    }

    function it_matches_scenario_lines()
    {
        $token = new Token(new Location(10,10), new GherkinLine('Scenario: Doing stuff'));

        $this->match_ScenarioLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::ScenarioLine);
        assert($token->matchedText === 'Doing stuff');
        assert($token->matchedKeyword === 'Scenario');
    }

    function it_matches_scenario_outline_lines()
    {
        $token = new Token(new Location(10,10), new GherkinLine('Scenario Outline: Doing stuff'));

        $this->match_ScenarioOutlineLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::ScenarioOutlineLine);
        assert($token->matchedText === 'Doing stuff');
        assert($token->matchedKeyword === 'Scenario Outline');
    }

    function it_matches_examples_lines()
    {
        $token = new Token(new Location(10,10), new GherkinLine('Examples:'));

        $this->match_ExamplesLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::ExamplesLine);
        assert($token->matchedText === '');
        assert($token->matchedKeyword === 'Examples');
    }

    function it_matches_step_lines()
    {
        $token = new Token(new Location(10,10), new GherkinLine('When I do a thing'));

        $this->match_StepLine($token)->shouldReturn(true);

        assert($token->matchedType === TokenType::StepLine);
        assert($token->matchedText === 'I do a thing');
        assert($token->matchedKeyword === 'When ');
    }

}
