<?php

namespace AVKluchko\PostgresDoctrineExtensions\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class ToChar extends FunctionNode
{
    public $timestamp = null;
    public $pattern = null;

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->timestamp = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->pattern = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'TO_CHAR(' .
            $this->timestamp->dispatch($sqlWalker) . ', ' .
            $this->pattern->dispatch($sqlWalker) .
        ')';
    }
}
