<?php

namespace Cucumber\Gherkin;

interface TokenMatcherInterface
{
    public function match_EOF(Token $token) : bool;
    public function match_Language(Token $token) : bool;
    public function match_TagLine(Token $token) : bool;
    public function match_FeatureLine(Token $token) : bool;
    public function match_Empty(Token $token) : bool;
    public function match_Comment(Token $token) : bool;
    public function match_BackgroundLine(Token $token) : bool;
    public function match_ScenarioLine(Token $token) : bool;
    public function match_StepLine(Token $token) : bool;
    public function match_ScenarioOutlineLine(Token $token) : bool;
    public function match_ExamplesLine(Token $token) : bool;
    public function match_DocStringSeparator(Token $token) : bool;
    public function match_TableRow(Token $token) : bool;
    public function match_Other(Token $token) : bool;
    public function reset();
}