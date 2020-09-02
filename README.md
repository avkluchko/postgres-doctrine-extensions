# Postgres Doctrine Extensions

Doctrine extensions for working with PostgreSQL database

## Requirements

## Installation

```console
composer require avkluchko/postgres-doctrine-extensions
```

Add the necessary extensions in the doctrine.yaml:

```xaml
doctrine:
    orm:
        dql:
            string_functions:
                cast: AVKluchko\PostgresDoctrineExtensions\DQL\Cast
                date_part: AVKluchko\PostgresDoctrineExtensions\DQL\DatePart
                make_date: AVKluchko\PostgresDoctrineExtensions\DQL\MakeDate
                to_char: AVKluchko\PostgresDoctrineExtensions\DQL\ToChar
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