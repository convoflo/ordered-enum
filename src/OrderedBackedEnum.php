<?php

namespace Convoflo\OrderedEnum;

use BackedEnum;

interface OrderedBackedEnum extends BackedEnum
{
    public static function order(): array;
}