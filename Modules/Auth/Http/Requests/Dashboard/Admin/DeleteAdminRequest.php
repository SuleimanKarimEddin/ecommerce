<?php

namespace Modules\Auth\Http\Requests\Dashboard\Admin;

use Modules\Base\Http\Requests\BaseRequest;

class DeleteAdminRequest extends BaseRequest
{
    public function rules()
    {
        return [
            // 'id' => 'required|exists:admins,id',
        ];
    }
}
