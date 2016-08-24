<?php

namespace Cucumber\Gherkin;

class TokenFormatter
{
    public function formatToken(Token $token) : string
    {
        if ($token->isEOF()) {
            return 'EOF';
        }

        return sprintf(
            "(%s:%s)%s:%s/%s/%s",
            $token->location->getLine(),
            $token->location->getColumn(),
            $token->matchedType,
            $token->matchedKeyword,
            $token->matchedText,
            null
        );
    }
}
