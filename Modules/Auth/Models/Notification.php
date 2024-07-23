<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Database\Factories\NotificationFactory;
use Modules\Base\Models\BaseModel;

class Notification extends BaseModel
{
    use HasFactory;

    public function getTableName()
    {
        return 'notifications';
    }

    protected static function newFactory(): NotificationFactory
    {
        return NotificationFactory::new();
    }

    public function admin(): BelongsTo
    {

        return $this->belongsTo(Admin::class);
    }
}
