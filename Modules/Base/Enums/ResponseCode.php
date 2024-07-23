<?php

namespace Modules\Base\Enums;

enum ResponseCode: int
{
    case INVALID_EMAIL = 600;
    case INVALID_PASSWORD = 601;
}
