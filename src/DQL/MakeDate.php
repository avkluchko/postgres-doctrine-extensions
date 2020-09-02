<?php

namespace AVKluchko\PostgresDoctrineExtensions\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class MakeDate extends FunctionNode
{
    public $yearExpression = null;
    public $monthExpression = null;
    public $dayExpression = null;

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->yearExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->monthExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->dayExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'MAKE_DATE(' .
            $this->yearExpression->dispatch($sqlWalker) . ', ' .
            $this->monthExpression->dispatch($sqlWalker) . ', ' .
            $this->dayExpression->dispatch($sqlWalker) .
        ')';
    }
}
