<?php

namespace Cucumber\Gherkin;

interface GherkinLineInterface
{
    public function indent() : int;
    public function detach();
    public function getLineText(int $indentToRemove) : string;
    public function isEmpty() : bool;
    public function startsWith(string $prefix) : bool;
    public function getRestTrimmed(int $length) : string;

    /**
     * @return GherkinLineSpan[]
     */
    public function getTags() : array;

    /** startswithtitlekeyword, gettablecells */
}
