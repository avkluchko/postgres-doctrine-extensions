# Postgres Doctrine Extensions

Doctrine extensions for working with PostgreSQL database

## Requirements

## Installation

```console
composer require avkluchko/doctrine-postgres-bundle
```

Add the necessary extensions in the doctrine.yaml:

```xaml
doctrine:
    orm:
        dql:
            string_functions:
                cast: AVKluchko\DoctrinePostgresBundle\DQL\Cast
                date_part: AVKluchko\DoctrinePostgresBundle\DQL\DatePart
                make_date: AVKluchko\DoctrinePostgresBundle\DQL\MakeDate
                to_char: AVKluchko\DoctrinePostgresBundle\DQL\ToChar
```

## Usage

```php
// src/Filters/SomeFilter.php
public class SomeFilter
{
    // ...
    protected function createCondition(string $year, string $field, string $operator, string $parameterName): string
    {
        return sprintf(
            'make_date(%s, cast(date_part(\'month\', %s) as integer), cast(date_part(\'day\', %s) as integer)) %s :%s',
            $year,
            $field,
            $field,
            $operator,
            $parameterName
        );
    }
}
```