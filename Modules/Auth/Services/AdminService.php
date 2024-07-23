<?php

namespace Modules\Auth\Services;

use Modules\Auth\Models\Admin;
use Modules\Base\Services\BaseCrudService;

class AdminService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new Admin());
    }

    public function createAdmin(array $data): Admin
    {
        $data['password'] = bcrypt($data['password']);

        return $this->model->create($data);
    }
}
