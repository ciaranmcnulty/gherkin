<?php

namespace Cucumber\Gherkin;

final class Token
{
    /**
     * @var GherkinLineInterface
     */
    public $line;

    /**
     * @var Location
     */
    public $location;

    public $matchedType;
    public $matchedKeyword;
    public $matchedText;
    public $matchedItems;
    public $matchedGherkinDialect;
    public $matchedIndent;

    public function __construct( Location $location, GherkinLineInterface $line = null)
    {
        $this->location = $location;
        $this->line = $line;
    }

    public function isEOF() : bool
    {
        return $this->line == null;
    }

    public function getTokenValue() : string
    {
        return $this->isEOF() ? 'EOF' : $this->line->getLineText(-1);
    }
}
