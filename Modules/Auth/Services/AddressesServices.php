<?php

namespace Modules\Auth\Services;

use Modules\Auth\Models\UserAddress;
use Modules\Base\Services\BaseCrudService;

class AddressesServices extends BaseCrudService
{

    public function __construct()
    {
        parent::__construct(new UserAddress());
    }
    public function getAllAddresses(array $data){
        return UserAddress::where('user_id', $data['user_id'])->paginate($data['per_page']);
    }
    public function createAddress($data)
    {
        if ($data['is_default'] == 1) {
            UserAddress::where('user_id', $data['user_id'])->update(['is_default' => 0]);
        }
        return UserAddress::create($data);
    }

    public function updateAddress($id, $data)
    {
        if (isset($data['is_default']) && $data['is_default'] == 1) {
            UserAddress::where('user_id', $data['user_id'])->update(['is_default' => 0]);
        }
        return UserAddress::where('id', $id)->update($data);
    }
}
