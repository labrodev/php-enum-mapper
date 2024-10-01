<?php

declare(strict_types=1);

namespace Labrodev\PhpEnumMapper\Exceptions;

use \Exception;

final class CaseIsNotEnum extends Exception
{
    /**
     * @param mixed $case
     * @return self
     */
    public static function make(mixed $case): self
    {
        $message = sprintf(
            'Provided value is not an Enum. Received type: %s. Expected type: UnitEnum or BackedEnum.',
            gettype($case)
        );

        return new self($message);
    }
}
