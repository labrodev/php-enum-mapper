<?php

declare(strict_types=1);

namespace Labrodev\PhpEnumMapper\Exceptions;

use Exception;

final class CaseHasNoValue extends Exception
{
    /**
     * @param mixed $case
     * @return self
     */
    public static function make(mixed $case): self
    {
        $message = sprintf(
            'Provided Enum case has no value. Received type: %s. Expected a BackedEnum with a value.',
            gettype($case)
        );

        return new self($message);
    }
}
