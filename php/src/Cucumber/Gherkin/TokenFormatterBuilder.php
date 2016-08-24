<?php

namespace Cucumber\Gherkin;

final class TokenFormatterBuilder implements TokenBuilderInterface
{
    /**
     * @var string
     */
    private $result = '';

    /**
     * @var TokenFormatter
     */
    private $formatter;

    public function __construct()
    {
        $this->formatter = new TokenFormatter();
    }

    public function reset()
    {
        // noop
    }

    public function startRule(string $ruleType)
    {
        // noop
    }

    public function endRule(string $ruleType)
    {
        // noop
    }

    public function getResult() : string
    {
        return $this->result;
    }

    public function build(Token $token)
    {
        $this->result .= $this->formatter->formatToken($token) . "\n";
    }
}
