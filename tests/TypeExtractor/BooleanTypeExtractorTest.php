<?php

namespace TypeExtractor;

use Gaara\TypeExtractor\BooleanTypeExtractor;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BooleanTypeExtractorTest extends TestCase
{
    /**
     * @dataProvider getRequiredSucceedDataProvider
     */
    public function testGetRequiredSucceed(string $name, array $from, bool $expected): void
    {
        self::assertEquals(
            $expected,
            BooleanTypeExtractor::getRequired($name, $from),
        );
    }

    public function getRequiredSucceedDataProvider(): Generator
    {
        yield 'true' => [
            'name' => 'name',
            'from' => ['name' => true],
            'expected' => true,
        ];

        yield 'false' => [
            'name' => 'name',
            'from' => ['name' => false],
            'expected' => false,
        ];
    }

    /**
     * @dataProvider getRequiredFailedDataProvider
     */
    public function testGetRequiredFailed(string $name, array $from): void
    {
        $this->expectException(InvalidArgumentException::class);

        BooleanTypeExtractor::getRequired($name, $from);
    }

    public function getRequiredFailedDataProvider(): Generator
    {
        yield 'null' => [
            'name' => 'name',
            'from' => ['name' => null],
        ];

        yield 'not bool' => [
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
    public function testGetNullableSucceed(string $name, array $from, ?bool $expected): void
    {
        self::assertEquals(
            $expected,
            BooleanTypeExtractor::getNullable($name, $from),
        );
    }

    public function getNullableSucceedDataProvider(): Generator
    {
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

        yield 'exists' => [
            'name' => 'name',
            'from' => ['name' => true],
            'expected' => true,
        ];
    }

    /**
     * @dataProvider getNullableFailedDataProvider
     */
    public function testGetNullableFailed(string $name, array $from): void
    {
        $this->expectException(InvalidArgumentException::class);

        BooleanTypeExtractor::getNullable($name, $from);
    }

    public function getNullableFailedDataProvider(): Generator
    {
        yield 'not bool' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
        ];
    }
}
