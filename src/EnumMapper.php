<?php

declare(strict_types=1);

namespace Labrodev\PhpEnumMapper;

use BackedEnum;
use Labrodev\PhpEnumMapper\Exceptions\CaseHasNoValue;
use Labrodev\PhpEnumMapper\Exceptions\CaseIsNotEnum;
use UnitEnum;

/**
 * A utility class for formatting Enums.
 *
 * This class provides a static method to transform Enum cases into
 * a list of values based on a specified attribute or method. If no attribute
 * is specified, it defaults to translating the Enum case name.
 *
 * It is recommended to use it when rendering Enum lists in templates or view models (forms, filters, etc.).
 */
final class EnumMapper
{
    /**
     * Transforms an array of Enum cases into a keyed array of labels or attributes.
     *
     * Each Enum case is verified to ensure it is an instance of an Enum. The method then
     * proceeds to either call a specified method on the Enum case (if provided and exists) to
     * obtain a value, or defaults to using a translated name of the Enum case. The resulting array
     * is keyed by the Enum cases' associated values, ensuring a meaningful and accessible structure
     * for further use.
     *
     * @param array<UnitEnum> $cases The Enum cases to be transformed.
     * @param string|null $attribute Optional. The attribute or method name to retrieve from each Enum case.
     * @return array<int|string,mixed> A keyed array of transformed Enum case values, with Enum values or case names as keys.
     * @throws CaseIsNotEnum If any item in the provided array is not an instance of an Enum.
     * @throws CaseHasNoValue If a BackedEnum has no value.
     */
    public static function keyValues(array $cases, ?string $attribute = null): array
    {
        $transformed = [];

        foreach ($cases as $case) {
            if (!$case instanceof UnitEnum) {
                throw CaseIsNotEnum::make($case);
            }

            // If the case is a BackedEnum, use its value as the key
            if ($case instanceof BackedEnum) {
                $key = $case->value;
            } else {
                // For UnitEnum, fallback to the name (or array index)
                $key = $case->name;
            }

            // Get the label from the attribute if it's callable, otherwise use the case name
            $label = $attribute !== null && method_exists($case, $attribute) && is_callable([$case, $attribute])
                ? $case->$attribute()
                : $case->name;

            $transformed[$key] = $label;
        }

        return $transformed;
    }

    /**
     * Extracts the values associated with each Enum case in the provided array.
     *
     * This method iterates over an array of Enum cases, verifying that each case is indeed
     * an instance of an Enum. It then extracts and returns the values associated with each
     * Enum case, providing a simple array of these values. This functionality is useful for
     * scenarios where you need a list of the underlying values of Enum cases, such as filtering
     * operations or when setting up data for selection options in forms where the value matters.
     *
     * @param array<UnitEnum> $cases The Enum cases from which values are to be extracted.
     * @return array<int|string,mixed> An array of the values associated with each provided Enum case.
     * @throws CaseIsNotEnum If any item in the provided array is not an instance of an Enum.
     * @throws CaseHasNoValue If a BackedEnum has no value.
     */
    public static function keys(array $cases): array
    {
        return array_map(function ($case) {
            if (!$case instanceof UnitEnum) {
                throw CaseIsNotEnum::make($case);
            }

            // Ensure that only BackedEnum cases are allowed for extracting values
            if ($case instanceof BackedEnum) {
                return $case->value;
            }

            throw CaseHasNoValue::make($case); // For UnitEnum, there's no value, so we throw the exception
        }, $cases);
    }
}
