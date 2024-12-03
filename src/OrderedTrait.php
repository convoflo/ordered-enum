<?php

namespace Convoflo\OrderedEnum;

trait OrderedTrait
{
    public function greaterThanOrEqualsTo(OrderedBackedEnum $enum): bool
    {
        return $this == $enum || $this->greaterThan($enum);
    }

    public function lessThanOrEqualsTo(OrderedBackedEnum $enum): bool
    {
        return $this == $enum || $this->lessThan($enum);
    }

    public function greaterThan(OrderedBackedEnum $enum): bool
    {
        return $enum->index() < $this->index();
    }

    public function lessThan(OrderedBackedEnum $enum): bool
    {
        return $enum->index() > $this->index();
    }

    public static function max(OrderedBackedEnum ...$enums): OrderedBackedEnum
    {
        if (count($enums) === 0) {
            return array_slice(static::order(), -1)[0];
        }

        return $enums[0]::order()[max(...array_map(fn(OrderedBackedEnum $enum) => $enum->index(), $enums))];
    }

    public static function min(OrderedBackedEnum ...$enums): OrderedBackedEnum
    {
        if (count($enums) === 0) {
            return static::order()[0];
        }

        return $enums[0]::order()[min(...array_map(fn(OrderedBackedEnum $enum) => $enum->index(), $enums))];
    }

    protected function index(): int
    {
        return array_search($this, $this::order()) ?? -1;
    }
}