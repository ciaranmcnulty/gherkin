<?php

namespace Cucumber\Gherkin;

interface TokenBuilderInterface
{
    public function reset();
    public function startRule(string $ruleType);
    public function endRule(string $ruleType);
    public function getResult() : string;
    public function build(Token $token);
}