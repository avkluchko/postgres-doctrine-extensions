<?php

namespace AVKluchko\PostgresDoctrineExtensions\Tests\DQL;

use AVKluchko\PostgresDoctrineExtensions\DQL\ToChar;
use AVKluchko\PostgresDoctrineExtensions\Tests\DoctrineTestCase;
use AVKluchko\PostgresDoctrineExtensions\Tests\Entities\DateEntity;
use Doctrine\ORM\QueryBuilder;

class ToCharTest extends DoctrineTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->configuration->addCustomStringFunction('TO_CHAR', ToChar::class);
    }

    public function testToChar(): void
    {
        $qb = new QueryBuilder($this->entityManager);
        $qb->select("to_char(dt.created, 'HH12:MI:SS')")
            ->from(DateEntity::class, 'dt');

        $expected = "SELECT TO_CHAR(d0_.created, 'HH12:MI:SS') AS sclr_0 FROM DateEntity d0_";

        self::assertEquals($expected, $qb->getQuery()->getSQL());
    }
}
