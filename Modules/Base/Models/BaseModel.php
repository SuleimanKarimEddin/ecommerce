<?php

namespace Modules\Base\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Models\Scopes\FilterParamsScope;

abstract class BaseModel extends Model
{
    use Filterable , HasFactory , Sortable;

    protected static function booted()
    {
        static::addGlobalScope(new FilterParamsScope());
    }

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $perPage = 10;

    public function getTable()
    {
        return $this->getTableName();
    }

    abstract public function getTableName();
}
