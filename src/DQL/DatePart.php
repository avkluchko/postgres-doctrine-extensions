<?php

namespace AVKluchko\DoctrinePostgresBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class DatePart extends FunctionNode
{
    public $datePartExpression = null; // day, month, year
    public $fieldExpression = null;

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->datePartExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->fieldExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'DATE_PART(' .
            $this->datePartExpression->dispatch($sqlWalker) . ', ' .
            $this->fieldExpression->dispatch($sqlWalker) .
        ')';
    }
}
