<?php

namespace AVKluchko\PostgresDoctrineExtensions\Tests\DQL;

use AVKluchko\PostgresDoctrineExtensions\DQL\MakeDate;
use AVKluchko\PostgresDoctrineExtensions\Tests\DoctrineTestCase;
use AVKluchko\PostgresDoctrineExtensions\Tests\Entities\DateEntity;
use Doctrine\ORM\QueryBuilder;

class MakeDateTest extends DoctrineTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->configuration->addCustomStringFunction('MAKE_DATE', MakeDate::class);
    }

    public function testDatePart(): void
    {
        $qb = new QueryBuilder($this->entityManager);
        $qb->select("make_date(2020, 08, 15)")
            ->from(DateEntity::class, 'dt');

        $expected = "SELECT MAKE_DATE(2020, 08, 15) AS sclr_0 FROM DateEntity d0_";

        self::assertEquals($expected, $qb->getQuery()->getSQL());
    }
}
