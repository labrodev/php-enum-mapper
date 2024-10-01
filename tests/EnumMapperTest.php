<?php

namespace Labrodev\PhpEnumMapper\Tests;

use PHPUnit\Framework\TestCase;
use Labrodev\PhpEnumMapper\EnumMapper;
use Labrodev\PhpEnumMapper\Exceptions\CaseIsNotEnum;
use Labrodev\PhpEnumMapper\Exceptions\CaseHasNoValue;

// Define some enums for the test
enum TestStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
}

enum TestPaymentMethod
{
    case CreditCard;
    case PayPal;
}

class EnumMapperTest extends TestCase
{
    /**
     * @throws CaseHasNoValue
     * @throws CaseIsNotEnum
     */
    public function testKeyValuesWithBackedEnum()
    {
        $cases = TestStatus::cases();
        $expected = [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'pending' => 'Pending',
        ];

        // Call EnumMapper::keyValues
        $result = EnumMapper::keyValues($cases);

        // Assert the result is correct
        $this->assertEquals($expected, $result);
    }

    /**
     * @throws CaseHasNoValue
     * @throws CaseIsNotEnum
     */
    public function testKeyValuesWithUnitEnum()
    {
        $cases = TestPaymentMethod::cases();
        $expected = [
            'CreditCard' => 'CreditCard',
            'PayPal' => 'PayPal',
        ];

        // Call EnumMapper::keyValues
        $result = EnumMapper::keyValues($cases);

        // Assert the result is correct
        $this->assertEquals($expected, $result);
    }

    /**
     * @throws CaseHasNoValue
     * @throws CaseIsNotEnum
     */
    public function testKeysWithBackedEnum()
    {
        $cases = TestStatus::cases();
        $expected = ['active', 'inactive', 'pending'];

        // Call EnumMapper::keys
        $result = EnumMapper::keys($cases);

        // Assert the result matches the expected values
        $this->assertEquals($expected, $result);
    }

    /**
     * @throws CaseIsNotEnum
     */
    public function testKeysWithUnitEnumThrowsException()
    {
        $this->expectException(CaseHasNoValue::class);

        $cases = TestPaymentMethod::cases();

        // Call EnumMapper::keys and expect an exception
        EnumMapper::keys($cases);
    }

    /**
     * @throws CaseHasNoValue
     */
    public function testKeyValuesThrowsCaseIsNotEnumException()
    {
        $this->expectException(CaseIsNotEnum::class);

        $invalidCases = ['not-an-enum'];

        // Call EnumMapper::keyValues and expect an exception
        EnumMapper::keyValues($invalidCases);
    }

    /**
     * @throws CaseHasNoValue
     */
    public function testKeysThrowsCaseIsNotEnumException()
    {
        $this->expectException(CaseIsNotEnum::class);

        $invalidCases = ['not-an-enum'];

        // Call EnumMapper::keys and expect an exception
        EnumMapper::keys($invalidCases);
    }
}
