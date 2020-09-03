<?php

namespace AVKluchko\PostgresDoctrineExtensions\Tests\DQL;

use AVKluchko\PostgresDoctrineExtensions\DQL\Cast;
use AVKluchko\PostgresDoctrineExtensions\Tests\DoctrineTestCase;
use AVKluchko\PostgresDoctrineExtensions\Tests\Entities\DateEntity;
use Doctrine\ORM\QueryBuilder;

class CastTest extends DoctrineTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->configuration->addCustomStringFunction('CAST', Cast::class);
    }

    public function testDatePart(): void
    {
        $qb = new QueryBuilder($this->entityManager);
        $qb->select("cast(8 as integer)")
            ->from(DateEntity::class, 'dt');

        $expected = "SELECT CAST(8 as integer) AS sclr_0 FROM DateEntity d0_";

        self::assertEquals($expected, $qb->getQuery()->getSQL());
    }
}
