<?php

namespace Modules\Auth\Enums;

use Modules\Base\Exceptions\CustomException;

enum UserStatusEnum: int
{
    case UNVARIFIED = 0;
    case BLOCKED = 1;
    case VARIFIED = 2;

    public static function fromString(string $status): ?self
    {
        return match (strtoupper($status)) {
            'UNVARIFIED' => self::UNVARIFIED,
            'BLOCKED' => self::BLOCKED,
            'VARIFIED' => self::VARIFIED,
            default => throw new CustomException('Invalid user status'),
        };
    }

}
