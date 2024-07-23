<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Enums\UserStatusEnum;
use Modules\Auth\Models\Admin;
use Modules\Auth\Models\Country;
use Modules\Auth\Models\User;
use Modules\Auth\Models\UserAddress;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::updateOrCreate([
            'name' => 'syria',
        ]);
        $user = User::updateOrCreate([
            'phone_number' => '123456789',
        ], [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'password' => Hash::make('123456789'),
            'image' => 'ss',
            'status' => UserStatusEnum::VARIFIED,
        ]);
        UserAddress::create([
            'user_id' => $user->id,
            'country_name' => 'syria',
            'is_default' => 1,
            'address_line_1' => 'address',
            'address_line_2' => 'address',
        ]);
        $superRole = Role::updateOrCreate(['name' => 'superAdmin', 'guard_name' => 'api']);

        $admin = Admin::updateOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'password' => Hash::make('password'),

        ]);

        $admin->assignRole($superRole);
    }
}
