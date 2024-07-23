<?php

namespace Modules\Auth\Http\Requests\Dashboard\Notification;

use Modules\Base\Http\Requests\BaseRequest;

class AddNotificationRequest extends BaseRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'created_by' => auth()->user()->id,
        ]);
    }

    public function rules()
    {

        return [
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'created_by' => 'required',
        ];
    }
}
