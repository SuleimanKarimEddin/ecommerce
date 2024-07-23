<?php

namespace Modules\Order\Enums;

enum PaymentMethodEnum: string
{
    case Online = 'online';
    case Cash = 'cash';
}
