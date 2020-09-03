<?php

namespace AVKluchko\PostgresDoctrineExtensions\Tests\DQL;

use AVKluchko\PostgresDoctrineExtensions\DQL\DatePart;
use AVKluchko\PostgresDoctrineExtensions\Tests\DoctrineTestCase;
use AVKluchko\PostgresDoctrineExtensions\Tests\Entities\DateEntity;
use Doctrine\ORM\QueryBuilder;

class DatePartTest extends DoctrineTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->configuration->addCustomStringFunction('DATE_PART', DatePart::class);
    }

    public function testDatePart(): void
    {
        $qb = new QueryBuilder($this->entityManager);
        $qb->select("date_part('month', dt.created)")
            ->from(DateEntity::class, 'dt');

        $expected = "SELECT DATE_PART('month', d0_.created) AS sclr_0 FROM DateEntity d0_";

        self::assertEquals($expected, $qb->getQuery()->getSQL());
    }
}
