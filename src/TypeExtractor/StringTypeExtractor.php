<?php

declare(strict_types=1);

namespace Gaara\TypeExtractor;

use InvalidArgumentException;

class StringTypeExtractor
{
    private const ERROR = 'Поле %s должно быть %s';

    /**
     * @throws InvalidArgumentException
     */
    public static function getRequired(string $field, array $from): string
    {
        if (!array_key_exists($field, $from) || !is_string($from[$field])) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, 'string'));
        }

        return $from[$field];
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function getNullable(string $field, array $from): ?string
    {
        if (!array_key_exists($field, $from) || $from[$field] === null) {
            return null;
        }

        try {
            return self::getRequired($field, $from);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(sprintf(self::ERROR, $field, 'string null или отсутствовать'));
        }
    }
}
