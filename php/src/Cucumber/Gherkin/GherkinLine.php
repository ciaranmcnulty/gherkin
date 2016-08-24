<?php

namespace Cucumber\Gherkin;

class GherkinLine implements GherkinLineInterface
{
    /**
     * @var string
     */
    private $lineText;

    /**
     * @var string
     */
    private $trimmedLineText;

    public function __construct(string $lineText)
    {
        $this->lineText = $lineText;
        $this->trimmedLineText = ltrim($lineText);
    }

    public function indent() : int
    {
        return strlen($this->lineText) - strlen($this->trimmedLineText);
    }

    public function detach()
    {
        // noop
    }

    public function getLineText(int $indentToRemove) : string
    {
        if ($indentToRemove < 0 || $indentToRemove > $this->indent()) {
            return $this->trimmedLineText;
        }

        return substr($this->lineText, $indentToRemove);
    }

    public function isEmpty() : bool
    {
        return strlen($this->trimmedLineText) === 0;
    }

    public function startsWith(string $prefix) : bool
    {
        return strpos($this->trimmedLineText, $prefix) === 0;
    }

    /**
     * @return GherkinLineSpan[]
     */
    public function getTags() : array
    {
        preg_match_all('/(?P<span>\\S+)/', $this->lineText, $matches, PREG_OFFSET_CAPTURE);

        return array_map(
            function (array $match) : GherkinLineSpan {
                $offset = $match[1] + 1; // first col is 1 not 0
                $string = $match[0];

                return new GherkinLineSpan($offset, $string);
            },
            $matches['span']
        );
    }

    public function getRestTrimmed(int $length) : string
    {
        return trim(substr($this->trimmedLineText, $length));
    }

    /** @todo not complete */
}
