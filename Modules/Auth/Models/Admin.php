<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Database\Factories\AdminFactory;
use Modules\Base\Models\BaseModel;
use Spatie\Permission\Traits\HasRoles;

class Admin extends BaseModel
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;

    protected $guard_name = 'api';

    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }

    public function getTableName(): string
    {
        return 'admins';
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
