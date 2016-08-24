<?php

namespace Cucumber\Gherkin;

final class TokenMatcher implements TokenMatcherInterface
{
    const LANGUAGE_PATTERN = "/^\\s*#\\s*language\\s*:\\s*([a-zA-Z\\-_]+)\\s*$/";

    /**
     * @var GherkinDialectProviderInterface
     *
     * @todo actually use dialectprovider
     */
    private $dialectProvider;

    public function __construct(GherkinDialectProviderInterface $dialectProvider = null)
    {
        $this->dialectProvider = $dialectProvider;
    }

    public function reset()
    {
        // TODO: write logic here
    }

    public function match_EOF(Token $token) : bool
    {
        if ($token->isEOF()) {
            $this->setTokenMatched($token, TokenType::EOF);

            return true;
        }

        return false;
    }

    public function match_Language(Token $token) : bool
    {
        if (preg_match(self::LANGUAGE_PATTERN, $token->line->getLineText(0), $matches)) {
            $this->setTokenMatched($token, TokenType::Language, $matches[1]);

            // Todo: keep current dialect
            return true;
        }

        return false;
    }

    public function match_TagLine(Token $token) : bool
    {
        if ($token->line->startsWith(GherkinLanguageConstants::TAG_PREFIX)) {
            $this->setTokenMatched($token, TokenType::TagLine, null, null, null, $token->line->getTags());

            return true;
        }

        return false;
    }

    private function setTokenMatched(
        Token $token,
        string $matchedType,
        string $text = null,
        string $keyword = null,
        int $indent = null,
        array $items = null
    )
    {
        $token->matchedType = $matchedType;
        $token->matchedText = $text;
        $token->matchedItems = $items;
        $token->matchedKeyword = $keyword;

        // todo cover these in tests
        $token->matchedIndent = $indent ?: (!$token->line ? 0 : $token->line->indent());
        $token->location = new Location($token->location->getLine(), $token->matchedIndent + 1);
    }

    public function match_FeatureLine(Token $token) : bool
    {
        return $this->matchTitleLine($token, TokenType::FeatureLine, ['Feature']);
    }

    private function matchTitleLine(Token $token, string $tokenType, array $keywords) : bool
    {
        foreach ($keywords as $keyword) {
            if ($token->line->startsWith($keyword)) {
                $title = $token->line->getRestTrimmed(
                    strlen($keyword) +
                    strlen(GherkinLanguageConstants::TITLE_KEYWORD_SEPARATOR)
                );
                $this->setTokenMatched($token, $tokenType, $title, $keyword);

                return true;
            }
        }
        return false;
    }

    public function match_Empty(Token $token) : bool
    {
        if ($token->line->isEmpty()) {
            $this->setTokenMatched($token, TokenType::Empty);

            return true;
        }

        return false;
    }

    public function match_Comment(Token $token) : bool
    {
        if ($token->line->startsWith(GherkinLanguageConstants::COMMENT_PREFIX)) {
            $text = $token->line->getLineText(0);
            $indent = 0;
            $this->setTokenMatched($token, TokenType::Comment, $text, null, $indent);

            return true;
        }

        return false;
    }

    public function match_BackgroundLine(Token $token) : bool
    {
        return $this->matchTitleLine($token, TokenType::BackgroundLine, ['Background']);
    }

    public function match_ScenarioLine(Token $token) : bool
    {
        return $this->matchTitleLine($token, TokenType::ScenarioLine, ['Scenario']);
    }

    public function match_StepLine(Token $token) : bool
    {
        $keywords = ['Given ', 'When ', 'Then '];
        foreach ($keywords as $keyword) {
            if ($token->line->startsWith($keyword)) {
                $stepText = $token->line->getRestTrimmed(strlen($keyword));
                $this->setTokenMatched($token, TokenType::StepLine, $stepText, $keyword);

                return true;
            }
        }
        return false;
    }

    public function match_ScenarioOutlineLine(Token $token) : bool
    {
        return $this->matchTitleLine($token, TokenType::ScenarioOutlineLine, ['Scenario Outline']);
    }

    public function match_ExamplesLine(Token $token) : bool
    {
        return $this->matchTitleLine($token, TokenType::ExamplesLine, ['Examples']);
    }

    /** @todo implement */
    public function match_DocStringSeparator(Token $token) : bool
    {
        return false;
    }

    /** @todo implement */
    public function match_TableRow(Token $token) : bool
    {
        return false;
    }

    /** @todo implement */
    public function match_Other(Token $token) : bool
    {
        return false;
    }
}
