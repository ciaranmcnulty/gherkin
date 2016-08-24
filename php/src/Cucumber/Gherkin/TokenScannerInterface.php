<?php

namespace Cucumber\Gherkin;

interface TokenScannerInterface
{
    public function read() : Token;
}