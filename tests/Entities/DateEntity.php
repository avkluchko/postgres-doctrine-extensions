<?php

namespace AVKluchko\PostgresDoctrineExtensions\Tests\Entities;

/**
 * @Entity
 */
class DateEntity
{
    /**
     * @Id()
     * @GeneratedValue()
     * @Column(type="integer")
     */
    public $id;

    /**
     * @Column(type="date")
     */
    public $created;
}