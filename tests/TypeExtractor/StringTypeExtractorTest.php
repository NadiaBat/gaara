<?php

namespace TypeExtractor;

use Gaara\TypeExtractor\StringTypeExtractor;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class StringTypeExtractorTest extends TestCase
{
    /**
     * @dataProvider getRequiredSucceedDataProvider
     */
    public function testGetRequiredSucceed(string $name, array $form, string $expected): void
    {
        self::assertEquals(
            $expected,
            StringTypeExtractor::getRequired($name, $form),
        );
    }

    public function getRequiredSucceedDataProvider(): Generator
    {
        yield 'not empty' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
            'expected' => 'abc',
        ];

        yield 'empty' => [
            'name' => 'name',
            'from' => ['name' => ''],
            'expected' => '',
        ];
    }

    /**
     * @dataProvider getRequiredFailedDataProvider
     */
    public function testGetRequiredFailed(string $name, array $form): void
    {
        $this->expectException(InvalidArgumentException::class);

        StringTypeExtractor::getRequired($name, $form);
    }

    public function getRequiredFailedDataProvider(): Generator
    {
        yield 'null' => [
            'name' => 'name',
            'from' => ['name' => null],
        ];

        yield 'does not exist' => [
            'name' => 'name',
            'from' => [],
        ];

        yield 'is not string' => [
            'name' => 'name',
            'from' => ['name' => 100],
        ];
    }

    /**
     * @dataProvider getNullableSucceedDataProvider
     */
    public function testGetNullableSucceed(string $name, array $form, ?string $expected): void
    {
        self::assertEquals(
            $expected,
            StringTypeExtractor::getNullable($name, $form),
        );
    }

    public function getNullableSucceedDataProvider(): Generator
    {
        yield 'not empty' => [
            'name' => 'name',
            'from' => ['name' => 'abc'],
            'expected' => 'abc',
        ];

        yield 'empty' => [
            'name' => 'name',
            'from' => ['name' => ''],
            'expected' => '',
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
     * @dataProvider getNullableFailedDataProvider
     */
    public function testGetNullableFailed(string $name, array $form): void
    {
        $this->expectException(InvalidArgumentException::class);

        StringTypeExtractor::getRequired($name, $form);
    }

    public function getNullableFailedDataProvider(): Generator
    {
        yield 'is not string' => [
            'name' => 'name',
            'from' => ['name' => 100],
        ];
    }
}
