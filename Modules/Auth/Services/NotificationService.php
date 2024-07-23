<?php

namespace Modules\Auth\Services;

use Modules\Auth\Models\Notification;
use Modules\Base\Services\BaseCrudService;

class NotificationService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new Notification());
    }
}
