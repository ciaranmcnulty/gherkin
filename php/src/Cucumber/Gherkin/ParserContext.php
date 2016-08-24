<?php

namespace Cucumber\Gherkin;

class ParserContext
{
    /**
     * @var TokenScannerInterface
     */
    public $tokenScanner;

    /**
     * @var TokenMatcherInterface
     */
    public $tokenMatcher;

    /**
     * @var Token[]
     */
    public $tokenQueue;

    /**
     * @var ParserException[]
     */
    public $errors;

    /**
     * @param TokenScannerInterface $tokenScanner
     * @param TokenMatcherInterface $tokenMatcher
     * @param Token[] $tokenQueue
     * @param ParserException[] $errors
     */
    public function __construct(
        TokenScannerInterface $tokenScanner,
        TokenMatcherInterface $tokenMatcher,
        array $tokenQueue,
        array $errors
    )
    {
        $this->tokenScanner = $tokenScanner;
        $this->tokenMatcher = $tokenMatcher;
        $this->tokenQueue = $tokenQueue;
        $this->errors = $errors;
    }
}
