# Description

PhpEnumMapper is a PHP utility class that provides methods to transform and map Enum cases into arrays of values, labels, or attributes. This utility is especially useful when dealing with Enums in contexts like forms, filters, or any view-related data where Enum values and labels are required.

Enums in PHP (introduced in PHP 8.1) can be quite powerful, but there are scenarios where you need to convert them into more usable formats, such as arrays for rendering. PhpEnumMapper makes it easy to convert Enums into different formats by allowing you to extract either their values or customized labels.

This utility includes two main static methods:

- keyValues: Converts Enum cases into a keyed array based on their values and specified attributes.
- keys: Extracts the underlying values from a set of Enum cases.
## Installation

To install the package, run the following command in your Laravel project:

```bash
composer require labrodev/php-enum-mapper
```

## Requirements

- PHP 8.1 or higher

## Configuration

After installing the package, no additional configuration is needed to start using utility.

## Usage

To use the utility, use Utility class in your class and just call existed static methods from it:

```php 

<?php

namespace YourNamespace;

use Labrodev\PhpEnumMapper\EnumMapper;

class YourClass
{
    public function exampleMethod()
    {
        // Assuming you have an Enum OrderStatus
        $cases = OrderStatus::cases();

        // Convert Enum cases to an array of values and translated names
        $mappedValues = EnumMapper::keyValues($cases);

        // Extract only the Enum values
        $enumValues = EnumMapper::keys($cases);
    }
}

```

## Testing

To run the tests included with the package, execute the following command:

```bash
composer test
```
For static analysis to check the package code by PHPStan, execute the following command:

```bash
composer analyse
```

## Security

If you discover any security-related issues, please email admin@labrodev.com instead of using the issue tracker.

## Credits

Labro Dev

## License

The MIT License (MIT). Please see License File for more information.

## Read more

Read more about our web development experince on our [Substack page - Labrodev](https://labrodev.substack.com).