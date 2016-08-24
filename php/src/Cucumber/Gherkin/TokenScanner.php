<?php

namespace Cucumber\Gherkin;

final class TokenScanner implements TokenScannerInterface
{
    /**
     * @var \SplFileObject
     */
    private $file;

    private $lineNumber = 0;

    public function __construct(\SplFileObject $file)
    {
        $this->file = $file;
    }

    public function read() : Token
    {
        $location = new Location(++$this->lineNumber, 0);
        $line = $this->file->fgets();

        return new Token(
            $location,
            $line ? new GherkinLine(rtrim($line, "\n")) : null
        );
    }
}
