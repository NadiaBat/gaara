<?php

declare(strict_types=1);

namespace Gaara\TypeExtractor;

use InvalidArgumentException;

class BooleanTypeExtractor
{
    private const ERROR = 'Поле %s должно быть %s';

    /**
     * @throws InvalidArgumentException
     */
    public static function getRequired(string $field, array $from): bool
    {
        if (!array_key_exists($field, $from) || !is_bool($from[$field])) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, 'bool'));
        }

        return $from[$field];
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function getNullable(string $field, array $from): ?bool
    {
        if (!array_key_exists($field, $from) || $from[$field] === null) {
            return null;
        }

        try {
            return self::getRequired($field, $from);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, 'bool, null или отсутствовать'));
        }
    }
}
