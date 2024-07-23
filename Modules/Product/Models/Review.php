<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Models\User;
use Modules\Base\Models\BaseModel;
use Modules\Product\Database\Factories\ReviewFactory;

class Review extends BaseModel
{
    use HasFactory;

    protected static function newFactory(): ReviewFactory
    {
        return ReviewFactory::new();
    }

    public function getTableName(): string
    {
        return 'reviews';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
