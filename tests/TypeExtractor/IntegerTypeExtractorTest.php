<?php

namespace TypeExtractor;

use Gaara\TypeExtractor\IntegerTypeExtractor;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IntegerTypeExtractorTest extends TestCase
{
    /**
     * @dataProvider getRequiredSucceedDataProvider
     */
    public function testGetRequiredSucceed(string $name, array $form, int $expected): void
    {
        self::assertEquals(
            $expected,
            IntegerTypeExtractor::getRequired($name, $form),
        );
    }

    public function getRequiredSucceedDataProvider(): Generator
    {
        yield 'exists' => [
            'name' => 'name',
            'from' => ['name' => 10],
            'expected' => 10,
        ];
    }

    /**
     * @dataProvider getRequiredFailedDataProvider
     */
    public function testGetRequiredFailed(string $name, array $form): void
    {
        $this->expectException(InvalidArgumentException::class);

        IntegerTypeExtractor::getRequired($name, $form);
    }

    public function getRequiredFailedDataProvider(): Generator
    {
        yield 'null' => [
            'name' => 'name',
            'from' => ['name' => null],
        ];

        yield 'not int' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
        ];

        yield 'does not exist' => [
            'name' => 'name',
            'from' => [],
        ];
    }

    /**
     * @dataProvider getNullableSucceedDataProvider
     */
    public function testGetNullableSucceed(string $name, array $form, ?int $expected): void
    {
        self::assertEquals(
            $expected,
            IntegerTypeExtractor::getNullable($name, $form),
        );
    }

    public function getNullableSucceedDataProvider(): Generator
    {
        yield 'exists' => [
            'name' => 'name',
            'from' => ['name' => 10],
            'expected' => 10,
        ];

        yield 'null' => [
            'name' => 'name',
            'from' => ['name' => null],
            'expected' => null,
        ];

        yield 'does not exists' => [
            'name' => 'name',
            'from' => [],
            'expected' => null,
        ];
    }

    /**
     * @dataProvider getNullableFailedDataProvider
     */
    public function testGetNullableFailed(string $name, array $form): void
    {
        $this->expectException(InvalidArgumentException::class);

        IntegerTypeExtractor::getNullable($name, $form);
    }

    public function getNullableFailedDataProvider(): Generator
    {
        yield 'not int' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
        ];
    }

    /**
     * @dataProvider getCastedFromStringRequiredProvider
     */
    public function testGetCastedFromStringRequiredSucceed(string $name, array $form, int $expected): void
    {
        self::assertEquals(
            $expected,
            IntegerTypeExtractor::getCastedFromStringRequired($name, $form),
        );
    }

    public function getCastedFromStringRequiredProvider(): Generator
    {
        yield 'int' => [
            'name' => 'name',
            'from' => ['name' => 10],
            'expected' => 10,
        ];

        yield 'numeric' => [
            'name' => 'name',
            'from' => ['name' => '20'],
            'expected' => 20,
        ];
    }

    /**
     * @dataProvider getCastedFromStringRequiredFailedDataProvider
     */
    public function testGetCastedFromStringRequiredFailed(string $name, array $form): void
    {
        $this->expectException(InvalidArgumentException::class);

        IntegerTypeExtractor::getCastedFromStringRequired($name, $form);
    }

    public function getCastedFromStringRequiredFailedDataProvider(): Generator
    {
        yield 'not numeric' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
        ];

        yield 'null' => [
            'name' => 'name',
            'from' => ['name' => null],
        ];

        yield 'does not exist' => [
            'name' => 'name',
            'from' => [],
        ];
    }

    /**
     * @dataProvider getCastedFromStringNullableProvider
     */
    public function testGetCastedFromStringNullableSucceed(string $name, array $form, ?int $expected): void
    {
        self::assertEquals(
            $expected,
            IntegerTypeExtractor::getCastedFromStringNullable($name, $form),
        );
    }

    public function getCastedFromStringNullableProvider(): Generator
    {
        yield 'int' => [
            'name' => 'name',
            'from' => ['name' => 10],
            'expected' => 10,
        ];

        yield 'numeric' => [
            'name' => 'name',
            'from' => ['name' => '20'],
            'expected' => 20,
        ];

        yield 'null' => [
            'name' => 'name',
            'from' => ['name' => null],
            'expected' => null,
        ];

        yield 'does not exist' => [
            'name' => 'name',
            'from' => [],
            'expected' => null,
        ];
    }

    /**
     * @dataProvider getCastedFromStringNullableFailedDataProvider
     */
    public function testGetCastedFromStringNullableFailed(string $name, array $form): void
    {
        $this->expectException(InvalidArgumentException::class);

        IntegerTypeExtractor::getCastedFromStringRequired($name, $form);
    }

    public function getCastedFromStringNullableFailedDataProvider(): Generator
    {
        yield 'not numeric' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
        ];
    }
}
