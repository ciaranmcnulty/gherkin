<?php

namespace Cucumber\Gherkin;

class GherkinLineSpan
{
    /**
     * @var int
     */
    private $column;

    /**
     * @var string
     */
    private $text;

    public function __construct(int $column, string $text)
    {
        $this->column = $column;
        $this->text = $text;
    }

    /**
     * @param object $other
     */
    public function equals($other) : bool
    {
        return $this == $other;
    }

    /** @todo implement hashCode */
}
