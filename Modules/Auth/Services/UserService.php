<?php

namespace Modules\Auth\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Enums\UserStatusEnum;
use Modules\Auth\Models\User;
use Modules\Auth\Models\UserAddress;
use Modules\Base\Interface\ImageServiceInterface;
use Modules\Base\Services\BaseCrudService;

class UserService extends BaseCrudService
{
    public function __construct(private CountriesService $countriesService, private ImageServiceInterface $imageInterface)
    {
        parent::__construct(new User());
    }

    public function getAllAddresessForUser(): Collection
    {
        $id = auth()->user()->id;

        return User::where('id', $id)->with('addresses')->first();
    }

    public function changeUserStatus(int $id, UserStatusEnum $status)
    {

        $user = User::where('id', $id)->first();
        $user->status = $status;
        $user->save();

        return $user;

    }

    public function getProfile()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->with('defaultAddress')->first();

        return $user;
    }

    public function updateProfile(array $data)
    {
        $user = auth()->user();
        if (isset($data['image'])) {
            $image = $this->imageInterface->UpdateImage($data['image'], $user->image);
            $data['image'] = $image;
        }
        User::where('id', $user->id)->update([
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
            'image' => $data['image'] ?? $user->image,
        ]);
        UserAddress::where('is_default', 1)->update([
            'country_name' => $data['country_name'],
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
        ]);

        return true;
    }

    public function createAddress($data)
    {
        if ($data['is_default'] == 1) {
            $this->makeAllAdressesDefaultFalse();
        }

        UserAddress::create([
            'user_id' => auth()->user()->id,
            'country_name' => $data['country_name'],
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'is_default' => $data['is_default'],
        ]);
    }

    public function updateUserAddress($data)
    {
        if ($data['is_default'] == 1) {
            $this->makeAllAdressesDefaultFalse();
        }
        UserAddress::where('id', $data['id'])->update([
            'country_name' => $data['country_name'],
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'is_default' => $data['is_default'],
        ]);
    }

    private function makeAllAdressesDefaultFalse()
    {
        UserAddress::where('user_id', auth()->user()->id)->update(['is_default' => 0]);
    }

    public function getProfileWithAddress()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->with('addresses')->first();

        return $user;
    }

    public function updateUser(string $id, array $data)
    {
        $user = User::where(['id' => $id])->first();
        $data['status'] = UserStatusEnum::fromString($data['status']);
        if (isset($data['image'])) {
            $data['image'] = $this->imageInterface->UpdateImage($data['image'], $user->image);
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $user->update($data);
    }

    public function createUser(array $data)
    {
        $data['status'] = UserStatusEnum::fromString($data['status']);
        if (isset($data['image'])) {
            $data['image'] = $this->imageInterface->saveImage($data['image']);
        }
            $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}
