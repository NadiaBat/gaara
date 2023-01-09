<?php

declare(strict_types=1);

namespace Gaara\TypeExtractor;

use InvalidArgumentException;

class IntegerTypeExtractor
{
    private const ERROR = 'Поле %s должно быть %s';

    /**
     * @throws InvalidArgumentException
     */
    public static function getRequired(string $field, array $from): int
    {
        if (!array_key_exists($field, $from) || !is_int($from[$field])) {
            throw new InvalidArgumentException(sprintf('Поле %s должно быть int', $field));
        }

        return $from[$field];
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function getNullable(string $field, array $from): ?int
    {
        if (!array_key_exists($field, $from) || $from[$field] === null) {
            return null;
        }

        try {
            return self::getRequired($field, $from);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, 'int, null или отсутствовать'));
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function getCastedFromStringRequired(string $field, array $from): int
    {
        if (!array_key_exists($field, $from) || (!is_int($from[$field]) && !is_numeric($from[$field]))) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, $field, 'int или numeric'));
        }

        return (int)$from[$field];
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function getCastedFromStringNullable(string $field, array $from): ?int
    {
        if (!array_key_exists($field, $from) || $from[$field] === null) {
            return null;
        }

        try {
            return self::getCastedFromStringRequired($field, $from);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, 'int, numeric, null или отсутствовать'));
        }
    }
}
